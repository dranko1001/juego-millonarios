<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¿Quién Quiere Ser Millonario? - Pregunta</title>
    <style>
        /* Estilos básicos para que se vea decente */
        body { font-family: Arial, sans-serif; }
        .contenedor-juego { max-width: 800px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; }
        .pregunta { font-size: 1.5em; margin-bottom: 30px; padding: 15px; background: #f0f0f0; border-radius: 5px; }
        .opcion { padding: 10px; margin: 10px 0; border: 1px solid #aaa; cursor: pointer; }
        .opcion:hover { background-color: #e0e0e0; }
        .respuesta-form { display: flex; flex-direction: column; }
    </style>
</head>
<body>

<div class="contenedor-juego">
    <h1>Pregunta Actual</h1>
    
    <?php if (!empty($pregunta['enunciado'])): ?>
        
        <div class="pregunta">
            <?php echo htmlspecialchars($pregunta['enunciado']); ?>
        </div>

        <form action="../controllers/ValidarRespuestaController.php" method="POST" class="respuesta-form">
            
            <?php foreach ($pregunta['opciones_mostradas'] as $letra => $textoOpcion): ?>
                <label class="opcion">
                    <input type="radio" name="respuesta_elegida" value="<?php echo htmlspecialchars($letra); ?>" required>
                    **<?php echo htmlspecialchars($letra); ?>:** <?php echo htmlspecialchars($textoOpcion); ?>
                </label>
            <?php endforeach; ?>

            <input type="hidden" name="id_pregunta" value="<?php echo htmlspecialchars($datosPregunta['ID_pregunta']); ?>">
            <button type="submit" style="margin-top: 20px; padding: 10px 20px;">Responder</button>
        </form>

    <?php else: ?>
        <p>Hubo un error al cargar la pregunta o no hay preguntas disponibles.</p>
    <?php endif; ?>

</div>

</body>
</html>