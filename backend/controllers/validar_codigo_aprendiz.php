<?php
// backend/controllers/validar_codigo_aprendiz.php
session_start();
require_once __DIR__ . '/../models/CodigoAccesoModel.php';

// Verificar que el aprendiz haya iniciado sesión
if (!isset($_SESSION["aprendiz"])) {
    header("Location: ../../frontend/views/login_aprendiz.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = trim($_POST["codigo"]);
    
    // Validar que no esté vacío
    if (empty($codigo)) {
        header("Location: ../../frontend/views/validar_codigo.php?error=vacio");
        exit();
    }
    
    // Validar el código
    $codigoModel = new CodigoAccesoModel();
    $codigoValido = $codigoModel->validarCodigo($codigo);
    
    if ($codigoValido) {
        // Guardar en sesión que el código fue validado
        $_SESSION["codigo_validado"] = true;
        $_SESSION["codigo_usado"] = $codigo;
        
        // Redirigir al juego
        header("Location: PreguntasController.php");
        exit();
    } else {
        // Código inválido
        header("Location: ../../frontend/views/validar_codigo.php?error=invalido");
        exit();
    }
} else {
    header("Location: ../../frontend/views/validar_codigo.php");
    exit();
}
?>