<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Quién Quiere Ser Millonario? - SENA</title>
    <link rel="stylesheet" href="../../frontend/css/juego.css">
    

    <!--  SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Variables PHP para JavaScript ( juego.js) -->
    <script>
        // Variables iniciales desde PHP
        window.juegoConfig = {
            tiempoLimite: <?php echo isset($_SESSION['tiempo_limite_segundos']) ? (int)$_SESSION['tiempo_limite_segundos'] : 120; ?>,
            tiempoInicio: <?php echo isset($_SESSION['tiempo_inicio_pregunta']) ? (int)$_SESSION['tiempo_inicio_pregunta'] : time(); ?>,
            comodines: {
                cincuenta_cincuenta: <?php 
                    echo (isset($_SESSION['comodines']) && isset($_SESSION['comodines']['cincuenta_cincuenta']) && $_SESSION['comodines']['cincuenta_cincuenta']) ? 'true' : 'false'; 
                ?>,
                cambio_pregunta: <?php 
                    echo (isset($_SESSION['comodines']) && isset($_SESSION['comodines']['cambio_pregunta']) && $_SESSION['comodines']['cambio_pregunta']) ? 'true' : 'false'; 
                ?>,
                ayuda_publico: <?php 
                    echo (isset($_SESSION['comodines']) && isset($_SESSION['comodines']['ayuda_publico']) && $_SESSION['comodines']['ayuda_publico']) ? 'true' : 'false'; 
                ?>,
                llamada_amigo: <?php 
                    echo (isset($_SESSION['comodines']) && isset($_SESSION['comodines']['llamada_amigo']) && $_SESSION['comodines']['llamada_amigo']) ? 'true' : 'false'; 
                ?>
            }
        };
        
        // Debug: Ver qué valores se están cargando
        // console.log('🎮 Configuración del juego cargada:', window.juegoConfig);
    </script>
    
    <!-- Archivo JavaScript principal (DESPUÉS de la configuración) -->
    <script src="../../frontend/js/juego.js"></script>

</head>

<body>

    <!-- Formulario oculto para envío automático cuando se agota el tiempo -->
    <form id="tiempo-agotado-form" action="../controllers/TiempoAgotadoController.php" method="POST"
        style="display: none;">
        <input type="hidden" name="tiempo_agotado" value="1">
    </form>

    <!-- MODAL AYUDA DEL PÚBLICO -->
    <div id="modal-ayuda-publico" class="modal-overlay">
        <div class="modal-content">
            <h2>👥 Ayuda del Público</h2>
            <p style="color: white; font-size: 1.2em;">¡Tienes 1 minuto extra para pensar!</p>
            <div class="modal-timer" id="timer-ayuda">01:00</div>
            <button class="modal-btn" onclick="cerrarModalAyudaPublico()">Continuar</button>
        </div>
    </div>

    <!-- MODAL LLAMADA A UN AMIGO -->
    <div id="modal-llamada-amigo" class="modal-overlay">
        <div class="modal-content" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <h2>📞 Llamada a un Amigo</h2>
            <p style="color: white; font-size: 1.2em;">¡Tienes 30 segundos extra para pensar!</p>
            <div class="modal-timer" id="timer-llamada">00:30</div>
            <button class="modal-btn" onclick="cerrarModalLlamadaAmigo()">Continuar</button>
        </div>
    </div>

    <div class="game-container">
        <div class="header">
            <h1>¡¿Quién Quiere Ser Millonario?!</h1>

            <!-- Temporizador -->
            <div id="temporizador-container"
                style="background: linear-gradient(135deg, #39B54A 0%, #00A14B 100%); padding: 15px 25px; border-radius: 15px; margin-top: 10px; display: inline-block; border: 3px solid white; box-shadow: 0 5px 20px rgba(57, 181, 74, 0.4); transition: all 0.3s ease;">
                <p
                    style="margin: 0; font-size: 1.5em; font-weight: 900; color: white; font-family: 'Courier New', monospace; letter-spacing: 3px;">
                    ⏱️ <span id="temporizador">02:00</span>
                </p>
            </div>

            <?php if (isset($_SESSION['categoria_nombre'])): ?>
                <div
                    style="background: rgba(255,215,0,0.2); padding: 10px; border-radius: 10px; margin-top: 10px; display: inline-block;">
                    <p style="margin: 0; font-size: 1.1em; font-weight: 600;">
                        📚 Categoría: <?php echo htmlspecialchars($_SESSION['categoria_nombre']); ?>
                    </p>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['preguntas_correctas']) && isset($_SESSION['puntaje_pesos'])): ?>
                <div
                    style="background: rgba(57,181,74,0.2); padding: 8px 15px; border-radius: 10px; margin-top: 8px; display: inline-block;">
                    <p style="margin: 0; font-size: 1em; font-weight: 600; color: white;">
                         Correctas: <?php echo $_SESSION['preguntas_correctas']; ?> | 💰
                        $<?php echo number_format($_SESSION['puntaje_pesos']); ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>

        <div class="main-content">
            <div class="left-panel">
                <div class="logo-container">
                    <img src="../../frontend/media/logo.jpg" alt="Logo SENA">
                </div>

                <!--  COMODINES -->
                <div class="lifelines">
                    <div class="lifeline" id="comodin-publico" title="Ayuda del público - 1 minuto extra"
                        onclick="usarAyudaPublico()">
                        <span class="lifeline-icon">👥</span>
                    </div>
                    <div class="lifeline" id="comodin-llamada" title="Llamada a un amigo - 30 segundos extra"
                        onclick="usarLlamadaAmigo()">
                        <span class="lifeline-icon">📞</span>
                    </div>
                    <div class="lifeline" id="comodin-cambio" title="Cambiar pregunta" onclick="usarCambioPregunta()">
                        <span class="lifeline-icon">🔄</span>
                    </div>
                    <div class="lifeline" id="comodin-5050" title="Eliminar 2 respuestas incorrectas"
                        onclick="usar5050()">
                        <span class="lifeline-icon">50/50</span>
                    </div>
                </div>

                <div style="margin-top: 20px; width: 100%; display: flex; flex-direction: column; gap: 10px;">
                    <a href="../../frontend/views/seleccionar_categoria.php"
                        onclick="return confirm('¿Seguro que deseas cambiar de categoría? Se reiniciará tu progreso y perderás tu puntaje actual.')"
                        style="display: block; background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%); 
                          color: #1a1a1a; text-decoration: none; padding: 12px 15px; 
                          border-radius: 12px; text-align: center; font-weight: 700; 
                          font-size: 0.9em; border: 3px solid white; 
                          box-shadow: 0 5px 15px rgba(255, 165, 0, 0.3);
                          transition: all 0.3s ease;">
                         Cambiar Categoría
                    </a>

                    <a href="../../backend/controllers/logout.php"
                        onclick="return confirm('¿Seguro que deseas salir? Tu puntaje actual se guardará.')" style="display: block; background: linear-gradient(135deg, #6c757d 0%, #495057 100%); 
                          color: white; text-decoration: none; padding: 12px 15px; 
                          border-radius: 12px; text-align: center; font-weight: 700; 
                          font-size: 0.9em; border: 3px solid white; 
                          box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
                          transition: all 0.3s ease;">
                         Salir y Guardar
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
                                    <input type="radio" name="respuesta_elegida" value="<?php echo htmlspecialchars($letra); ?>"
                                        required style="display: none;">
                                    <span class="answer-letter"><?php echo htmlspecialchars($letra); ?></span>
                                    <span><?php echo htmlspecialchars($textoOpcion); ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>

                        <input type="hidden" name="id_pregunta"
                            value="<?php echo htmlspecialchars($datosPregunta['ID_pregunta']); ?>">

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
                        <a href="reiniciar.php?cambiar_categoria=1" class="next-btn"
                            style="display: inline-block; text-decoration: none;">
                            Seleccionar otra categoría
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="../js/juego.js"></script>
</body>

</html>