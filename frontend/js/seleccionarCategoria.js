        // sistema que crea la paginazion de las categorias, para evitar desborde si se crean muchaas categorias

        const ITEMS_POR_PAGINA = 6;
        let paginaActual = 1;
        let totalPaginas = 1;

        // Obtener todos los formularios (.categoria-card-form con clase .pagina-item)
        const items = document.querySelectorAll('.pagina-item');
        const grid = document.getElementById('categoriasGrid');

        // Calcular total de páginas
        totalPaginas = Math.ceil(items.length / ITEMS_POR_PAGINA);

        console.log(`📊 Total categorías: ${items.length}`);
        console.log(`📄 Total páginas: ${totalPaginas}`);

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
            grid.classList.add('fade');

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
                grid.classList.remove('fade');

                // Ocultar loader
                ocultarLoader();

                // Scroll suave
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }, 600); // Tiempo para mostrar el loader
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
         * Actualiza controles
         */
        function actualizarControles() {
            document.getElementById('currentPage').textContent = paginaActual;
            document.getElementById('totalPages').textContent = totalPaginas;

            document.getElementById('prevBtn').disabled = paginaActual === 1;
            document.getElementById('nextBtn').disabled = paginaActual === totalPaginas;

            generarNumerosPagina();
        }

        /**
         * Genera números de página
         */
        function generarNumerosPagina() {
            const container = document.getElementById('pageNumbers');
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

            // Solo iniciar si hay más de 6 items
            if (items.length > ITEMS_POR_PAGINA) {
                mostrarPagina(1);
            } else {
                // Si hay 6 o menos, ocultar controles y loader
                document.querySelector('.pagination-wrapper').style.display = 'none';
                ocultarLoader();
            }
        });

        /**
         * Muestra el loader
         */
        function mostrarLoader() {
            const loader = document.getElementById('loaderOverlay');
            loader.classList.remove('hide');
        }

        /**
         * Oculta el loader
         */
        function ocultarLoader() {
            const loader = document.getElementById('loaderOverlay');
            setTimeout(() => {
                loader.classList.add('hide');
            }, 1000);
        }

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