
const ITEMS_POR_PAGINA = 6;
let paginaActual = 1;
let totalPaginas = 1;


let todosLosItems = []; 
let itemsFiltrados = []; 
let grid;

// Referencias a elementos de búsqueda
let searchInput, clearSearchBtn;

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

    console.log(` Mostrando página ${numeroPagina}`);

    // Mostrar loader SOLO si no estamos en búsqueda activa
    const esBusquedaActiva = searchInput && searchInput.value.trim() !== '';
    if (!esBusquedaActiva) {
        mostrarLoader();
    }

    // Efecto fade
    if (grid) {
        grid.classList.add('fade');
    }

    setTimeout(() => {
        const inicio = (numeroPagina - 1) * ITEMS_POR_PAGINA;
        const fin = inicio + ITEMS_POR_PAGINA;

        console.log(` Mostrando items del ${inicio} al ${fin - 1}`);

        // Ocultar TODOS los items primero
        todosLosItems.forEach(item => {
            item.classList.add('ocultar-pagina');
        });

        // Mostrar solo los items filtrados de la página actual
        itemsFiltrados.forEach((item, index) => {
            if (index >= inicio && index < fin) {
                item.classList.remove('ocultar-pagina');
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
    }, esBusquedaActiva ? 300 : 600); 
}

/**
 * Cambia de página
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
 * Actualiza controles de paginación
 */
function actualizarControles() {
    const currentPageEl = document.getElementById('currentPage');
    const totalPagesEl = document.getElementById('totalPages');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const paginationWrapper = document.querySelector('.pagination-wrapper');

    if (currentPageEl) currentPageEl.textContent = paginaActual;
    if (totalPagesEl) totalPagesEl.textContent = totalPaginas;

    if (prevBtn) prevBtn.disabled = paginaActual === 1;
    if (nextBtn) nextBtn.disabled = paginaActual === totalPaginas;

    // Ocultar paginación si solo hay una página o menos
    if (paginationWrapper) {
        paginationWrapper.style.display = totalPaginas <= 1 ? 'none' : 'flex';
    }

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
 * Recalcula paginación basándose en items filtrados
 */
function recalcularPaginacion() {
    totalPaginas = Math.ceil(itemsFiltrados.length / ITEMS_POR_PAGINA);
    if (totalPaginas < 1) totalPaginas = 1;
    
    // Si la página actual es mayor al total, ir a la última
    if (paginaActual > totalPaginas) {
        paginaActual = totalPaginas;
    }
    
    console.log(` Recalculando: ${itemsFiltrados.length} items, ${totalPaginas} páginas`);
}

/**
 * Función de búsqueda
 */
function filtrarCategorias() {
    const textoBusqueda = searchInput.value.toLowerCase().trim();
    
    console.log(` Buscando: "${textoBusqueda}"`);
    
    // Mostrar/ocultar botón de limpiar
    if (clearSearchBtn) {
        clearSearchBtn.style.display = textoBusqueda ? 'block' : 'none';
    }
    
    // Filtrar items
    if (textoBusqueda === '') {
        itemsFiltrados = [...todosLosItems];
    } else {
        itemsFiltrados = todosLosItems.filter(item => {
            const nombreCategoria = item.querySelector('.categoria-nombre');
            const descripcion = item.querySelector('.categoria-desc');
            const info = item.querySelector('.categoria-info');
            
            const textoCompleto = [
                nombreCategoria?.textContent || '',
                descripcion?.textContent || '',
                info?.textContent || ''
            ].join(' ').toLowerCase();
            
            return textoCompleto.includes(textoBusqueda);
        });
    }
    
    console.log(` Encontrados: ${itemsFiltrados.length} items`);
    
    // Recalcular paginación
    recalcularPaginacion();
    
    // Volver a página 1
    paginaActual = 1;
    
    // Mostrar resultados
    mostrarPagina(1);
    
    // Mostrar mensaje si no hay resultados
    mostrarMensajeSinResultados(textoBusqueda);
}

/**
 * Muestra mensaje cuando no hay resultados
 */
function mostrarMensajeSinResultados(textoBusqueda) {
    // Eliminar mensaje anterior si existe
    const mensajeExistente = document.getElementById('mensajeSinResultados');
    if (mensajeExistente) {
        mensajeExistente.remove();
    }
    
    // Si no hay resultados, mostrar mensaje
    if (itemsFiltrados.length === 0 && textoBusqueda) {
        const mensaje = document.createElement('div');
        mensaje.id = 'mensajeSinResultados';
        mensaje.className = 'no-categorias';
        mensaje.innerHTML = `
            <p> No se encontraron categorías con "${textoBusqueda}"</p>
            <p class="subtitle">Intenta con otro término de búsqueda</p>
        `;
        if (grid) {
            grid.appendChild(mensaje);
        }
    }
}

/**
 * Limpia la búsqueda
 */
function limpiarBusqueda() {
    if (searchInput) {
        searchInput.value = '';
    }
    if (clearSearchBtn) {
        clearSearchBtn.style.display = 'none';
    }
    
    // Restaurar todos los items
    itemsFiltrados = [...todosLosItems];
    recalcularPaginacion();
    paginaActual = 1;
    mostrarPagina(1);
    
    // Remover mensaje de sin resultados
    const mensajeExistente = document.getElementById('mensajeSinResultados');
    if (mensajeExistente) {
        mensajeExistente.remove();
    }
    
    if (searchInput) {
        searchInput.focus();
    }
}

/**
 * Inicialización
 */
document.addEventListener('DOMContentLoaded', function () {
    console.log(' Inicializando paginación...');

    // Obtener elementos después de que el DOM esté listo
    todosLosItems = Array.from(document.querySelectorAll('.pagina-item'));
    itemsFiltrados = [...todosLosItems]; // Inicialmente, todos están "filtrados"
    grid = document.getElementById('categoriasGrid');
    searchInput = document.getElementById('searchInput');
    clearSearchBtn = document.getElementById('clearSearch');

    // Calcular total de páginas
    totalPaginas = Math.ceil(todosLosItems.length / ITEMS_POR_PAGINA);

    console.log(` Total categorías: ${todosLosItems.length}`);
    console.log(` Total páginas: ${totalPaginas}`);

    // Configurar eventos de búsqueda
    if (searchInput) {
        searchInput.addEventListener('input', filtrarCategorias);
        
        // Prevenir Enter en el buscador
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });
    }

    // Configurar botón de limpiar búsqueda
    if (clearSearchBtn) {
        clearSearchBtn.addEventListener('click', limpiarBusqueda);
    }

    // Iniciar paginación
    if (todosLosItems.length > ITEMS_POR_PAGINA) {
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
   
    if (document.activeElement === searchInput) {
        return;
    }
    
    if (e.key === 'ArrowLeft') {
        cambiarPagina(-1);
    } else if (e.key === 'ArrowRight') {
        cambiarPagina(1);
    }
});