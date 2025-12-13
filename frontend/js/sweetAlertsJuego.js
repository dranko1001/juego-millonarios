function confirmarCambioCategoriaDuranteJuego() {
    Swal.fire({
        title: 'Cambiar de Categoría',
        html: `
            <p style="font-size: 1.1em; margin-bottom: 15px;">
                ¿Deseas cambiar de categoría?
            </p>
            <div style="background: #fff3cd; padding: 15px; border-radius: 10px; border-left: 4px solid #ffc107;">
                <p style="color: #856404; margin: 0; font-weight: 600;">
                    Tu progreso se reiniciará y perderás tu puntaje actual
                </p>
            </div>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, cambiar categoría',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#FFA500',
        cancelButtonColor: '#6c757d',
        reverseButtons: true,
        customClass: {
            popup: 'swal-wide',
            confirmButton: 'swal-btn-confirmar',
            cancelButton: 'swal-btn-cancelar'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../../backend/controllers/CambiarCategoriaController.php';
        }
    });
}

function confirmarSalirYGuardar() {
    Swal.fire({
        title: 'Salir del Juego',
        html: `
            <p style="font-size: 1.1em; margin-bottom: 15px;">
                ¿Seguro que deseas salir?
            </p>
            <div style="background: #d1ecf1; padding: 15px; border-radius: 10px; border-left: 4px solid #17a2b8;">
                <p style="color: #0c5460; margin: 0; font-weight: 600;">
                    Tu puntaje actual se guardará automáticamente
                </p>
            </div>
        `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, salir y guardar',
        cancelButtonText: 'Continuar jugando',
        confirmButtonColor: '#6c757d',
        cancelButtonColor: '#39B54A',
        reverseButtons: true,
        customClass: {
            popup: 'swal-wide',
            confirmButton: 'swal-btn-salir',
            cancelButton: 'swal-btn-continuar'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../../backend/controllers/CerrarSesionController.php';
        }
    });
}

function confirmarCambioCategoriaResultado() {
    Swal.fire({
        title: 'Cambiar de Categoría',
        html: `
            <p style="font-size: 1.1em; margin-bottom: 15px;">
                ¿Deseas cambiar de categoría?
            </p>
            <div style="background: #fff3cd; padding: 15px; border-radius: 10px; border-left: 4px solid #ffc107;">
                <p style="color: #856404; margin: 0; font-weight: 600;">
                    Tu progreso se reiniciará
                </p>
            </div>
        `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, cambiar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#FFA500',
        cancelButtonColor: '#6c757d',
        reverseButtons: true,
        customClass: {
            popup: 'swal-wide',
            confirmButton: 'swal-btn-confirmar',
            cancelButton: 'swal-btn-cancelar'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'reiniciar.php?cambiar_categoria=1';
        }
    });
}