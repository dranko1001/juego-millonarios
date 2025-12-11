<?php
// backend/controllers/PreguntasController.php
session_start();

// ✅ NUEVO: Inicializar comodines
require_once __DIR__ . '/../models/ComodinModel.php';
ComodinModel::inicializarComodines();

// Verificar autenticación
if (!isset($_SESSION["aprendiz"]) || !isset($_SESSION["codigo_validado"])) {
    header("Location: ../../frontend/views/login_aprendiz.php");
    exit();
}

// ✅ NUEVO: Inicializar puntajes si no existen
if (!isset($_SESSION['puntaje_pesos'])) {
    $_SESSION['puntaje_pesos'] = 0;
}

if (!isset($_SESSION['preguntas_correctas'])) {
    $_SESSION['preguntas_correctas'] = 0;
}

// Verificar que se haya seleccionado una categoría
if (!isset($_SESSION["categoria_seleccionada"])) {
    header("Location: ../../frontend/views/seleccionar_categoria.php");
    exit();
}

require_once __DIR__ . '/../models/PreguntaModel.php';

$preguntaModel = new PreguntaModel();
$categoria_seleccionada = $_SESSION["categoria_seleccionada"];

// Inicializar array de preguntas respondidas si no existe
if (!isset($_SESSION['preguntas_respondidas'])) {
    $_SESSION['preguntas_respondidas'] = [];
}

$pregunta = [];
$opciones_a_mostrar = [];
$datosPregunta = null;

// ✅ ANTI-TRAMPA: Verificar si ya hay una pregunta activa (sin responder)
if (isset($_SESSION['pregunta_activa']) && $_SESSION['pregunta_activa'] === true) {

    // ✅ Reutilizar la pregunta actual guardada en sesión
    if (
        isset($_SESSION['pregunta_actual_id']) &&
        isset($_SESSION['enunciado_pregunta']) &&
        isset($_SESSION['opciones_mostradas'])
    ) {

        // Reconstruir la pregunta desde la sesión
        $pregunta['enunciado'] = $_SESSION['enunciado_pregunta'];
        $opciones_a_mostrar = $_SESSION['opciones_mostradas'];

        // Crear un array simulado de datos de pregunta para compatibilidad
        $datosPregunta = [
            'ID_pregunta' => $_SESSION['pregunta_actual_id'],
            'enunciado_pregunta' => $_SESSION['enunciado_pregunta'],
            'TBL_dificultades_ID_dificultad' => $_SESSION['dificultad_pregunta'] ?? 1
        ];

        $pregunta['opciones_mostradas'] = $opciones_a_mostrar;
        $pregunta['respuesta_correcta_letra'] = $_SESSION['respuesta_correcta_letra'];
        $pregunta['respuesta_correcta_texto'] = $_SESSION['respuesta_correcta_texto'];
        
        // ✅ CRÍTICO: NO REINICIAR EL TIEMPO - mantener el timestamp original
        
    } else {
        // Si falta información, forzar nueva pregunta
        $_SESSION['pregunta_activa'] = false;
    }
}

// ✅ Si NO hay pregunta activa, generar una nueva
if (!isset($_SESSION['pregunta_activa']) || $_SESSION['pregunta_activa'] === false) {

    // ✅ NUEVO: Determinar si deben ser preguntas fáciles obligatorias
    $preguntasCorrectasActuales = $_SESSION['preguntas_correctas'] ?? 0;
    
    // 🎯 LAS PRIMERAS 3 PREGUNTAS DEBEN SER FÁCILES (DIFICULTAD 1)
    if ($preguntasCorrectasActuales < 3) {
        $dificultadRequerida = 1; // Fácil
        
        // Obtener pregunta FÁCIL según la categoría
        if ($categoria_seleccionada === "MIXTA") {
            $datosPregunta = $preguntaModel->obtenerPreguntaAleatoriaPorDificultad(
                $dificultadRequerida, 
                $_SESSION['preguntas_respondidas']
            );
        } else {
            $datosPregunta = $preguntaModel->obtenerPreguntaPorCategoriaYDificultad(
                $categoria_seleccionada, 
                $dificultadRequerida, 
                $_SESSION['preguntas_respondidas']
            );
        }
        
        // ✅ Si no hay más preguntas fáciles, buscar de cualquier dificultad
        if (!$datosPregunta) {
            if ($categoria_seleccionada === "MIXTA") {
                $datosPregunta = $preguntaModel->obtenerPreguntaAleatoria($_SESSION['preguntas_respondidas']);
            } else {
                $datosPregunta = $preguntaModel->obtenerPreguntaPorCategoria($categoria_seleccionada, $_SESSION['preguntas_respondidas']);
            }
        }
        
    } else {
        // 🎲 DESPUÉS DE LAS 3 PRIMERAS: DIFICULTAD ALEATORIA
        if ($categoria_seleccionada === "MIXTA") {
            $datosPregunta = $preguntaModel->obtenerPreguntaAleatoria($_SESSION['preguntas_respondidas']);
        } else {
            $datosPregunta = $preguntaModel->obtenerPreguntaPorCategoria($categoria_seleccionada, $_SESSION['preguntas_respondidas']);
        }
    }

    if ($datosPregunta) {
        $pregunta['enunciado'] = $datosPregunta['enunciado_pregunta'];

        $opciones = [
            $datosPregunta['opcion1_pregunta'],
            $datosPregunta['opcion2_pregunta'],
            $datosPregunta['opcion3_pregunta'],
            $datosPregunta['opcion4_pregunta']
        ];

        $pregunta['respuesta_correcta_texto'] = $datosPregunta['correcta_pregunta'];

        // ✅ Mezclar las opciones
        shuffle($opciones);

        $letras = ['A', 'B', 'C', 'D'];
        for ($i = 0; $i < count($opciones); $i++) {
            $opciones_a_mostrar[$letras[$i]] = $opciones[$i];
        }

        $respuesta_correcta_letra = array_search($pregunta['respuesta_correcta_texto'], $opciones_a_mostrar);

        $pregunta['opciones_mostradas'] = $opciones_a_mostrar;
        $pregunta['respuesta_correcta_letra'] = $respuesta_correcta_letra;

        // ✅ Guardar en sesión
        $_SESSION['pregunta_actual_id'] = $datosPregunta['ID_pregunta'];
        $_SESSION['respuesta_correcta_letra'] = $respuesta_correcta_letra;
        $_SESSION['respuesta_correcta_texto'] = $pregunta['respuesta_correcta_texto'];
        $_SESSION['enunciado_pregunta'] = $pregunta['enunciado'];
        $_SESSION['opciones_mostradas'] = $opciones_a_mostrar;
        $_SESSION['dificultad_pregunta'] = $datosPregunta['TBL_dificultades_ID_dificultad'];
        
        // ✅ CRÍTICO: SOLO guardar el tiempo de inicio SI ES UNA PREGUNTA NUEVA
        $_SESSION['tiempo_inicio_pregunta'] = time(); // Timestamp actual
        $_SESSION['tiempo_limite_segundos'] = 120; // 2 minutos = 120 segundos
        
        // ✅ MARCAR PREGUNTA COMO ACTIVA (sin responder)
        $_SESSION['pregunta_activa'] = true;

        // ✅ Agregar a preguntas respondidas para no repetirla
        $_SESSION['preguntas_respondidas'][] = $datosPregunta['ID_pregunta'];

    } else {
        // ✅ NO HAY MÁS PREGUNTAS - GUARDAR PUNTAJE Y REDIRIGIR
        if (isset($_SESSION['id_jugador']) && isset($_SESSION['puntaje_pesos'])) {
            require_once __DIR__ . '/../models/JugadorModel.php';
            $jugadorModel = new JugadorModel();
            $jugadorModel->actualizarPuntaje(
                $_SESSION['id_jugador'],
                $_SESSION['puntaje_pesos']
            );
        }

        header("Location: ../../frontend/views/categoria_completada.php");
        exit();
    }
}

require_once __DIR__ . '/../../frontend/views/juego.php';
?>