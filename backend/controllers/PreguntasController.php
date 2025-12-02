<?php
session_start();

// Ajusta la ruta a tu modelo si es necesario
require_once __DIR__ . '/../models/PreguntaModel.php'; 

$preguntaModel = new PreguntaModel();
$datosPregunta = $preguntaModel->obtenerPreguntaAleatoria();

$pregunta = [];
$opciones_a_mostrar = [];

if ($datosPregunta) {
    // 1. Preparamos el enunciado
    $pregunta['enunciado'] = $datosPregunta['enunciado_pregunta'];

    // 2. Creamos un array con las 4 opciones
    $opciones = [
        $datosPregunta['opcion1_pregunta'],
        $datosPregunta['opcion2_pregunta'],
        $datosPregunta['opcion3_pregunta'],
        $datosPregunta['opcion4_pregunta']
    ];

    // 3. Almacenamos la respuesta correcta (el texto)
    $pregunta['respuesta_correcta_texto'] = $datosPregunta['correcta_pregunta'];
    
    // 4. Desordenamos las opciones
    shuffle($opciones);

    // 5. Asignamos letras a las opciones desordenadas para la vista
    $letras = ['A', 'B', 'C', 'D'];
    for ($i = 0; $i < count($opciones); $i++) {
        $opciones_a_mostrar[$letras[$i]] = $opciones[$i];
    }
    
    // 6. Buscamos qué letra aleatoria se le asignó a la respuesta correcta
    $respuesta_correcta_letra = array_search($pregunta['respuesta_correcta_texto'], $opciones_a_mostrar);

    // 7. Agregamos los datos finales a la pregunta
    $pregunta['opciones_mostradas'] = $opciones_a_mostrar;
    $pregunta['respuesta_correcta_letra'] = $respuesta_correcta_letra;
    
    // IMPORTANTE: Guardar en sesión para validar después
    $_SESSION['pregunta_actual_id'] = $datosPregunta['ID_pregunta'];
    $_SESSION['respuesta_correcta_letra'] = $respuesta_correcta_letra;
    $_SESSION['respuesta_correcta_texto'] = $pregunta['respuesta_correcta_texto'];
    $_SESSION['enunciado_pregunta'] = $pregunta['enunciado'];

} else {
    // Si no hay preguntas en la base de datos
    $pregunta['enunciado'] = "No hay preguntas disponibles en este momento.";
    $pregunta['opciones_mostradas'] = [];
}

// 8. Cargar la vista
require_once __DIR__ . '/../../frontend/views/juego.php';
?>