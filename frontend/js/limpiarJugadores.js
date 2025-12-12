// ============================================
// FUNCIÓN LIMPIAR TODOS LOS JUGADORES
// ============================================

function limpiarJugadores() {
    //*¨confirmar acción
    Swal.fire({
        title: '⚠️ ¿Estás completamente seguro?',
        html: `
            <p style="font-size: 1.1em; color: #dc3545; font-weight: 600;">
                Esta acción eliminará <strong>TODOS</strong> los jugadores registrados
            </p>
            <p style="color: #666; margin-top: 15px;">
                <strong>⚠️ Esta acción NO se puede deshacer</strong>
            </p>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '⚠️ Sí, entiendo los riesgos',
        cancelButtonText: '✖ Cancelar',
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            ejecutarLimpiezaJugadores();
        }
    });
}

// ============================================
// EJECUTAR LIMPIEZA
// ============================================

function ejecutarLimpiezaJugadores() {
    //*peticion de limpieza
    Swal.fire({
        title: '🗑️ Eliminando jugadores...',
        text: 'Por favor espera',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    //* peticion controller
    fetch('../../backend/controllers/LimpiarJugadoresController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'accion=limpiar_todos'
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            //*error
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.error,
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#dc3545'
            });
        } else if (data.success) {
            //*ecito
            Swal.fire({
                icon: 'success',
                title: '✅ ¡Limpieza completada!',
                text: data.mensaje,
                confirmButtonText: '👍 Aceptar',
                confirmButtonColor: '#39B54A'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error de conexión',
            text: 'No se pudo conectar con el servidor',
            confirmButtonText: 'Entendido',
            confirmButtonColor: '#dc3545'
        });
    });
}