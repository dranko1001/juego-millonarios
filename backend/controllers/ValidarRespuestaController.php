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

// Inicializar puntaje en pesos si no existe
if (!isset($_SESSION['puntaje_pesos'])) {
    $_SESSION['puntaje_pesos'] = 0;
}

// Inicializar contador de preguntas correctas si no existe
if (!isset($_SESSION['preguntas_correctas'])) {
    $_SESSION['preguntas_correctas'] = 0;
}

if ($esCorrecta) {
    $_SESSION['preguntas_correctas']++;
    $_SESSION['ultima_respuesta'] = 'correcta';
    
    // Calcular puntaje en pesos según la dificultad
    $dificultadId = $_SESSION['dificultad_pregunta'] ?? 1; // Default: Fácil
    $puntajeGanado = 0;
    
    switch ($dificultadId) {
        case 1: // Fácil
            $puntajeGanado = 100000;
            break;
        case 2: // Medio
            $puntajeGanado = 150000;
            break;
        case 3: // Difícil
            $puntajeGanado = 175000;
            break;
        default:
            $puntajeGanado = 100000;
    }
    
    $_SESSION['puntaje_pesos'] += $puntajeGanado;
    $_SESSION['ultimo_puntaje_ganado'] = $puntajeGanado; // Para mostrar en resultado
} else {
    $_SESSION['ultima_respuesta'] = 'incorrecta';
    $_SESSION['ultimo_puntaje_ganado'] = 0;
    
    // Guardar puntaje en la base de datos cuando pierde
    if (isset($_SESSION['id_jugador']) && isset($_SESSION['puntaje_pesos'])) {
        require_once __DIR__ . '/../models/JugadorModel.php';
        $jugadorModel = new JugadorModel();
        $jugadorModel->actualizarPuntaje(
            $_SESSION['id_jugador'], 
            $_SESSION['puntaje_pesos']
        );
    }
}

// Guardar información para mostrar en la vista de resultado
$_SESSION['respuesta_elegida'] = $respuestaElegida;
$_SESSION['enunciado_actual'] = $_SESSION['enunciado_pregunta'] ?? '';

// Redirigir a la vista de resultado
header('Location: ../../frontend/views/resultado.php');
exit;
?>