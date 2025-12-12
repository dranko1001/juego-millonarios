
// Sistema que crea la paginación de las categorías
const ITEMS_POR_PAGINA = 6;
let paginaActual = 1;
let totalPaginas = 1;

// Variables globales para los elementos
let items, grid;

/**
 * Muestra el loader
 */
function mostrarLoader() {
    const loader = document.getElementById('loaderOverlay');
    if (loader) {
        loader.classList.remove('hide');
    }
}

/**
 * Oculta el loader
 */
function ocultarLoader() {
    const loader = document.getElementById('loaderOverlay');
    if (loader) {
        setTimeout(() => {
            loader.classList.add('hide');
        }, 1000);
    }
}

/**
 * Muestra la página específica
 */
function mostrarPagina(numeroPagina) {
    if (numeroPagina < 1) numeroPagina = 1;
    if (numeroPagina > totalPaginas) numeroPagina = totalPaginas;

    paginaActual = numeroPagina;

    console.log(`📖 Mostrando página ${numeroPagina}`);

    // Mostrar loader
    mostrarLoader();

    // Efecto fade
    if (grid) {
        grid.classList.add('fade');
    }

    setTimeout(() => {
        const inicio = (numeroPagina - 1) * ITEMS_POR_PAGINA;
        const fin = inicio + ITEMS_POR_PAGINA;

        console.log(`🔢 Mostrando items del ${inicio} al ${fin - 1}`);

        // Mostrar/ocultar items
        items.forEach((item, index) => {
            if (index >= inicio && index < fin) {
                item.classList.remove('ocultar-pagina');
            } else {
                item.classList.add('ocultar-pagina');
            }
        });

        actualizarControles();
        
        if (grid) {
            grid.classList.remove('fade');
        }

        // Ocultar loader
        ocultarLoader();

        // Scroll suave
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }, 600);
}

/**
 Cambia de página
 */
function cambiarPagina(direccion) {
    mostrarPagina(paginaActual + direccion);
}

/**
 * Va a página específica
 */
function irAPagina(numeroPagina) {
    mostrarPagina(numeroPagina);
}

/**
 * Actualiza controles
 */
function actualizarControles() {
    const currentPageEl = document.getElementById('currentPage');
    const totalPagesEl = document.getElementById('totalPages');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    if (currentPageEl) currentPageEl.textContent = paginaActual;
    if (totalPagesEl) totalPagesEl.textContent = totalPaginas;

    if (prevBtn) prevBtn.disabled = paginaActual === 1;
    if (nextBtn) nextBtn.disabled = paginaActual === totalPaginas;

    generarNumerosPagina();
}

/**
 * Genera números de página
 */
function generarNumerosPagina() {
    const container = document.getElementById('pageNumbers');
    if (!container) return;

    container.innerHTML = '';

    let inicio = Math.max(1, paginaActual - 2);
    let fin = Math.min(totalPaginas, inicio + 4);

    if (fin - inicio < 4) {
        inicio = Math.max(1, fin - 4);
    }

    for (let i = inicio; i <= fin; i++) {
        const btn = document.createElement('div');
        btn.className = 'page-number' + (i === paginaActual ? ' active' : '');
        btn.textContent = i;
        btn.onclick = () => irAPagina(i);
        container.appendChild(btn);
    }
}

/**
 * Inicialización
 */
document.addEventListener('DOMContentLoaded', function () {
    console.log('🚀 Inicializando paginación...');

    // Obtener elementos después de que el DOM esté listo
    items = document.querySelectorAll('.pagina-item');
    grid = document.getElementById('categoriasGrid');

    // Calcular total de páginas
    totalPaginas = Math.ceil(items.length / ITEMS_POR_PAGINA);

    console.log(`📊 Total categorías: ${items.length}`);
    console.log(`📄 Total páginas: ${totalPaginas}`);

    // Solo inicia si hay más de 6 items
    if (items.length > ITEMS_POR_PAGINA) {
        mostrarPagina(1);
    } else {
        // Si hay 6 o menos, ocultar controles y loader
        const paginationWrapper = document.querySelector('.pagination-wrapper');
        if (paginationWrapper) {
            paginationWrapper.style.display = 'none';
        }
        ocultarLoader();
    }
});

/**
 * Navegación con teclado
 */
document.addEventListener('keydown', function (e) {
    if (e.key === 'ArrowLeft') {
        cambiarPagina(-1);
    } else if (e.key === 'ArrowRight') {
        cambiarPagina(1);
    }
});