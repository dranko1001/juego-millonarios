<?php

session_start();

// Verificar autenticación
if (!isset($_SESSION["aprendiz"]) || !isset($_SESSION["id_jugador"])) {
    header("Location: ../../frontend/views/login_aprendiz.php");
    exit();
}

// Guardar puntaje final
if (isset($_SESSION['puntaje_pesos'])) {
    require_once __DIR__ . '/../models/JugadorModel.php';
    $jugadorModel = new JugadorModel();
    $jugadorModel->actualizarPuntaje(
        $_SESSION['id_jugador'], 
        $_SESSION['puntaje_pesos']
    );
}

// Redirigir a página de categoría completada
header("Location: ../../frontend/views/categoria_completada.php");
exit;
?>