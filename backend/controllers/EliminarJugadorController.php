<?php
// backend/controllers/EliminarJugadorController.php

// Configurar headers para JSON
header('Content-Type: application/json; charset=utf-8');

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar que sea una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'error' => 'Método no permitido',
        'debug' => 'Se requiere POST'
    ]);
    exit();
}

// Verificar que llegue el ID del jugador
if (!isset($_POST['id_jugador']) || empty($_POST['id_jugador'])) {  // ← CAMBIADO
    echo json_encode([
        'error' => 'ID de jugador no proporcionado',
        'debug' => 'POST data: ' . json_encode($_POST)
    ]);
    exit();
}

$idJugador = filter_var($_POST['id_jugador'], FILTER_VALIDATE_INT);  // ← CAMBIADO

// Validar que el ID sea válido
if ($idJugador === false || $idJugador <= 0) {
    echo json_encode([
        'error' => 'ID de jugador inválido',
        'debug' => 'Valor recibido: ' . $_POST['id_jugador']  // ← CAMBIADO
    ]);
    exit();
}

require_once __DIR__ . '/../models/JugadorModel.php';

try {
    $jugadorModel = new JugadorModel();

    // Primero verificar que el jugador existe
    $puntaje = $jugadorModel->obtenerPuntaje($idJugador);

    if ($puntaje === null) {
        echo json_encode([
            'error' => 'Jugador no encontrado',
            'debug' => 'ID buscado: ' . $idJugador
        ]);
        exit();
    }

    // Eliminar el jugador
    $resultado = $jugadorModel->eliminarJugador($idJugador);

    if ($resultado) {
        echo json_encode([
            'success' => true,
            'mensaje' => 'Jugador eliminado exitosamente'
        ]);
    } else {
        echo json_encode([
            'error' => 'No se pudo eliminar el jugador',
            'debug' => 'La operación DELETE no afectó ninguna fila'
        ]);
    }

} catch (Exception $e) {
    error_log("Error al eliminar jugador: " . $e->getMessage());
    echo json_encode([
        'error' => 'Error en el servidor',
        'debug' => $e->getMessage()
    ]);
}
?>