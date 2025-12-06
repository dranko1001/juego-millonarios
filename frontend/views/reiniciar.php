<?php
// frontend/views/reiniciar.php
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
unset($_SESSION['opciones_mostradas']);

// IMPORTANTE: NO limpiar la categoría seleccionada para mantenerla
// Si quieres que vuelva a seleccionar categoría, descomenta estas líneas:
// unset($_SESSION['categoria_seleccionada']);
// unset($_SESSION['categoria_nombre']);

// Verificar si quiere cambiar de categoría
if (isset($_GET['cambiar_categoria']) && $_GET['cambiar_categoria'] == '1') {
    // Limpiar categoría y redirigir a selección
    unset($_SESSION['categoria_seleccionada']);
    unset($_SESSION['categoria_nombre']);
    header('Location: seleccionar_categoria.php');
    exit;
}

// Redirigir al inicio del juego (mantiene la categoría actual)
header('Location: ../../backend/controllers/PreguntasController.php');
exit;
?>