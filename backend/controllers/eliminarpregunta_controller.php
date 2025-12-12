<?php
session_start();
require_once __DIR__ . "/../models/pdoconexion.php";

$db = new PDOConnection();
$pdo = $db->getConexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['ID_pregunta'] ?? 0);
    $pagina_actual = intval($_POST['pagina_actual'] ?? 1);
    $buscar = trim($_POST['buscar'] ?? '');

    if ($id > 0) {
        try {
            $stmt = $pdo->prepare("DELETE FROM tbl_preguntas WHERE ID_pregunta = :id");
            $stmt->execute([':id' => $id]);
            
            if ($stmt->rowCount() > 0) {
                $_SESSION['msg_pregunta'] = "✓ Pregunta eliminada correctamente.";
            } else {
                $_SESSION['msg_pregunta'] = "⚠ No se encontró la pregunta con ID: $id";
            }
        } catch (PDOException $e) {
            $_SESSION['msg_pregunta'] = "✗ Error al eliminar la pregunta: " . $e->getMessage();
        }
    } else {
        $_SESSION['msg_pregunta'] = "✗ ID inválido.";
    }

    // Mantener la página y busqueda actual
    $url = "../../frontend/views/eliminarpregunta.php?pagina=$pagina_actual";
    if ($buscar) {
        $url .= "&buscar=" . urlencode($buscar);
    }
    
    header("Location: $url");
    exit();
}
?>