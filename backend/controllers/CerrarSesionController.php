<?php

session_start();

// GUARDAR PUNTAJE ANTES DE CERRAR SESIÓN
if (isset($_SESSION['id_jugador']) && isset($_SESSION['puntaje_pesos'])) {
    require_once __DIR__ . '/../models/JugadorModel.php';
    $jugadorModel = new JugadorModel();
    $jugadorModel->actualizarPuntaje(
        $_SESSION['id_jugador'], 
        $_SESSION['puntaje_pesos']
    );
}

// Destruir sesión
session_unset();
session_destroy();

// Redirigir al login
header("Location: ../../frontend/views/login_aprendiz.php");
exit;
?>