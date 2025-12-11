<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Quién Quiere Ser Millonario? - SENA</title>
    <link rel="stylesheet" href="../../frontend/css/juego.css">

    <!-- ✅ SWEETALERT2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* ✅ ESTILOS PARA COMODINES */
        .lifeline {
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .lifeline:hover:not(.usado) {
            transform: scale(1.1);
            filter: brightness(1.2);
        }

        .lifeline.usado {
            opacity: 0.3;
            cursor: not-allowed;
            filter: grayscale(100%);
        }

        .lifeline.usado::after {
            content: '✗';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 3em;
            color: red;
            font-weight: bold;
        }

        /* Opciones eliminadas por 50/50 */
        .answer-btn.eliminada {
            opacity: 0.3;
            pointer-events: none;
            text-decoration: line-through;
            background: linear-gradient(135deg, #666 0%, #444 100%) !important;
        }

        /* Modal de Ayuda del Público */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            max-width: 500px;
            border: 5px solid white;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        .modal-content h2 {
            color: white;
            font-size: 2em;
            margin-bottom: 20px;
        }

        .modal-timer {
            font-size: 4em;
            color: #FFD700;
            font-weight: bold;
            margin: 20px 0;
            font-family: 'Courier New', monospace;
        }

        .modal-btn {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            color: #1a1a1a;
            border: none;
            padding: 15px 40px;
            font-size: 1.2em;
            font-weight: bold;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        .modal-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 20px rgba(255, 215, 0, 0.5);
        }

        /* ✅ PERSONALIZAR SWEETALERT2 */
        .swal2-popup {
            font-size: 1.2rem;
            border-radius: 20px;
        }

        .swal2-title {
            font-size: 2em;
            font-weight: bold;
        }

        .swal2-html-container {
            font-size: 1.1em;
        }

        .swal2-confirm {
            background: linear-gradient(135deg, #39B54A 0%, #00A14B 100%) !important;
            padding: 12px 30px !important;
            font-size: 1.1em !important;
            border-radius: 10px !important;
            font-weight: bold !important;
        }

        .swal2-cancel {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
            padding: 12px 30px !important;
            font-size: 1.1em !important;
            border-radius: 10px !important;
            font-weight: bold !important;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }
    </style>

    <script>
        // ============================================
        // VARIABLES GLOBALES DEL TEMPORIZADOR
        // ============================================
        let tiempoRestante = <?php echo isset($_SESSION['tiempo_limite_segundos']) ? $_SESSION['tiempo_limite_segundos'] : 120; ?>;
        let tiempoInicio = <?php echo isset($_SESSION['tiempo_inicio_pregunta']) ? $_SESSION['tiempo_inicio_pregunta'] : time(); ?>;
        let tiempoTranscurrido = Math.floor(Date.now() / 1000) - tiempoInicio;
        tiempoRestante = Math.max(0, tiempoRestante - tiempoTranscurrido);

        let intervalo;
        let formSubmitted = false;
        let tiempoDetenido = false;

        // Variables para ayuda del público
        let tiempoAyudaPublico = 60; // 1 minuto
        let intervaloAyudaPublico;

        // Variables para llamada a un amigo
        let tiempoLlamadaAmigo = 30; // 30 segundos
        let intervaloLlamadaAmigo;
        let audioLlamada;

        // ============================================
        // FUNCIÓN ACTUALIZAR TEMPORIZADOR
        // ============================================
        function actualizarTemporizador() {
            if (tiempoDetenido) return; // No actualizar si está detenido

            if (tiempoRestante <= 0) {
                clearInterval(intervalo);
                if (!formSubmitted) {
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

        // ============================================
        // FUNCIÓN DETENER TEMPORIZADOR
        // ============================================
        function detenerTemporizador() {
            tiempoDetenido = true;
        }

        // ============================================
        // FUNCIÓN REANUDAR TEMPORIZADOR
        // ============================================
        function reanudarTemporizador() {
            tiempoDetenido = false;
        }

        // ============================================
        // COMODÍN: 50/50
        // ============================================
        function usar5050() {
            if (document.getElementById('comodin-5050').classList.contains('usado')) {
                Swal.fire({
                    icon: 'error',
                    title: '¡Comodín ya usado!',
                    text: 'Ya utilizaste el comodín 50/50 en esta partida',
                    confirmButtonText: 'Entendido',
                    timer: 3000
                });
                return;
            }

            Swal.fire({
                title: '🎯 Comodín 50/50',
                text: '¿Deseas usar el comodín 50/50? Se eliminarán 2 respuestas incorrectas.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: '✅ Usar comodín',
                cancelButtonText: '❌ Cancelar',
                confirmButtonColor: '#39B54A',
                cancelButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Detener temporizador mientras procesa
                    detenerTemporizador();

                    // Mostrar loading
                    Swal.fire({
                        title: 'Eliminando respuestas...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    fetch('../../backend/controllers/ComodinController.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: 'tipo_comodin=cincuenta_cincuenta'
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.error,
                                    confirmButtonText: 'Entendido'
                                });
                                reanudarTemporizador();
                                return;
                            }

                            // Eliminar las opciones indicadas
                            data.opciones_eliminar.forEach(letra => {
                                const opcion = document.querySelector(`input[value="${letra}"]`);
                                if (opcion) {
                                    opcion.closest('.answer-btn').classList.add('eliminada');
                                    opcion.disabled = true;
                                }
                            });

                            // Marcar comodín como usado
                            document.getElementById('comodin-5050').classList.add('usado');

                            Swal.fire({
                                icon: 'success',
                                title: '¡Comodín usado!',
                                text: '2 respuestas incorrectas eliminadas',
                                timer: 2000,
                                showConfirmButton: false
                            });

                            reanudarTemporizador();
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Hubo un problema al usar el comodín',
                                confirmButtonText: 'Entendido'
                            });
                            reanudarTemporizador();
                        });
                }
            });
        }

        // ============================================
        // COMODÍN: CAMBIO DE PREGUNTA
        // ============================================
        function usarCambioPregunta() {
            if (document.getElementById('comodin-cambio').classList.contains('usado')) {
                Swal.fire({
                    icon: 'error',
                    title: '¡Comodín ya usado!',
                    text: 'Ya utilizaste el cambio de pregunta en esta partida',
                    confirmButtonText: 'Entendido',
                    timer: 3000
                });
                return;
            }

            Swal.fire({
                title: '🔄 Cambio de Pregunta',
                text: '¿Deseas cambiar la pregunta? Se mostrará una nueva pregunta de la misma dificultad.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: '✅ Cambiar pregunta',
                cancelButtonText: '❌ Cancelar',
                confirmButtonColor: '#39B54A',
                cancelButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Detener temporizador mientras procesa
                    detenerTemporizador();

                    // Mostrar loading
                    Swal.fire({
                        title: 'Buscando nueva pregunta...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    fetch('../../backend/controllers/ComodinController.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: 'tipo_comodin=cambio_pregunta'
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.error,
                                    confirmButtonText: 'Entendido'
                                });
                                reanudarTemporizador();
                                return;
                            }

                            // Actualizar la pregunta en pantalla
                            document.querySelector('.question-text').textContent = data.pregunta.enunciado;

                            // Actualizar las opciones
                            const letras = ['A', 'B', 'C', 'D'];
                            letras.forEach(letra => {
                                const input = document.querySelector(`input[value="${letra}"]`);
                                const span = input.nextElementSibling.nextElementSibling;
                                span.textContent = data.pregunta.opciones[letra];

                                // Limpiar selección y estados
                                input.checked = false;
                                input.closest('.answer-btn').classList.remove('eliminada');
                                input.disabled = false;
                            });

                            // Actualizar ID de pregunta en el formulario
                            document.querySelector('input[name="id_pregunta"]').value = data.pregunta.id_pregunta;

                            // Marcar comodín como usado
                            document.getElementById('comodin-cambio').classList.add('usado');

                            Swal.fire({
                                icon: 'success',
                                title: '¡Pregunta cambiada!',
                                text: 'El temporizador continúa desde donde estaba',
                                timer: 2500,
                                showConfirmButton: false
                            });

                            reanudarTemporizador();
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Hubo un problema al cambiar la pregunta',
                                confirmButtonText: 'Entendido'
                            });
                            reanudarTemporizador();
                        });
                }
            });
        }

        // ============================================
        // COMODÍN: AYUDA DEL PÚBLICO
        // ============================================
        function usarAyudaPublico() {
            if (document.getElementById('comodin-publico').classList.contains('usado')) {
                Swal.fire({
                    icon: 'error',
                    title: '¡Comodín ya usado!',
                    text: 'Ya utilizaste la ayuda del público en esta partida',
                    confirmButtonText: 'Entendido',
                    timer: 3000
                });
                return;
            }

            Swal.fire({
                title: '👥 Ayuda del Público',
                text: '¿Deseas usar la ayuda del público? Tendrás 1 minuto extra para pensar.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: '✅ Usar comodín',
                cancelButtonText: '❌ Cancelar',
                confirmButtonColor: '#39B54A',
                cancelButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Detener temporizador principal
                    detenerTemporizador();

                    fetch('../../backend/controllers/ComodinController.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: 'tipo_comodin=ayuda_publico'
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.error,
                                    confirmButtonText: 'Entendido'
                                });
                                reanudarTemporizador();
                                return;
                            }

                            // Marcar comodín como usado
                            document.getElementById('comodin-publico').classList.add('usado');

                            // Mostrar modal
                            mostrarModalAyudaPublico();
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Hubo un problema al usar el comodín',
                                confirmButtonText: 'Entendido'
                            });
                            reanudarTemporizador();
                        });
                }
            });
        }

        // ============================================
        // COMODÍN: LLAMADA A UN AMIGO
        // ============================================
        function usarLlamadaAmigo() {
            if (document.getElementById('comodin-llamada').classList.contains('usado')) {
                Swal.fire({
                    icon: 'error',
                    title: '¡Comodín ya usado!',
                    text: 'Ya utilizaste la llamada a un amigo en esta partida',
                    confirmButtonText: 'Entendido',
                    timer: 3000
                });
                return;
            }

            Swal.fire({
                title: '📞 Llamada a un Amigo',
                text: '¿Deseas llamar a un amigo? Tendrás 30 segundos extra para pensar.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: '✅ Llamar',
                cancelButtonText: '❌ Cancelar',
                confirmButtonColor: '#39B54A',
                cancelButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Detener temporizador principal
                    detenerTemporizador();

                    fetch('../../backend/controllers/ComodinController.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: 'tipo_comodin=llamada_amigo'
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.error,
                                    confirmButtonText: 'Entendido'
                                });
                                reanudarTemporizador();
                                return;
                            }

                            // Marcar comodín como usado
                            document.getElementById('comodin-llamada').classList.add('usado');

                            // Reproducir tono de llamada
                            reproducirTonoLlamada();

                            // Mostrar modal después del tono (3 segundos)
                            setTimeout(() => {
                                mostrarModalLlamadaAmigo();
                            }, 3000);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Hubo un problema al usar el comodín',
                                confirmButtonText: 'Entendido'
                            });
                            reanudarTemporizador();
                        });
                }
            });
        }

        // ============================================
        // REPRODUCIR TONO DE LLAMADA
        // ============================================
        function reproducirTonoLlamada() {
            // Mostrar SweetAlert de "Llamando..."
            Swal.fire({
                title: '📞 Llamando a un amigo...',
                html: '<div style="font-size: 3em;">📱</div>',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
                allowOutsideClick: false,
                didOpen: () => {
                    // Crear tono de llamada con Web Audio API
                    const audioContext = new (window.AudioContext || window.webkitAudioContext)();
                    const oscillator = audioContext.createOscillator();
                    const gainNode = audioContext.createGain();

                    oscillator.connect(gainNode);
                    gainNode.connect(audioContext.destination);

                    // Configurar tono (frecuencia típica de teléfono)
                    oscillator.frequency.value = 440; // Nota A4
                    gainNode.gain.value = 0.3; // Volumen

                    // Patrón de ring: 1 segundo on, 0.5 segundos off
                    oscillator.start();

                    setTimeout(() => oscillator.stop(), 800);
                    setTimeout(() => {
                        const osc2 = audioContext.createOscillator();
                        const gain2 = audioContext.createGain();
                        osc2.connect(gain2);
                        gain2.connect(audioContext.destination);
                        osc2.frequency.value = 440;
                        gain2.gain.value = 0.3;
                        osc2.start();
                        setTimeout(() => osc2.stop(), 800);
                    }, 1300);

                    setTimeout(() => {
                        const osc3 = audioContext.createOscillator();
                        const gain3 = audioContext.createGain();
                        osc3.connect(gain3);
                        gain3.connect(audioContext.destination);
                        osc3.frequency.value = 440;
                        gain3.gain.value = 0.3;
                        osc3.start();
                        setTimeout(() => osc3.stop(), 800);
                    }, 2200);
                }
            });
        }

        // ============================================
        // MODAL LLAMADA A UN AMIGO
        // ============================================
        function mostrarModalLlamadaAmigo() {
            const modal = document.getElementById('modal-llamada-amigo');
            modal.classList.add('active');

            tiempoLlamadaAmigo = 30;
            actualizarTimerLlamada();

            intervaloLlamadaAmigo = setInterval(() => {
                tiempoLlamadaAmigo--;
                actualizarTimerLlamada();

                if (tiempoLlamadaAmigo <= 0) {
                    cerrarModalLlamadaAmigo();
                }
            }, 1000);
        }

        function actualizarTimerLlamada() {
            const segundos = tiempoLlamadaAmigo;
            document.getElementById('timer-llamada').textContent =
                '00:' + segundos.toString().padStart(2, '0');
        }

        function cerrarModalLlamadaAmigo() {
            clearInterval(intervaloLlamadaAmigo);
            document.getElementById('modal-llamada-amigo').classList.remove('active');
            reanudarTemporizador();
        }

        // ============================================
        // MODAL AYUDA DEL PÚBLICO
        // ============================================
        function mostrarModalAyudaPublico() {
            const modal = document.getElementById('modal-ayuda-publico');
            modal.classList.add('active');

            tiempoAyudaPublico = 60;
            actualizarTimerAyuda();

            intervaloAyudaPublico = setInterval(() => {
                tiempoAyudaPublico--;
                actualizarTimerAyuda();

                if (tiempoAyudaPublico <= 0) {
                    cerrarModalAyudaPublico();
                }
            }, 1000);
        }

        function actualizarTimerAyuda() {
            const minutos = Math.floor(tiempoAyudaPublico / 60);
            const segundos = tiempoAyudaPublico % 60;
            document.getElementById('timer-ayuda').textContent =
                minutos.toString().padStart(2, '0') + ':' + segundos.toString().padStart(2, '0');
        }

        function cerrarModalAyudaPublico() {
            clearInterval(intervaloAyudaPublico);
            document.getElementById('modal-ayuda-publico').classList.remove('active');
            reanudarTemporizador();
        }

        // ============================================
        // INICIALIZACIÓN
        // ============================================
        window.addEventListener('DOMContentLoaded', function () {
            actualizarTemporizador();
            intervalo = setInterval(actualizarTemporizador, 1000);

            // Marcar comodines usados desde PHP
            <?php if (isset($_SESSION['comodines'])): ?>
                <?php if (!$_SESSION['comodines']['cincuenta_cincuenta']): ?>
                    document.getElementById('comodin-5050').classList.add('usado');
                <?php endif; ?>

                <?php if (!$_SESSION['comodines']['cambio_pregunta']): ?>
                    document.getElementById('comodin-cambio').classList.add('usado');
                <?php endif; ?>

                <?php if (!$_SESSION['comodines']['ayuda_publico']): ?>
                    document.getElementById('comodin-publico').classList.add('usado');
                <?php endif; ?>

                <?php if (!$_SESSION['comodines']['llamada_amigo']): ?>
                    document.getElementById('comodin-llamada').classList.add('usado');
                <?php endif; ?>
            <?php endif; ?>

            // Marcar cuando se envía el formulario
            const form = document.querySelector('.answers-form');
            if (form) {
                form.addEventListener('submit', function () {
                    formSubmitted = true;
                    clearInterval(intervalo);
                });
            }
        });
    </script>
</head>

<body>

    <!-- Formulario oculto para envío automático cuando se agota el tiempo -->
    <form id="tiempo-agotado-form" action="../controllers/TiempoAgotadoController.php" method="POST"
        style="display: none;">
        <input type="hidden" name="tiempo_agotado" value="1">
    </form>

    <!-- ✅ MODAL AYUDA DEL PÚBLICO -->
    <div id="modal-ayuda-publico" class="modal-overlay">
        <div class="modal-content">
            <h2>👥 Ayuda del Público</h2>
            <p style="color: white; font-size: 1.2em;">¡Tienes 1 minuto extra para pensar!</p>
            <div class="modal-timer" id="timer-ayuda">01:00</div>
            <button class="modal-btn" onclick="cerrarModalAyudaPublico()">Continuar</button>
        </div>
    </div>

    <!-- ✅ MODAL LLAMADA A UN AMIGO -->
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
                        ✅ Correctas: <?php echo $_SESSION['preguntas_correctas']; ?> | 💰
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

                <!-- ✅ COMODINES ACTUALIZADOS -->
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
                        🔄 Cambiar Categoría
                    </a>

                    <a href="../../backend/controllers/logout.php"
                        onclick="return confirm('¿Seguro que deseas salir? Tu puntaje actual se guardará.')" style="display: block; background: linear-gradient(135deg, #6c757d 0%, #495057 100%); 
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