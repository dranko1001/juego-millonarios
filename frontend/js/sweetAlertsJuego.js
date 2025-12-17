function confirmarCambioCategoriaDuranteJuego() {
    Swal.fire({
        title: 'Cambiar de Categoría',
        html: `
            <p style="font-size: 1em; margin-bottom: 15px; line-height: 1.5;">
                ¿Deseas cambiar de categoría?
            </p>
            <div style="background: #fff3cd; padding: 12px; border-radius: 8px; border-left: 4px solid #ffc107; margin-top: 10px;">
                <p style="color: #856404; margin: 0; font-weight: 600; font-size: 0.9em;">
                    Tu progreso se reiniciará y perderás tu puntaje actual
                </p>
            </div>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, cambiar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#FFA500',
        cancelButtonColor: '#6c757d',
        reverseButtons: true,
        width: '90%',
        maxWidth: '500px',
        padding: '20px',
        customClass: {
            popup: 'swal-responsive',
            title: 'swal-title-responsive',
            htmlContainer: 'swal-html-responsive',
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
            <p style="font-size: 1em; margin-bottom: 15px; line-height: 1.5;">
                ¿Seguro que deseas salir?
            </p>
            <div style="background: #d1ecf1; padding: 12px; border-radius: 8px; border-left: 4px solid #17a2b8; margin-top: 10px;">
                <p style="color: #0c5460; margin: 0; font-weight: 600; font-size: 0.9em;">
                    Tu puntaje actual se guardará automáticamente
                </p>
            </div>
        `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Salir',
        cancelButtonText: 'Continuar',
        confirmButtonColor: '#6c757d',
        cancelButtonColor: '#39B54A',
        reverseButtons: true,
        width: '90%',
        maxWidth: '500px',
        padding: '20px',
        customClass: {
            popup: 'swal-responsive',
            title: 'swal-title-responsive',
            htmlContainer: 'swal-html-responsive',
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
            <p style="font-size: 1em; margin-bottom: 15px; line-height: 1.5;">
                ¿Deseas cambiar de categoría?
            </p>
            <div style="background: #fff3cd; padding: 12px; border-radius: 8px; border-left: 4px solid #ffc107; margin-top: 10px;">
                <p style="color: #856404; margin: 0; font-weight: 600; font-size: 0.9em;">
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
        width: '90%',
        maxWidth: '500px',
        padding: '20px',
        customClass: {
            popup: 'swal-responsive',
            title: 'swal-title-responsive',
            htmlContainer: 'swal-html-responsive',
            confirmButton: 'swal-btn-confirmar',
            cancelButton: 'swal-btn-cancelar'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'reiniciar.php?cambiar_categoria=1';
        }
    });
}

const style = document.createElement('style');
style.textContent = `
    .swal-responsive {
        border-radius: 15px !important;
        box-sizing: border-box !important;
    }
    
    .swal-title-responsive {
        font-size: 1.5em !important;
        padding: 10px 15px !important;
        word-wrap: break-word !important;
    }
    
    .swal-html-responsive {
        font-size: 1em !important;
        padding: 0 15px !important;
        overflow-wrap: break-word !important;
        word-wrap: break-word !important;
    }
    
    .swal-btn-confirmar,
    .swal-btn-cancelar,
    .swal-btn-salir,
    .swal-btn-continuar {
        border: none !important;
        padding: 10px 20px !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        font-size: 0.9em !important;
        transition: all 0.3s ease !important;
        margin: 5px !important;
        min-width: 100px !important;
    }
    
    .swal-btn-confirmar {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%) !important;
        color: #1a1a1a !important;
        box-shadow: 0 3px 10px rgba(255, 165, 0, 0.3) !important;
    }
    
    .swal-btn-confirmar:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 5px 15px rgba(255, 165, 0, 0.4) !important;
    }
    
    .swal-btn-cancelar {
        background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%) !important;
        color: white !important;
        box-shadow: 0 3px 10px rgba(108, 117, 125, 0.3) !important;
    }
    
    .swal-btn-cancelar:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4) !important;
    }
    
    .swal-btn-salir {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%) !important;
        color: white !important;
        box-shadow: 0 3px 10px rgba(108, 117, 125, 0.3) !important;
    }
    
    .swal-btn-salir:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4) !important;
    }
    
    .swal-btn-continuar {
        background: linear-gradient(135deg, #39B54A 0%, #00A14B 100%) !important;
        color: white !important;
        box-shadow: 0 3px 10px rgba(57, 181, 74, 0.3) !important;
    }
    
    .swal-btn-continuar:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 5px 15px rgba(57, 181, 74, 0.4) !important;
    }
    
    .swal2-icon {
        margin: 15px auto !important;
    }
    
    .swal2-actions {
        margin: 15px 0 0 0 !important;
        padding: 0 !important;
        gap: 10px !important;
        flex-wrap: wrap !important;
        justify-content: center !important;
    }
    
    @media (max-width: 600px) {
        .swal-responsive {
            width: 95vw !important;
            padding: 15px !important;
        }
        
        .swal-title-responsive {
            font-size: 1.3em !important;
            padding: 8px 10px !important;
        }
        
        .swal-html-responsive {
            font-size: 0.9em !important;
            padding: 0 10px !important;
        }
        
        .swal-html-responsive p {
            font-size: 0.9em !important;
        }
        
        .swal-html-responsive div {
            padding: 10px !important;
        }
        
        .swal-html-responsive div p {
            font-size: 0.85em !important;
        }
        
        .swal-btn-confirmar,
        .swal-btn-cancelar,
        .swal-btn-salir,
        .swal-btn-continuar {
            padding: 8px 15px !important;
            font-size: 0.85em !important;
            min-width: 90px !important;
        }
        
        .swal2-icon {
            width: 60px !important;
            height: 60px !important;
            margin: 10px auto !important;
        }
        
        .swal2-actions {
            margin: 10px 0 0 0 !important;
            gap: 8px !important;
        }
    }
    
    @media (max-width: 400px) {
        .swal-responsive {
            width: 98vw !important;
            padding: 12px !important;
        }
        
        .swal-title-responsive {
            font-size: 1.1em !important;
            padding: 5px 8px !important;
        }
        
        .swal-html-responsive {
            font-size: 0.85em !important;
        }
        
        .swal-html-responsive p {
            font-size: 0.85em !important;
        }
        
        .swal-html-responsive div {
            padding: 8px !important;
        }
        
        .swal-html-responsive div p {
            font-size: 0.8em !important;
        }
        
        .swal-btn-confirmar,
        .swal-btn-cancelar,
        .swal-btn-salir,
        .swal-btn-continuar {
            padding: 7px 12px !important;
            font-size: 0.8em !important;
            min-width: 80px !important;
        }
        
        .swal2-icon {
            width: 50px !important;
            height: 50px !important;
        }
    }
`;

document.head.appendChild(style);