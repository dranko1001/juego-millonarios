<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login_administrador.php");
    exit();
}

$nombre_admin = $_SESSION["admin"];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Millonarios SENA</title>
    <link rel="stylesheet" href="../css/menuOpciones.css">

    <!-- SweetAlert2 para alertas bonitas -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                <a href="../../backend/controllers/GenerarCodigoController.php?accion=listar" class="btn btn-yellow"
                    data-icon="🔑">
                    Cambiar Código
                </a>

                <a href="crearpregunta.php" class="btn btn-yellow" data-icon="❓">
                    Editar Preguntas
                </a>

                <a href="agregaradmi.php" class="btn btn-yellow" data-icon="👤">
                    + Agregar Cuenta
                </a>
                <button onclick="limpiarJugadores()" class="btn btn-danger" data-icon="🗑️">
                    Limpiar Jugadores
                </button>

                <a href="menu.php" class="btn btn-gris btn-full" >
                    Volver al Menú
                </a>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="../js/limpiarJugadores.js"></script>
</body>

</html>