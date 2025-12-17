<?php


header('Content-Type: application/json; charset=utf-8');
session_start();

// Verificar que sea un administrador
if (!isset($_SESSION["admin"])) {
    echo json_encode(['error' => 'No tienes permisos de administrador']);
    exit();
}

// Verificar que sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Método no permitido']);
    exit();
}

// Verificar la acción
if (!isset($_POST['accion']) || $_POST['accion'] !== 'limpiar_todos') {
    echo json_encode(['error' => 'Acción no válida']);
    exit();
}

// Incluir el modelo y ejecutar
require_once __DIR__ . '/../models/JugadorModel.php';

try {
    $jugadorModel = new JugadorModel();
    $resultado = $jugadorModel->limpiarTodosLosJugadores();

    if ($resultado['success']) {
        echo json_encode([
            'success' => true,
            'mensaje' => 'Todos los jugadores han sido eliminados exitosamente'
        ]);
    } else {
        echo json_encode([
            'error' => 'No se pudo completar la limpieza: ' . ($resultado['error'] ?? 'Error desconocido')
        ]);
    }

} catch (Exception $e) {
    error_log("Error al limpiar jugadores: " . $e->getMessage());
    echo json_encode(['error' => 'Error en el servidor']);
}
?>