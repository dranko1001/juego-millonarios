<?php
require_once __DIR__ . "/../models/pdoconexion.php";

$db = new PDOConnection();
$pdo = $db->getConexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['ID_pregunta'] ?? 0);

    if ($id > 0) {
        try {
            $stmt = $pdo->prepare("DELETE FROM tbl_preguntas WHERE ID_pregunta = :id");
            $stmt->execute([':id' => $id]);
            $_SESSION['msg_pregunta'] = "Pregunta eliminada correctamente.";
        } catch (PDOException $e) {
            $_SESSION['msg_pregunta'] = "Error al eliminar la pregunta: " . $e->getMessage();
        }
    } else {
        $_SESSION['msg_pregunta'] = "ID inválido.";
    }

    header("Location: ../../frontend/views/eliminarpregunta.php");
    exit();
}
?>
