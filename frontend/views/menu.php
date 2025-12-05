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
    <title>Menú Administrador</title>
    <link rel="stylesheet" href="../css/menu.css">
</head>

<body>
    <div class="container">
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Administrador</title>
    <link rel="stylesheet" href="../css/menu.css">
</head>

<body>
   
        <!-- Mostrar nombre del administrador -->
        <div style="text-align: right; padding: 10px;">
            <span style="color: #666;">Bienvenido, <strong><?php echo htmlspecialchars($nombre_admin); ?></strong></span>
        </div>
        
        <h1 class="title">Menú de opciones</h1>
        <br>
        <div class="buttons-container">
            <a href="../../backend/controllers/PreguntasController.php" class="btn btn-primary">Iniciar juego </a>
            <button class="btn btn-primary">Reglas</button>
            <a href="../../backend/controllers/GenerarCodigoController.php?accion=listar" class="btn btn-yellow">Configuracion</a>
            <button class="btn btn-gris">Puntajes</button>
            <a href="../../backend/controllers/logout.php" class="btn btn-secondary btn-full">Cerrar sesión</a>
        </div>
   
</body>
</html>