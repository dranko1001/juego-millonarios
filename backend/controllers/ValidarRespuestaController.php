<?php
// backend/controllers/ValidarRespuestaController.php
session_start();

// Verificar que lleguen los datos por POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['respuesta_elegida']) || !isset($_POST['id_pregunta'])) {
    header('Location: PreguntasController.php');
    exit;
}

$respuestaElegida = $_POST['respuesta_elegida'];
$idPregunta = (int)$_POST['id_pregunta'];

// ✅ SOLUCIÓN: Usar el mapeo guardado en sesión
$respuestaCorrectaLetra = $_SESSION['respuesta_correcta_letra'] ?? null;
$respuestaCorrectaTexto = $_SESSION['respuesta_correcta_texto'] ?? null;

// Verificar que tengamos los datos necesarios
if (!$respuestaCorrectaLetra || !$respuestaCorrectaTexto) {
    $_SESSION['error'] = 'Error: Datos de pregunta no encontrados en sesión';
    header('Location: PreguntasController.php');
    exit;
}

// Validar la respuesta comparando con lo guardado en sesión
$esCorrecta = ($respuestaElegida === $respuestaCorrectaLetra);

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
$_SESSION['enunciado_actual'] = $_SESSION['enunciado_pregunta'] ?? '';

// Redirigir a la vista de resultado
header('Location: ../../frontend/views/resultado.php');
exit;
?>