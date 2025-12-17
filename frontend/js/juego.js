
//  VARIABLES GLOBALES DEL TEMPORIZADOR
let tiempoRestante;
let tiempoInicio;
let tiempoTranscurrido;
let intervalo;
let formSubmitted = false;
let tiempoDetenido = false;

// Variables para ayuda del público
let tiempoAyudaPublico = 60; // la pueden cambiar segun el tiempo que quieran
let intervaloAyudaPublico;

// Variables para llamada a un amigo
let tiempoLlamadaAmigo = 30; // tiempo de la llamada
let intervaloLlamadaAmigo;
let audioLlamada;

// Variable para almacenar el tiempo restante cuando se abre un modal
let tiempoRestanteAlAbrirModal = 0;

// 
// FUNCIÓN ACTUALIZAR TEMPORIZADOR
function actualizarTemporizador() {
    if (tiempoDetenido) return; 

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


// FUNCIÓN DETENER TEMPORIZADOR
function detenerTemporizador() {
    tiempoDetenido = true;
}


// FUNCIÓN DETENER TEMPORIZADOR
function reanudarTemporizador() {
    tiempoDetenido = false;
}


// COMODÍN: 50/50

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
//los emojis son parte de la estetica de los botones
    Swal.fire({
        title: ' Comodín 50/50',
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

            fetch('/backend/controllers/comodincontroller.php', {
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


// COMODÍN: CAMBIO DE PREGUNTA

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

            fetch('/backend/controllers/comodincontroller.php', {
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

// COMODÍN: AYUDA DEL PÚBLICO

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

            fetch('/backend/controllers/comodincontroller.php', {
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


// COMODÍN: LLAMADA A UN AMIGO

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

            fetch('/backend/controllers/comodincontroller.php', {
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


// REPRODUCIR TONO DE LLAMADA

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


function mostrarModalLlamadaAmigo() {
    const modal = document.getElementById('modal-llamada-amigo');
    modal.classList.add('active');

    // Guardar el tiempo restante actual antes de abrir el modal
    tiempoRestanteAlAbrirModal = tiempoRestante;
    
    // Asegurar que el temporizador principal esté detenido
    detenerTemporizador();
    clearInterval(intervalo);

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
    const timerElement = document.getElementById('timer-llamada');
    if (timerElement) {
        timerElement.textContent = '00:' + segundos.toString().padStart(2, '0');
        
        // Cambiar color cuando queda poco tiempo
        if (segundos <= 10) {
            timerElement.style.color = '#ff4444';
            timerElement.style.animation = 'pulse 0.5s infinite';
        } else {
            timerElement.style.color = '#FFD700';
            timerElement.style.animation = 'none';
        }
    }
}

function cerrarModalLlamadaAmigo() {
    clearInterval(intervaloLlamadaAmigo);
    document.getElementById('modal-llamada-amigo').classList.remove('active');
    
    // Restaurar el tiempo restante que tenía antes de abrir el modal
    // El tiempo del modal (30 segundos) no afecta el tiempo principal
    tiempoRestante = tiempoRestanteAlAbrirModal;
    
    // Reanudar el temporizador principal
    reanudarTemporizador();
    actualizarTemporizador();
    intervalo = setInterval(actualizarTemporizador, 1000);
}

// MODAL AYUDA DEL PÚBLICO

function mostrarModalAyudaPublico() {
    const modal = document.getElementById('modal-ayuda-publico');
    modal.classList.add('active');

    // Guardar el tiempo restante actual antes de abrir el modal
    tiempoRestanteAlAbrirModal = tiempoRestante;
    
    // Asegurar que el temporizador principal esté detenido
    detenerTemporizador();
    clearInterval(intervalo);

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
    const timerElement = document.getElementById('timer-ayuda');
    if (timerElement) {
        timerElement.textContent = minutos.toString().padStart(2, '0') + ':' + segundos.toString().padStart(2, '0');
        
        // Cambiar color cuando queda poco tiempo
        if (tiempoAyudaPublico <= 10) {
            timerElement.style.color = '#ff4444';
            timerElement.style.animation = 'pulse 0.5s infinite';
        } else {
            timerElement.style.color = '#FFD700';
            timerElement.style.animation = 'none';
        }
    }
}

function cerrarModalAyudaPublico() {
    clearInterval(intervaloAyudaPublico);
    document.getElementById('modal-ayuda-publico').classList.remove('active');
    
    // Restaurar el tiempo restante que tenía antes de abrir el modal
    // El tiempo del modal (60 segundos) no afecta el tiempo principal
    tiempoRestante = tiempoRestanteAlAbrirModal;
    
    // Reanudar el temporizador principal
    reanudarTemporizador();
    actualizarTemporizador();
    intervalo = setInterval(actualizarTemporizador, 1000);
}


// INICIALIZACIÓN

function inicializarJuego() {
    //  Verificar que la configuración exista
    if (!window.juegoConfig) {
        console.error('❌ ERROR: window.juegoConfig no está definido');
        console.error('Asegúrate de que el script de configuración se cargue ANTES de juego.js');
        return;
    }

    // Cargar configuración desde PHP
    const config = window.juegoConfig;
    
    console.log(' Configuración cargada:', config);
    
    // Calcular tiempo restante
    tiempoRestante = config.tiempoLimite;
    tiempoInicio = config.tiempoInicio;
    tiempoTranscurrido = Math.floor(Date.now() / 1000) - tiempoInicio;
    tiempoRestante = Math.max(0, tiempoRestante - tiempoTranscurrido);

    // Asegurar que el tiempo restante no sea negativo o inválido
    if (isNaN(tiempoRestante) || tiempoRestante < 0) {
        tiempoRestante = config.tiempoLimite;
    }

    console.log(' Tiempo restante:', tiempoRestante, 'segundos');

    // Iniciar temporizador
    actualizarTemporizador();
    intervalo = setInterval(actualizarTemporizador, 1000);

    // Marcar comodines usados
    console.log(' Estado de comodines:', config.comodines);
    
    if (!config.comodines.cincuenta_cincuenta) {
        console.log('❌ 50/50 ya usado');
        document.getElementById('comodin-5050')?.classList.add('usado');
    }
    if (!config.comodines.cambio_pregunta) {
        console.log('❌ Cambio de pregunta ya usado');
        document.getElementById('comodin-cambio')?.classList.add('usado');
    }
    if (!config.comodines.ayuda_publico) {
        console.log('❌ Ayuda del público ya usada');
        document.getElementById('comodin-publico')?.classList.add('usado');
    }
    if (!config.comodines.llamada_amigo) {
        console.log('❌ Llamada a un amigo ya usada');
        document.getElementById('comodin-llamada')?.classList.add('usado');
    }

    // Marcar cuando se envía el formulario
    const form = document.querySelector('.answers-form');
    if (form) {
        form.addEventListener('submit', function () {
            formSubmitted = true;
            clearInterval(intervalo);
        });
    }
    
    console.log('✅ Juego inicializado correctamente');
}

// Ejecutar cuando el DOM esté listo
window.addEventListener('DOMContentLoaded', inicializarJuego);