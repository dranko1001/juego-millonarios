<?php
// backend/controllers/TiempoAgotadoController.php
session_start();

// Función para guardar logs
function guardarLog($tipo, $mensaje, $id_jugador = null, $puntaje = null) {
    try {
        require_once __DIR__ . '/../models/pdoconexion.php';
        $db = new PDOConnection();
        $conn = $db->conectar();
        
        $sql = "INSERT INTO tbl_logs_debug (tipo, mensaje, id_jugador, puntaje) 
                VALUES (:tipo, :mensaje, :id_jugador, :puntaje)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':tipo' => $tipo,
            ':mensaje' => $mensaje,
            ':id_jugador' => $id_jugador,
            ':puntaje' => $puntaje
        ]);
        $db->desconectar();
    } catch (Exception $e) {
        error_log("Error al guardar log: " . $e->getMessage());
    }
}

guardarLog(
    'TIEMPO_AGOTADO_AUTO',
    'Redirección automática por tiempo agotado',
    $_SESSION['id_jugador'] ?? null,
    $_SESSION['puntaje_pesos'] ?? 0
);

// Guardar puntaje actual
if (isset($_SESSION['id_jugador']) && isset($_SESSION['puntaje_pesos'])) {
    require_once __DIR__ . '/../models/JugadorModel.php';
    $jugadorModel = new JugadorModel();
    $jugadorModel->actualizarPuntaje(
        $_SESSION['id_jugador'], 
        $_SESSION['puntaje_pesos']
    );
}

// Marcar como tiempo agotado
$_SESSION['ultima_respuesta'] = 'tiempo_agotado';
$_SESSION['pregunta_activa'] = false;
$_SESSION['enunciado_actual'] = $_SESSION['enunciado_pregunta'] ?? '';

header('Location: ../../frontend/views/resultado.php');
exit;
?>