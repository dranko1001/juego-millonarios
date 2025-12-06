<?php
session_start();

// Proteger la página: si no hay sesión de admin, redirigir al login
if (!isset($_SESSION["admin"])) {
    header("Location: login_administrador.php");
    exit();
}

// Obtener el nombre del administrador
$nombre_admin = $_SESSION["admin"];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de configuraciones del Administrador</title>
    <link rel="stylesheet" href="../css/menu.css">
</head>

<body>
    <div class="container">
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de configuraciones</title>
    <link rel="stylesheet" href="../css/menu.css">
</head>

<body>
   
        <!-- Mostrar nombre del administrador -->
        <div style="text-align: right; padding: 10px;">
            <span style="color: #666;">¿que deseas editar?, <strong><?php echo htmlspecialchars($nombre_admin); ?></strong></span>
        </div>
        
        <h1 class="title">Configuraciones</h1>
        <br>
        <div class="buttons-container">
            <a href="../../backend/controllers/GenerarCodigoController.php?accion=listar" class="btn btn-yellow btn-full">cambiar codigo</a>
            <a href="toca meter enlace aqui" class="btn btn-yellow btn-full">editar preguntas</a>
            <a href="toca meter enlace aqui" class="btn btn-yellow btn-full">+ agregar cuenta</a>
            <a href="menu.php" class="btn btn-gris btn-full">volver al menu</a>
        </div>
   
</body>
</html>