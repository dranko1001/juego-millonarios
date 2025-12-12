<?php
require_once __DIR__ . '/../models/pdoconexion.php';

try {

    if (!isset($_POST['id'])) {
        echo "ID no recibido";
        exit;
    }

    $id = intval($_POST['id']);

    
    $db = new PDOConnection();
    $conexion = $db->getConexion();

    $sql = "DELETE FROM tbl_jugadores WHERE ID_jugador = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "ok";
    } else {
        echo "Error al eliminar";
    }

    $db->desconectar();

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
