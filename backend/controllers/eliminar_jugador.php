<?php

require_once __DIR__ . "/../models/pdoconexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Método no permitido");
}

if (!isset($_POST["ID_jugador"])) {
    die("ID NO RECIBIDO");
}

$id = intval($_POST["ID_jugador"]);

$db = new PDOConnection();
$pdo = $db->getConexion();

$sql = "DELETE FROM tbl_jugadores WHERE ID_jugador = ?";
$stmt = $pdo->prepare($sql);

if ($stmt->execute([$id])) {
    header("Location: ../../frontend/views/ranking.php");
    exit();
} else {
    die("Error al eliminar");
}
