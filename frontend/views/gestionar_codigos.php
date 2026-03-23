<?php
// frontend/views/admin/gestionar_codigos.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Códigos de Acceso</title>
    <link rel="stylesheet" href="../../frontend/css/gestionCodigo.css">
    <link rel="icon" href="../../frontend/media/sena logo.png">
    <style>
        
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔑 Códigos de Acceso</h1>
            <div class="header-buttons">
                <a href="../../backend/controllers/GenerarCodigoController.php?accion=generar" class="btn btn-primary">🎲 Generar Nuevo Código</a>
                <a href="../../frontend/views/menuOpciones.php" class="btn btn-secondary"> Volver al Menú</a>
            </div>
        </div>

        <?php if (isset($_GET['success']) && $_GET['success'] === 'generado' && isset($_GET['codigo'])): ?>
            <div class="alert alert-success">
                 <strong>¡Código generado exitosamente!</strong><br><br>
                <div class="codigo-destacado"><?php echo htmlspecialchars($_GET['codigo']); ?></div>
                <p style="margin-top: 10px;">Comparte este código con los aprendices</p>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['success']) && $_GET['success'] === 'eliminado'): ?>
            <div class="alert alert-success">
                 Código eliminado exitosamente
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-error">
                 Error al procesar la solicitud
            </div>
        <?php endif; ?>

        <div class="instrucciones">
            <h3> Instrucciones:</h3>
            <ol>
                <li>Haz clic en "Generar Nuevo Código" para crear un código de acceso</li>
                <li>Comparte el código de 6 dígitos con los aprendices</li>
                <li>Los aprendices deberán ingresar este código para acceder al juego</li>
                <li>Puedes generar múltiples códigos simultáneamente</li>
                <li>Elimina códigos antiguos cuando ya no los necesites</li>
            </ol>
        </div>

        <?php if (empty($codigos)): ?>
            <div class="empty-state">
                <h2> No hay códigos activos</h2>
                <p>Genera un código para que los aprendices puedan acceder al juego</p>
            </div>
        <?php else: ?>
            <div class="codigos-grid">
                <?php foreach ($codigos as $codigo): ?>
                    <div class="codigo-card">
                        <button class="btn-eliminar" 
                                onclick="if(confirm('¿Eliminar este código?')) window.location.href='../../backend/controllers/GenerarCodigoController.php?accion=eliminar&id=<?php echo $codigo['ID_codigoAcesso']; ?>'">
                            ×
                        </button>
                        <div>📌</div>
                        <div class="codigo-numero"><?php echo htmlspecialchars($codigo['codigo_codigoAcesso']); ?></div>
                        <div class="codigo-fecha">
                            Creado: <?php echo date('d/m/Y', strtotime($codigo['fecha_codigoAcesso'])); ?>
                        </div>
                        <div class="codigo-estado">✓ Activo</div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>