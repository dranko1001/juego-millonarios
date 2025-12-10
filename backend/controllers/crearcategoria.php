<?php
session_start();

require_once __DIR__ . "/../models/pdoconexion.php";

$db = new PDOConnection();
$pdo = $db->getConexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_categoria'])) {

    $nombre_categoria = trim($_POST['nombre_categoria'] ?? '');

    if ($nombre_categoria !== '') {

        try {
            $sql = "INSERT INTO tbl_categorias (nombre_categoria) VALUES (:nombre)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([":nombre" => $nombre_categoria]);

            $_SESSION['msg_categoria'] = "Categoría creada correctamente.";

        } catch (PDOException $e) {
            $_SESSION['msg_categoria'] = "Error al guardar: " . $e->getMessage();
        }

    } else {
        $_SESSION['msg_categoria'] = "Debes ingresar un nombre para la categoría.";
    }

    header("Location: ../../../../frontend/views/crearpregunta.php");
    exit();
}
?>
