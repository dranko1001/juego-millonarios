<?php
// frontend/views/admin/gestionar_codigos.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Códigos de Acceso</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #eee;
        }
        h1 {
            color: #333;
        }
        .btn {
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            display: inline-block;
        }
        .btn-primary {
            background: #28a745;
            color: white;
        }
        .btn-primary:hover {
            background: #218838;
            transform: translateY(-2px);
        }
        .btn-secondary {
            background: #007bff;
            color: white;
            margin-left: 10px;
        }
        .btn-secondary:hover {
            background: #0056b3;
        }
        .btn-danger {
            background: #dc3545;
            color: white;
            padding: 8px 15px;
            font-size: 0.9em;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .codigo-destacado {
            font-size: 2em;
            font-weight: bold;
            color: #28a745;
            letter-spacing: 3px;
        }
        .codigos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .codigo-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            position: relative;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .codigo-numero {
            font-size: 2em;
            font-weight: bold;
            letter-spacing: 3px;
            margin: 15px 0;
        }
        .codigo-fecha {
            font-size: 0.9em;
            opacity: 0.9;
        }
        .codigo-estado {
            background: #28a745;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.85em;
            display: inline-block;
            margin-top: 10px;
        }
        .btn-eliminar {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(220, 53, 69, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
            font-size: 1.2em;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-eliminar:hover {
            background: #c82333;
        }
        .empty-state {
            text-align: center;
            padding: 50px;
            color: #666;
        }
        .instrucciones {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            border-left: 4px solid #667eea;
        }
        .instrucciones h3 {
            color: #667eea;
            margin-bottom: 10px;
        }
        .instrucciones ol {
            margin-left: 20px;
            line-height: 1.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔑 Códigos de Acceso</h1>
            <div>
                <a href="../../backend/controllers/GenerarCodigoController.php?accion=generar" class="btn btn-primary">🎲 Generar Nuevo Código</a>
                <a href="menu.php" class="btn btn-secondary">🏠 Volver al Menú</a>
            </div>
        </div>

        <?php if (isset($_GET['success']) && $_GET['success'] === 'generado' && isset($_GET['codigo'])): ?>
            <div class="alert alert-success">
                ✅ <strong>¡Código generado exitosamente!</strong><br><br>
                <div class="codigo-destacado"><?php echo htmlspecialchars($_GET['codigo']); ?></div>
                <p style="margin-top: 10px;">Comparte este código con los aprendices</p>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['success']) && $_GET['success'] === 'eliminado'): ?>
            <div class="alert alert-success">
                ✅ Código eliminado exitosamente
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-error">
                ⚠️ Error al procesar la solicitud
            </div>
        <?php endif; ?>

        <div class="instrucciones">
            <h3>📋 Instrucciones:</h3>
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
                <h2>🔓 No hay códigos activos</h2>
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