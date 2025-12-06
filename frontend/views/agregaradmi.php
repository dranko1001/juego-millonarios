<?php
session_start();

if (!isset($_SESSION["admin"]) || empty($_SESSION["admin"])) {
    header("Location: login_administrador.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Agregar Administrador</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/agregaradmin.css">
</head>
<body>

<div class="main-container">

    <div class="form-box shadow">

        <h2 class="title">Crear Nuevo Administrador</h2>

        <form action="../../backend/controllers/crearadministrador_controller.php" method="POST">

            <div class="mb-3">
                <label>Usuario:</label>
                <input type="text" name="usuario" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Contraseña:</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">Crear Administrador</button>

        </form>

        <a href="./menuOpciones.php" class="btn btn-secondary w-100 mt-4">Volver</a>

    </div>

</div>

</body>
</html>
