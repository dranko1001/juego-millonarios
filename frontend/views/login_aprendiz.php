<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Aprendiz</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>

    <a href="login_administrador.php" class="btn-aprendiz">Administrador</a>
    
    <form method="POST" action="../../backend/controllers/validar_aprendiz.php">
        <h2>Iniciar Sesión Aprendiz</h2>

        <input type="text" name="ficha" placeholder="Ficha" required>
        <input type="text" name="usuario_jugador" placeholder="ingrese su nombre" required>

        <button type="submit">Guardar</button>
    </form>

</body>
</html>
