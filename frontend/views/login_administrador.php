<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrador</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

    <a href="login_aprendiz.php" class="btn-aprendiz">Aprendiz</a>

    <form method="POST" action="../../backend/controllers/validar_administrador.php">
        
        <input type="text" name="usuario" placeholder="Nombre de usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>

        <button type="submit">Ingresar</button>
    </form>

</body>
</html>
