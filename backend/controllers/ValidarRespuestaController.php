<?php
session_start();

// Verificar que lleguen los datos por POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['respuesta_elegida']) || !isset($_POST['id_pregunta'])) {
    header('Location: PreguntaController.php');
    exit;
}

require_once __DIR__ . '/../models/PreguntaModel.php';

$respuestaElegida = $_POST['respuesta_elegida'];
$idPregunta = (int)$_POST['id_pregunta'];

// Validar usando el modelo
$preguntaModel = new PreguntaModel();
$resultado = $preguntaModel->validarRespuesta($idPregunta, $respuestaElegida);

// Verificar si hubo error
if (isset($resultado['error'])) {
    $_SESSION['error'] = $resultado['error'];
    header('Location: PreguntaController.php');
    exit;
}

$esCorrecta = $resultado['es_correcta'];

// Incrementar contador de preguntas respondidas
if (!isset($_SESSION['preguntas_correctas'])) {
    $_SESSION['preguntas_correctas'] = 0;
}

if ($esCorrecta) {
    $_SESSION['preguntas_correctas']++;
    $_SESSION['ultima_respuesta'] = 'correcta';
} else {
    $_SESSION['ultima_respuesta'] = 'incorrecta';
}

// Guardar información para mostrar en la vista de resultado
$_SESSION['respuesta_elegida'] = $respuestaElegida;
$_SESSION['respuesta_correcta_letra'] = $resultado['respuesta_correcta'];
$_SESSION['enunciado_actual'] = $_SESSION['enunciado_pregunta'] ?? '';

// Redirigir a la vista de resultado
header('Location: ../../frontend/views/resultado.php');
exit;
?>