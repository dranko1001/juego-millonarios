<?php

session_start();

// Proteger la página
if (!isset($_SESSION["admin_logueado"]) || $_SESSION["admin_logueado"] !== true) {
    header("Location: ../../frontend/views/login_administrador.php?error=sesion_expirada");
    exit();
}

require_once __DIR__ . '/../models/CodigoAccesoModel.php';

$codigoModel = new CodigoAccesoModel();
$accion = $_GET['accion'] ?? 'listar';

switch ($accion) {
    case 'listar':
        $codigos = $codigoModel->obtenerCodigosActivos();
        require_once __DIR__ . '/../../frontend/views/gestionar_codigos.php';
        break;
        
    case 'generar':
        $nuevoCodigo = $codigoModel->crearCodigo();
        if ($nuevoCodigo) {
            header("Location: GenerarCodigoController.php?accion=listar&success=generado&codigo=" . $nuevoCodigo);
        } else {
            header("Location: GenerarCodigoController.php?accion=listar&error=1");
        }
        exit();
        break;
        
    case 'eliminar':
        if (isset($_GET['id'])) {
            if ($codigoModel->eliminarCodigo($_GET['id'])) {
                header("Location: GenerarCodigoController.php?accion=listar&success=eliminado");
            } else {
                header("Location: GenerarCodigoController.php?accion=listar&error=1");
            }
        }
        exit();
        break;
        
    default:
        header("Location: GenerarCodigoController.php?accion=listar");
        exit();
}
?>