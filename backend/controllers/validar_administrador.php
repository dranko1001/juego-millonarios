<?php
// backend/controllers/validar_administrador.php
require_once __DIR__ . "/../models/pdoconexion.php"; 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = trim($_POST["usuario"]);
    $password = trim($_POST["password"]); 

    // Validación básica
    if (empty($usuario) || empty($password)) {
        header("Location: ../../frontend/views/login_administrador.php?error=campos_vacios");
        exit();
    }

    $db = new PDOConnection();
    $conn = $db->conectar(); 

    $sql = "SELECT * FROM tbl_administradores 
            WHERE usuario_administrador = :usuario 
            AND password_administrador = :password";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        $stmt->execute();

        if ($stmt->rowCount() > 0) { 
            
            // Obtener datos del administrador
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            // Guardar en sesión
            $_SESSION["admin"] = $usuario;
            $_SESSION["admin_id"] = $admin['ID_administrador'];
            $_SESSION["admin_logueado"] = true;
            
            // Redirigir al menú PHP (no HTML)
            header("Location: ../../frontend/views/menu.php");
            exit();

        } else {
            
            header("Location: ../../frontend/views/login_administrador.php?error=credenciales");
            exit();
        }
        
    } catch (PDOException $e) {
        
        error_log("Error de login: " . $e->getMessage());
        header("Location: ../../frontend/views/login_administrador.php?error=db_error");
        exit();
    }
} else {
    // Si acceden directamente sin POST
    header("Location: ../../frontend/views/login_administrador.php");
    exit();
}
?>