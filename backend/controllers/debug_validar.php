<?php
// debug_validar.php (reemplaza temporalmente ValidarRespuestaController.php)
session_start();

echo "<h2>🔍 Debug - Validar Respuesta</h2>";

echo "<h3>Datos POST recibidos:</h3>";
echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "<h3>Datos en sesión ANTES de validar:</h3>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['respuesta_elegida']) || !isset($_POST['id_pregunta'])) {
    echo "<p style='color:red;'>❌ Faltan datos en POST</p>";
    exit;
}

$respuestaElegida = $_POST['respuesta_elegida'];
$idPregunta = (int)$_POST['id_pregunta'];

$respuestaCorrectaLetra = $_SESSION['respuesta_correcta_letra'] ?? null;
$respuestaCorrectaTexto = $_SESSION['respuesta_correcta_texto'] ?? null;
$opcionesMostradas = $_SESSION['opciones_mostradas'] ?? [];

echo "<h3>Validación:</h3>";
echo "Respuesta elegida: <strong>$respuestaElegida</strong><br>";
echo "Respuesta correcta (letra): <strong>$respuestaCorrectaLetra</strong><br>";
echo "Respuesta correcta (texto): <strong>$respuestaCorrectaTexto</strong><br>";

if (!$respuestaCorrectaLetra || !$respuestaCorrectaTexto || empty($opcionesMostradas)) {
    echo "<p style='color:red;'>❌ Faltan datos en sesión</p>";
    exit;
}

$textoRespuestaElegida = $opcionesMostradas[$respuestaElegida] ?? 'Respuesta no encontrada';

echo "Texto respuesta elegida: <strong>$textoRespuestaElegida</strong><br>";

$esCorrecta = ($respuestaElegida === $respuestaCorrectaLetra);

echo "<h3>Resultado:</h3>";
if ($esCorrecta) {
    echo "<p style='color:green; font-size:2em;'>✅ ¡CORRECTO!</p>";
} else {
    echo "<p style='color:red; font-size:2em;'>❌ INCORRECTO</p>";
}

echo "<h3>Datos que se guardarán en sesión:</h3>";
echo "respuesta_elegida_letra: $respuestaElegida<br>";
echo "respuesta_elegida_texto: $textoRespuestaElegida<br>";
echo "respuesta_correcta_letra_resultado: $respuestaCorrectaLetra<br>";
echo "respuesta_correcta_texto_resultado: $respuestaCorrectaTexto<br>";
echo "ultima_respuesta: " . ($esCorrecta ? 'correcta' : 'incorrecta') . "<br>";

echo "<hr>";
echo "<p><a href='../../frontend/views/resultado.php'>Ir manualmente a resultado.php</a></p>";
?>