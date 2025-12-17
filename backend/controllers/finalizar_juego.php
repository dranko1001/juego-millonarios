<?php

session_start();

// Guardar puntaje final en la base de datos
if (isset($_SESSION['id_jugador']) && isset($_SESSION['puntaje_pesos'])) {
    require_once __DIR__ . '/../models/pdoconexion.php';
    require_once __DIR__ . '/../models/JugadorModel.php';
    
    $jugadorModel = new JugadorModel();
    $jugadorModel->actualizarPuntaje(
        $_SESSION['id_jugador'], 
        $_SESSION['puntaje_pesos']
    );
}

// Destruir la sesión completamente
session_unset();
session_destroy();

// Redirigir al login
header('Location: ../../frontend/views/login_aprendiz.php');
exit;
?>
