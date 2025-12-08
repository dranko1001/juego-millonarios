<?php
// backend/controllers/PreguntasController.php
session_start();

// Verificar autenticación
if (!isset($_SESSION["aprendiz"]) || !isset($_SESSION["codigo_validado"])) {
    header("Location: ../../frontend/views/login_aprendiz.php");
    exit();
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

// Obtener pregunta según la categoría seleccionada
if ($categoria_seleccionada === "MIXTA") {
    $datosPregunta = $preguntaModel->obtenerPreguntaAleatoria($_SESSION['preguntas_respondidas']);
} else {
    $datosPregunta = $preguntaModel->obtenerPreguntaPorCategoria($categoria_seleccionada, $_SESSION['preguntas_respondidas']);
}

$pregunta = [];
$opciones_a_mostrar = [];

if ($datosPregunta) {
    $pregunta['enunciado'] = $datosPregunta['enunciado_pregunta'];

    $opciones = [
        $datosPregunta['opcion1_pregunta'],
        $datosPregunta['opcion2_pregunta'],
        $datosPregunta['opcion3_pregunta'],
        $datosPregunta['opcion4_pregunta']
    ];

    $pregunta['respuesta_correcta_texto'] = $datosPregunta['correcta_pregunta'];
    shuffle($opciones);

    $letras = ['A', 'B', 'C', 'D'];
    for ($i = 0; $i < count($opciones); $i++) {
        $opciones_a_mostrar[$letras[$i]] = $opciones[$i];
    }
    
    $respuesta_correcta_letra = array_search($pregunta['respuesta_correcta_texto'], $opciones_a_mostrar);

    $pregunta['opciones_mostradas'] = $opciones_a_mostrar;
    $pregunta['respuesta_correcta_letra'] = $respuesta_correcta_letra;
    
    $_SESSION['pregunta_actual_id'] = $datosPregunta['ID_pregunta'];
    $_SESSION['respuesta_correcta_letra'] = $respuesta_correcta_letra;
    $_SESSION['respuesta_correcta_texto'] = $pregunta['respuesta_correcta_texto'];
    $_SESSION['enunciado_pregunta'] = $pregunta['enunciado'];
    $_SESSION['opciones_mostradas'] = $opciones_a_mostrar;
    $_SESSION['dificultad_pregunta'] = $datosPregunta['TBL_dificultades_ID_dificultad'];
    
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

require_once __DIR__ . '/../../frontend/views/juego.php';
?>