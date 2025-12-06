<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Quién Quiere Ser Millonario? - SENA</title>
    <link rel="stylesheet" href="/frontend/css/juego.css">
</head>
<body>
<div class="game-container">
    <div class="header">
        <h1>¡¿Quién Quiere Ser Millonario?!</h1>
        <?php if (isset($_SESSION['categoria_nombre'])): ?>
            <div style="background: rgba(255,215,0,0.2); padding: 10px; border-radius: 10px; margin-top: 10px; display: inline-block;">
                <p style="margin: 0; font-size: 1.1em; font-weight: 600;">
                    📚 Categoría: <?php echo htmlspecialchars($_SESSION['categoria_nombre']); ?>
                </p>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['preguntas_correctas'])): ?>
            <div style="background: rgba(57,181,74,0.2); padding: 8px 15px; border-radius: 10px; margin-top: 8px; display: inline-block;">
                <p style="margin: 0; font-size: 1em; font-weight: 600; color: white;">
                    ✅ Correctas: <?php echo $_SESSION['preguntas_correctas']; ?>
                </p>
            </div>
        <?php endif; ?>
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

            <!-- Botón para cambiar categoría -->
            <div style="margin-top: 20px; width: 100%; display: flex; flex-direction: column; gap: 10px;">
                <a href="reiniciar.php?cambiar_categoria=1" 
                   onclick="return confirm('¿Seguro que deseas cambiar de categoría? Se reiniciará tu progreso.')"
                   style="display: block; background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%); 
                          color: #1a1a1a; text-decoration: none; padding: 12px 15px; 
                          border-radius: 12px; text-align: center; font-weight: 700; 
                          font-size: 0.9em; border: 3px solid white; 
                          box-shadow: 0 5px 15px rgba(255, 165, 0, 0.3);
                          transition: all 0.3s ease;">
                    🔄 Cambiar Categoría
                </a>
                
                <a href="reiniciar.php" 
                   style="display: block; background: linear-gradient(135deg, #39B54A 0%, #00A14B 100%); 
                          color: white; text-decoration: none; padding: 12px 15px; 
                          border-radius: 12px; text-align: center; font-weight: 700; 
                          font-size: 0.9em; border: 3px solid white; 
                          box-shadow: 0 5px 15px rgba(57, 181, 74, 0.3);
                          transition: all 0.3s ease;">
                    🔄 Nueva Pregunta
                </a>
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
                        No hay preguntas disponibles para esta categoría.
                    </p>
                </div>
                <div class="action-buttons" style="margin-top: 20px;">
                    <a href="reiniciar.php?cambiar_categoria=1" class="next-btn" style="display: inline-block; text-decoration: none;">
                        Seleccionar otra categoría
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    /* Estilos para los botones adicionales */
    .left-panel a:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2) !important;
    }
    
    .left-panel a:active {
        transform: translateY(-1px);
    }
</style>
</body>
</html>