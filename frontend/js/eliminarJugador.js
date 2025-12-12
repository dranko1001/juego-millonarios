// ============================================
// INICIALIZAR EVENT LISTENERS AL CARGAR LA PÁGINA
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    // Agregar event listener a todos los botones de eliminar
    const botonesEliminar = document.querySelectorAll('.btn-eliminar');
    
    console.log('Total de botones encontrados:', botonesEliminar.length); // DEBUG
    
    botonesEliminar.forEach(boton => {
        boton.addEventListener('click', function() {
            // Probar diferentes formas de obtener el ID
            const idJugador = this.dataset.id || this.getAttribute('data-id');
            const nombreUsuario = this.dataset.nombre || this.getAttribute('data-nombre');
            
            // Debug: Verificar que se obtienen los datos
            console.log('Botón clickeado:', this);
            console.log('ID del jugador:', idJugador);
            console.log('Nombre del usuario:', nombreUsuario);
            console.log('Todos los atributos data:', this.dataset);
            
            if (!idJugador || idJugador === '0' || idJugador === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'ID de jugador no válido: ' + idJugador,
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#dc3545'
                });
                return;
            }
            
            eliminarJugador(idJugador, nombreUsuario);
        });
    });
});

// ============================================
// FUNCIÓN ELIMINAR JUGADOR CON SWEETALERT2
// ============================================

/**
 * Elimina un jugador del ranking con confirmación
 * @param {number} idJugador - ID del jugador a eliminar
 * @param {string} nombreUsuario - Nombre del usuario para mostrar en confirmación
 */
function eliminarJugador(idJugador, nombreUsuario) {
    console.log('=== INICIANDO ELIMINACIÓN ===');
    console.log('ID a eliminar:', idJugador, 'Tipo:', typeof idJugador);
    console.log('Nombre:', nombreUsuario);
    
    Swal.fire({
        title: '⚠️ ¿Estás seguro?',
        html: `¿Deseas eliminar al jugador <strong>"${nombreUsuario}"</strong>?<br><br>Esta acción no se puede deshacer.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '✅ Sí, eliminar',
        cancelButtonText: '❌ Cancelar',
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Mostrar loading
            Swal.fire({
                title: 'Eliminando...',
                text: 'Por favor espera',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Preparar datos para enviar
            const formData = new FormData();
            formData.append('id_jugador', idJugador);
            
            // Debug: Verificar datos antes de enviar
            console.log('=== DATOS A ENVIAR ===');
            console.log('FormData - id_jugador:', formData.get('id_jugador'));
            
            // Hacer petición AJAX
            fetch('../../backend/controllers/EliminarJugadorController.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log('Respuesta HTTP status:', response.status);
                console.log('Respuesta completa:', response);
                return response.text(); // Primero como texto para ver qué llega
            })
            .then(text => {
                console.log('Respuesta raw:', text);
                try {
                    const data = JSON.parse(text);
                    console.log('Datos parseados:', data);
                    
                    if (data.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.error,
                            footer: data.debug ? `Debug: ${data.debug}` : '',
                            confirmButtonText: 'Entendido',
                            confirmButtonColor: '#dc3545'
                        });
                        return;
                    }
                    
                    if (data.success) {
                        // Animar la eliminación de la fila
                        const fila = document.getElementById('fila-' + idJugador);
                        if (fila) {
                            fila.classList.add('fila-eliminada');
                        }
                        
                        // Mostrar mensaje de éxito
                        Swal.fire({
                            icon: 'success',
                            title: '¡Eliminado!',
                            text: data.mensaje,
                            timer: 2000,
                            showConfirmButton: false
                        });
                        
                        // Eliminar la fila del DOM después de la animación
                        setTimeout(() => {
                            if (fila) {
                                fila.remove();
                            }
                            
                            // Verificar si quedan filas
                            const tbody = document.getElementById('tabla-ranking');
                            if (tbody && tbody.children.length === 0) {
                                // Si no quedan jugadores, recargar la página
                                location.reload();
                            } else {
                                // Actualizar las posiciones
                                actualizarPosiciones();
                            }
                        }, 500);
                    }
                } catch (e) {
                    console.error('Error al parsear JSON:', e);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de formato',
                        text: 'La respuesta del servidor no es válida',
                        footer: `Respuesta: ${text}`,
                        confirmButtonText: 'Entendido',
                        confirmButtonColor: '#dc3545'
                    });
                }
            })
            .catch(error => {
                console.error('Error en fetch:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: 'No se pudo conectar con el servidor',
                    footer: `Error: ${error.message}`,
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#dc3545'
                });
            });
        }
    });
}

// ============================================
// ACTUALIZAR POSICIONES DESPUÉS DE ELIMINAR
// ============================================

/**
 * Actualiza las posiciones y medallas después de eliminar un jugador
 */
function actualizarPosiciones() {
    const filas = document.querySelectorAll('#tabla-ranking .ranking-row');
    filas.forEach((fila, index) => {
        const posicion = index + 1;
        let emoji = '';
        
        if (posicion === 1) emoji = '🥇';
        else if (posicion === 2) emoji = '🥈';
        else if (posicion === 3) emoji = '🥉';
        
        const celdaPosicion = fila.querySelector('.position');
        if (celdaPosicion) {
            celdaPosicion.textContent = emoji + ' ' + posicion;
        }
    });
}