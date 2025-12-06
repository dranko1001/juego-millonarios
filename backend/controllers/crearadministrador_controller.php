<?php
require_once __DIR__ . "/../models/pdoconexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $usuario = trim($_POST["usuario"]);
    $password = trim($_POST["password"]);

    if (empty($usuario) || empty($password)) {
        die("Error: Debes llenar todos los campos.");
    }

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    $db = new PDOConnection();
    $pdo = $db->getConexion();

    $sql = "INSERT INTO tbl_administradores (usuario_administrador, password_administrador)
            VALUES (:user, :pass)";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        ':user' => $usuario,
        ':pass' => $passwordHash
    ])) {
        header("Location: ../../../../frontend/views/agregaradmi.php");
        exit();
    } else {
        echo "Error al crear administrador.";
    }
}
?>


