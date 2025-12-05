<?php
 add// backend/controllers/PreguntasController.php
session_start();

if (!isset($_SESSION["aprendiz"]) || !isset($_SESSION["codigo_validado"])) {
    header("Location: ../../frontend/views/login_aprendiz.php");
    exit();
}

require_once __DIR__ . '/../models/PreguntaModel.php'; 

$preguntaModel = new PreguntaModel();
$datosPregunta = $preguntaModel->obtenerPreguntaAleatoria();

$pregunta = [];
$opciones_a_mostrar = [];

if ($datosPregunta) {
    $pregunta['enunciado'] = $datosPregunta['enunciado_pregunta'];

    // Crear array con las 4 opciones
    $opciones = [
        $datosPregunta['opcion1_pregunta'],
        $datosPregunta['opcion2_pregunta'],
        $datosPregunta['opcion3_pregunta'],
        $datosPregunta['opcion4_pregunta']
    ];

    $pregunta['respuesta_correcta_texto'] = $datosPregunta['correcta_pregunta'];
    
    // Mezclar las opciones
    shuffle($opciones);

    // Asignar letras a las opciones mezcladas
    $letras = ['A', 'B', 'C', 'D'];
    for ($i = 0; $i < count($opciones); $i++) {
        $opciones_a_mostrar[$letras[$i]] = $opciones[$i];
    }
    
    // Buscar qué letra corresponde a la respuesta correcta EN EL ORDEN MEZCLADO
    $respuesta_correcta_letra = array_search($pregunta['respuesta_correcta_texto'], $opciones_a_mostrar);

    $pregunta['opciones_mostradas'] = $opciones_a_mostrar;
    $pregunta['respuesta_correcta_letra'] = $respuesta_correcta_letra;
    
    // ✅ CRÍTICO: Guardar el mapeo EXACTO de opciones mostradas en sesión
    $_SESSION['pregunta_actual_id'] = $datosPregunta['ID_pregunta'];
    $_SESSION['respuesta_correcta_letra'] = $respuesta_correcta_letra;
    $_SESSION['respuesta_correcta_texto'] = $pregunta['respuesta_correcta_texto'];
    $_SESSION['enunciado_pregunta'] = $pregunta['enunciado'];
    $_SESSION['opciones_mostradas'] = $opciones_a_mostrar; // ← NUEVO: guardar el mapeo exacto

} else {
    $pregunta['enunciado'] = "No hay preguntas disponibles en este momento.";
    $pregunta['opciones_mostradas'] = [];
}

require_once __DIR__ . '/../../frontend/views/juego.php';
?>