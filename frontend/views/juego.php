<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Quién Quiere Ser Millonario? - SENA</title>
    <link rel="stylesheet" href="/frontend/css/juego.css">
    
    <!-- ✅ Script del temporizador -->
    <script>
        let tiempoRestante = <?php echo isset($_SESSION['tiempo_limite_segundos']) ? $_SESSION['tiempo_limite_segundos'] : 120; ?>;
        let tiempoInicio = <?php echo isset($_SESSION['tiempo_inicio_pregunta']) ? $_SESSION['tiempo_inicio_pregunta'] : time(); ?>;
        let tiempoTranscurrido = Math.floor(Date.now() / 1000) - tiempoInicio;
        tiempoRestante = Math.max(0, tiempoRestante - tiempoTranscurrido);
        
        let intervalo;
        let formSubmitted = false;
        
        function actualizarTemporizador() {
            if (tiempoRestante <= 0) {
                clearInterval(intervalo);
                if (!formSubmitted) {
                    // Tiempo agotado - enviar formulario automáticamente con respuesta vacía
                    document.getElementById('tiempo-agotado-form').submit();
                }
                return;
            }
            
            let minutos = Math.floor(tiempoRestante / 60);
            let segundos = tiempoRestante % 60;
            
            let displayTiempo = minutos.toString().padStart(2, '0') + ':' + segundos.toString().padStart(2, '0');
            document.getElementById('temporizador').textContent = displayTiempo;
            
            // Cambiar color según el tiempo restante
            let temporizadorDiv = document.getElementById('temporizador-container');
            if (tiempoRestante <= 30) {
                temporizadorDiv.style.background = 'linear-gradient(135deg, #dc3545 0%, #c82333 100%)';
                temporizadorDiv.style.animation = 'pulse 1s infinite';
            } else if (tiempoRestante <= 60) {
                temporizadorDiv.style.background = 'linear-gradient(135deg, #ffc107 0%, #ff9800 100%)';
            }
            
            tiempoRestante--;
        }
        
        window.addEventListener('DOMContentLoaded', function() {
            actualizarTemporizador();
            intervalo = setInterval(actualizarTemporizador, 1000);
            
            // Marcar cuando se envía el formulario
            const form = document.querySelector('.answers-form');
            if (form) {
                form.addEventListener('submit', function() {
                    formSubmitted = true;
                    clearInterval(intervalo);
                });
            }
        });
        
        // Advertencia al recargar
        window.addEventListener('beforeunload', function (e) {
            if (!formSubmitted) {
                e.preventDefault();
                e.returnValue = '¿Seguro que quieres recargar? La pregunta seguirá siendo la misma.';
                return e.returnValue;
            }
        });
    </script>
    
    <style>
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
    </style>
</head>
<body>

<!-- ✅ Formulario oculto para envío automático cuando se agota el tiempo -->
<form id="tiempo-agotado-form" action="../controllers/TiempoAgotadoController.php" method="POST" style="display: none;">
    <input type="hidden" name="tiempo_agotado" value="1">
</form>

<div class="game-container">
    <div class="header">
        <h1>¡¿Quién Quiere Ser Millonario?!</h1>
        
        <!-- ✅ NUEVO: Temporizador -->
        <div id="temporizador-container" style="background: linear-gradient(135deg, #39B54A 0%, #00A14B 100%); padding: 15px 25px; border-radius: 15px; margin-top: 10px; display: inline-block; border: 3px solid white; box-shadow: 0 5px 20px rgba(57, 181, 74, 0.4); transition: all 0.3s ease;">
            <p style="margin: 0; font-size: 1.5em; font-weight: 900; color: white; font-family: 'Courier New', monospace; letter-spacing: 3px;">
                ⏱️ <span id="temporizador">02:00</span>
            </p>
        </div>
        
        <?php if (isset($_SESSION['categoria_nombre'])): ?>
            <div style="background: rgba(255,215,0,0.2); padding: 10px; border-radius: 10px; margin-top: 10px; display: inline-block;">
                <p style="margin: 0; font-size: 1.1em; font-weight: 600;">
                    📚 Categoría: <?php echo htmlspecialchars($_SESSION['categoria_nombre']); ?>
                </p>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['preguntas_correctas']) && isset($_SESSION['puntaje_pesos'])): ?>
            <div style="background: rgba(57,181,74,0.2); padding: 8px 15px; border-radius: 10px; margin-top: 8px; display: inline-block;">
                <p style="margin: 0; font-size: 1em; font-weight: 600; color: white;">
                    ✅ Correctas: <?php echo $_SESSION['preguntas_correctas']; ?> | 💰 $<?php echo number_format($_SESSION['puntaje_pesos']); ?>
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

            <div style="margin-top: 20px; width: 100%; display: flex; flex-direction: column; gap: 10px;">
                <a href="reiniciar.php?cambiar_categoria=1" 
                   onclick="return confirm('¿Seguro que deseas cambiar de categoría? Se reiniciará tu progreso y perderás tu puntaje actual.')"
                   style="display: block; background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%); 
                          color: #1a1a1a; text-decoration: none; padding: 12px 15px; 
                          border-radius: 12px; text-align: center; font-weight: 700; 
                          font-size: 0.9em; border: 3px solid white; 
                          box-shadow: 0 5px 15px rgba(255, 165, 0, 0.3);
                          transition: all 0.3s ease;">
                    🔄 Cambiar Categoría
                </a>
                
                <a href="../../backend/controllers/logout.php" 
                   onclick="return confirm('¿Seguro que deseas salir? Tu puntaje actual se guardará.')"
                   style="display: block; background: linear-gradient(135deg, #6c757d 0%, #495057 100%); 
                          color: white; text-decoration: none; padding: 12px 15px; 
                          border-radius: 12px; text-align: center; font-weight: 700; 
                          font-size: 0.9em; border: 3px solid white; 
                          box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
                          transition: all 0.3s ease;">
                    🚪 Salir y Guardar
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