<?php
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

    // BUSCAR SOLO POR USUARIO
    $sql = "SELECT * FROM tbl_administradores 
            WHERE usuario_administrador = :usuario
            LIMIT 1";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() == 1) { 
            
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            //este es para que la contraseña que esta encriptada se pueda validar
            if (password_verify($password, $admin["password_administrador"])) {

                // Guardar en sesión
                $_SESSION["admin"] = $admin['usuario_administrador'];
                $_SESSION["admin_id"] = $admin['ID_administrador'];
                $_SESSION["admin_logueado"] = true;

                // Página a donde va el admin
                header("Location: ../../frontend/views/menu.php");
                exit();

            } else {
                // Contraseña incorrecta
                header("Location: ../../frontend/views/login_administrador.php?error=credenciales");
                exit();
            }

        } else {
            // Usuario no encontrado
            header("Location: ../../frontend/views/login_administrador.php?error=credenciales");
            exit();
        }
        
    } catch (PDOException $e) {
        error_log("Error de login: " . $e->getMessage());
        header("Location: ../../frontend/views/login_administrador.php?error=db_error");
        exit();
    }

} else {
    header("Location: ../../frontend/views/login_administrador.php");
    exit();
}
?>
