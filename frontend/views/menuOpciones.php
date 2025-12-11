<?php
session_start();

// protege la pagina  si no hay sesión de admin, redirigir al login
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
    <title>Panel de Administración - Millonarios SENA</title>
    <link rel="stylesheet" href="../css/menuOpciones.css">
</head>

<body>
    <div class="container">
        <!-- Header del administrador -->
        <div class="admin-header" style="text-align: right; padding: 25px 40px;">
            <span>¿Qué deseas editar?, <strong><?php echo htmlspecialchars($nombre_admin); ?></strong></span>
        </div>
        
        <!-- Contenido principal del panel -->
        <div class="panel-content">
            <h1 class="title">Configuraciones</h1>
            <p class="subtitle">Panel de administración del sistema</p>
            
            <!-- data icons para una mejor estetica -->
            <div class="buttons-container">
                <a href="../../backend/controllers/GenerarCodigoController.php?accion=listar" class="btn btn-yellow" data-icon="🔑">
                    Cambiar Código
                </a>
                
                <a href="crearpregunta.php" class="btn btn-yellow" data-icon="❓">
                    Editar Preguntas
                </a>
                
                <a href="agregaradmi.php" class="btn btn-yellow" data-icon="👤">
                    + Agregar Cuenta
                </a>
                
                <a href="menu.php" class="btn btn-gris btn-full" data-icon="↩️">
                    Volver al Menú
                </a>
            </div>
        </div>
    </div>
</body>
</html>