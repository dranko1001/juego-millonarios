<?php
// frontend/views/validar_codigo.php
session_start();

// Verificar que el aprendiz haya iniciado sesión
if (!isset($_SESSION["aprendiz"])) {
    header("Location: login_aprendiz.php");
    exit();
}

$error_msg = "";
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'invalido':
            $error_msg = "Código incorrecto o no válido";
            break;
        case 'vacio':
            $error_msg = "Por favor ingrese un código";
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
    <title>Validar Código de Acceso</title>
    <link rel="stylesheet" href="../css/login.css">
    <style>
        .codigo-input {
            font-size: 2em;
            text-align: center;
            letter-spacing: 10px;
            font-weight: bold;
        }
        .info-box {
            background: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
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
    <form method="POST" action="../../backend/controllers/validar_codigo_aprendiz.php">
        <h2>🔐 Código de Acceso</h2>

        <div class="info-box">
            <strong>Bienvenido, <?php echo htmlspecialchars($_SESSION['aprendiz']); ?>!</strong><br>
            Solicita el código de acceso al instructor para continuar
        </div>

        <?php if (!empty($error_msg)): ?>
            <div class="error-message">
                ⚠️ <?php echo htmlspecialchars($error_msg); ?>
            </div>
        <?php endif; ?>

        <input 
            type="text" 
            name="codigo" 
            placeholder="000000" 
            required 
            maxlength="6"
            pattern="[0-9]{6}"
            class="codigo-input"
            autocomplete="off">

        <button type="submit">✓ Validar y Continuar</button>
        
        <a href="../../backend/controllers/logout.php" style="display: block; text-align: center; margin-top: 15px; color: #666; text-decoration: none;">
            ← Volver al inicio
        </a>
    </form>
</body>
</html>