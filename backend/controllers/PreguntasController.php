<?php
session_start();

require_once __DIR__ . '/../models/PreguntaModel.php'; 

$preguntaModel = new PreguntaModel();
$datosPregunta = $preguntaModel->obtenerPreguntaAleatoria();

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
    
    // Guardar en sesión
    $_SESSION['pregunta_actual_id'] = $datosPregunta['ID_pregunta'];
    $_SESSION['respuesta_correcta_letra'] = $respuesta_correcta_letra;
    $_SESSION['respuesta_correcta_texto'] = $pregunta['respuesta_correcta_texto'];
    $_SESSION['enunciado_pregunta'] = $pregunta['enunciado'];

} else {
    $pregunta['enunciado'] = "No hay preguntas disponibles en este momento.";
    $pregunta['opciones_mostradas'] = [];
}

require_once __DIR__ . '/../../frontend/views/juego.php';
?>