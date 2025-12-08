<?php
// backend/limpiar_logs.php
require_once __DIR__ . '/models/pdoconexion.php';

$db = new PDOConnection();
$conn = $db->conectar();

$conn->exec("TRUNCATE TABLE tbl_logs_debug");
$db->desconectar();

header("Location: ver_logs.php");
exit;
?>