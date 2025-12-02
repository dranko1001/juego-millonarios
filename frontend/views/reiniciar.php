<?php
session_start();

// Limpiar todas las variables de sesión del juego
unset($_SESSION['pregunta_actual_id']);
unset($_SESSION['respuesta_correcta_letra']);
unset($_SESSION['respuesta_correcta_texto']);
unset($_SESSION['enunciado_pregunta']);
unset($_SESSION['ultima_respuesta']);
unset($_SESSION['respuesta_elegida']);
unset($_SESSION['preguntas_correctas']);
unset($_SESSION['enunciado_actual']);

// Redirigir al inicio del juego
header('Location: ../../backend/controllers/PreguntasController.php');
exit;
?>