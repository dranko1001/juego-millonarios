<?php
session_start();

// Si ya está logueado, redirigir al menú
if (isset($_SESSION["admin_logueado"]) && $_SESSION["admin_logueado"] === true) {
    header("Location: menu.php");
    exit();
}

// Capturar mensajes de error
$error_msg = "";
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'credenciales':
            $error_msg = "Usuario o contraseña incorrectos";
            break;
        case 'campos_vacios':
            $error_msg = "Por favor complete todos los campos";
            break;
        case 'db_error':
            $error_msg = "Error de conexión. Intente más tarde";
            break;
        case 'sesion_expirada':
            $error_msg = "Su sesión ha expirado. Por favor inicie sesión nuevamente";
            break;
        default:
            $error_msg = "Error desconocido";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrador</title>
    <link rel="stylesheet" href="../css/login.css">
    <style>
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 15px;
            border: 1px solid #f5c6cb;
            text-align: center;
        }
    </style>
</head>
<body>
    
    <a href="login_aprendiz.php" class="btn-aprendiz">Aprendiz</a>

    <form method="POST" action="../../backend/controllers/validar_administrador.php">
        <h2>Iniciar Sesión </h2>

        <?php if (!empty($error_msg)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error_msg); ?>
            </div>
        <?php endif; ?>

        <input type="text" name="usuario" placeholder="Nombre de usuario" required autocomplete="username">
        <input type="password" name="password" placeholder="Contraseña" required autocomplete="current-password">

        <button type="submit">Ingresar</button>
    </form>

</body>
</html>