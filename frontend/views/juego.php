<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Quién Quiere Ser Millonario? </title>
    <link rel="stylesheet" href="/frontend/css/juego.css"> 
    
</head>
<body>
<div class="game-container">
    <div class="header">
        <h1>¡¿Quién Quiere Ser Millonario?! </h1>
    </div>

    <div class="main-content">
        <div class="left-panel">
            <div class="logo-container">
                


                <img src="../../frontend/media/logo.jpg" alt="Logo SENA">
            </div>

            <div class="lifelines">
                <div class="lifeline" title="Pregunta al público">
                    <span class="lifeline-icon">👥</span>
                </div>
                <div class="lifeline" title="Llamar a un amigo">
                    <span class="lifeline-icon">📞</span>
                </div>
                <div class="lifeline" title="50:50">
                    <span class="lifeline-icon">50/50</span>
                </div>
            </div>
        </div>

        <div class="center-panel">
            <?php if (!empty($pregunta['enunciado']) && !empty($datosPregunta['ID_pregunta'])): ?>

                <div class="question-container">
                    <p class="question-text">
                        <?php echo htmlspecialchars($pregunta['enunciado']); ?>
                    </p>
                </div>

                <form action="../controllers/ValidarRespuestaController.php" method="POST" class="answers-form">
                    <div class="answers-grid">
                        <?php foreach ($pregunta['opciones_mostradas'] as $letra => $textoOpcion): ?>
                            <label class="answer-btn">
                                <input type="radio" name="respuesta_elegida" 
                                    value="<?php echo htmlspecialchars($letra); ?>" required style="display: none;">
                                <span class="answer-letter"><?php echo htmlspecialchars($letra); ?></span>
                                <span><?php echo htmlspecialchars($textoOpcion); ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                    
                    <input type="hidden" name="id_pregunta" value="<?php echo htmlspecialchars($datosPregunta['ID_pregunta']); ?>">
                    
                    <div class="action-buttons">
                        <button type="submit" class="next-btn">Responder</button>
                    </div>
                </form>

            <?php else: ?>
                <div class="question-container">
                    <p class="question-text">
                        Hubo un error al cargar la pregunta o no hay preguntas disponibles.
                    </p>
                </div>
            <?php endif; ?>
        </div>
        </div>
</div>
</body>
</html>