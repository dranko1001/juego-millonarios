<?php
// backend/controllers/ComodinController.php
session_start();

// Verificar autenticación
if (!isset($_SESSION["aprendiz"]) || !isset($_SESSION["id_jugador"])) {
    echo json_encode(['error' => 'No autenticado']);
    exit();
}

require_once __DIR__ . '/../models/ComodinModel.php';

// Obtener el tipo de comodín solicitado
$tipoComodin = $_POST['tipo_comodin'] ?? $_GET['tipo_comodin'] ?? null;

if (!$tipoComodin) {
    echo json_encode(['error' => 'Tipo de comodín no especificado']);
    exit();
}

// Procesar según el tipo de comodín
switch ($tipoComodin) {

    case 'cincuenta_cincuenta':
        $resultado = ComodinModel::aplicarCincuentaCincuenta();
        echo json_encode($resultado);
        break;

    case 'cambio_pregunta':
        $resultado = ComodinModel::aplicarCambioPregunta();
        echo json_encode($resultado);
        break;

    case 'ayuda_publico':
        $resultado = ComodinModel::aplicarAyudaPublico();
        echo json_encode($resultado);
        break;

    default:
        echo json_encode(['error' => 'Comodín no válido']);
        break;
}
?>