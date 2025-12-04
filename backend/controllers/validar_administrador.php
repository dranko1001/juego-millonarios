<?php
require_once "../models/pdoconexion.php"; 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST["usuario"];
    $password = $_POST["password"]; 

    $db = new PDOConnection();
    $conn = $db->conectar(); 

    $sql = "SELECT * FROM tbl_administradores 
            WHERE usuario_administrador = :usuario 
            AND password_administrador = :password";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':password', $password);


        $stmt->execute();

        if ($stmt->rowCount() > 0) { 

            $_SESSION["admin"] = $usuario; 
            
            header("Location: ../../frontend/views/menu.html");
            exit();

        } else {
            
            header("Location: ../views/login_administrador.php?error=credenciales");
            exit();
        }
        
    } catch (PDOException $e) {

        header("Location: ../views/login_administrador.php?error=db_error");
        exit();
    }
}
?>