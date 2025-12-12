

document.addEventListener('DOMContentLoaded', function() {
    //*escuchador de botones de liminar
    const botonesEliminar = document.querySelectorAll('.btn-eliminar');
    
    console.log('Total de botones encontrados:', botonesEliminar.length);
    
    botonesEliminar.forEach(boton => {
        boton.addEventListener('click', function() {
            //*ids y nombres de los jugadores a eliminar
            const idJugador = this.dataset.id || this.getAttribute('data-id');
            const nombreUsuario = this.dataset.nombre || this.getAttribute('data-nombre');
            
            //*debug de datos obtenidos
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



/** * Elimina un jugador mediante una petición AJAX
 * @param {number} idJugador
 * @param {string} nombreUsuario 
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
            //*mostrar
            Swal.fire({
                title: 'Eliminando...',
                text: 'Por favor espera',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            //*preparar datos
            const formData = new FormData();
            formData.append('id_jugador', idJugador);
            
            //*debug de datos a enviar
            console.log('=== DATOS A ENVIAR ===');
            console.log('FormData - id_jugador:', formData.get('id_jugador'));
            
            //*peticion ajax
            fetch('../../backend/controllers/EliminarJugadorController.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log('Respuesta HTTP status:', response.status);
                console.log('Respuesta completa:', response);
                return response.text();
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
                       
                        const fila = document.getElementById('fila-' + idJugador);
                        if (fila) {
                            fila.classList.add('fila-eliminada');
                        }
                        
                      
                        Swal.fire({
                            icon: 'success',
                            title: '¡Eliminado!',
                            text: data.mensaje,
                            timer: 2000,
                            showConfirmButton: false
                        });
                        
                    
                        setTimeout(() => {
                            if (fila) {
                                fila.remove();
                            }
                            
                       
                            const tbody = document.getElementById('tabla-ranking');
                            if (tbody && tbody.children.length === 0) {
                        
                                location.reload();
                            } else {
                   
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
 *r
 */
function actualizarPosiciones() {
    const filas = document.querySelectorAll('#tabla-ranking .ranking-row');
    filas.forEach((fila, index) => {
        const posicion = index + 1;
        let emoji = '';
        
        if (posicion === 1);
        else if (posicion === 2);
        else if (posicion === 3);
        
        const celdaPosicion = fila.querySelector('.position');
        if (celdaPosicion) {
            celdaPosicion.textContent =  posicion;
        }
    });
}