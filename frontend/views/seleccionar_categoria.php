<?php
// frontend/views/seleccionar_categoria.php
session_start();

// Verificar que el aprendiz haya iniciado sesión y validado el código
if (!isset($_SESSION["aprendiz"]) || !isset($_SESSION["codigo_validado"])) {
    header("Location: login_aprendiz.php");
    exit();
}

require_once __DIR__ . '/../../backend/models/CategoriaModel.php';
require_once __DIR__ . '/../../backend/models/PreguntaModel.php';

$categoriaModel = new CategoriaModel();
$preguntaModel = new PreguntaModel();
$categorias = $categoriaModel->obtenerTodasCategorias();

// Obtener cantidad de preguntas por categoría
$categorias_con_preguntas = [];
foreach ($categorias as $categoria) {
    $cantidad = $preguntaModel->contarPreguntasPorCategoria($categoria['ID_categoria']);
    if ($cantidad > 0) {
        $categoria['cantidad_preguntas'] = $cantidad;
        $categorias_con_preguntas[] = $categoria;
    }
}

// Contar preguntas totales para la opción MIXTA
$total_preguntas = $preguntaModel->contarPreguntas();

$error_msg = "";
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'categoria_invalida':
            $error_msg = "La categoría seleccionada no es válida";
            break;
        default:
            $error_msg = "Error desconocido";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Categoría - Millonarios SENA</title>
    <link rel="stylesheet" href="../css/seleccionar_categoria.css">
</head>

<body>
    <div class="categoria-container">
        <div class="header">
            <h1>📚 Selecciona una Categoría</h1>
            <p class="subtitle">Elige el tema de las preguntas que responderás</p>
            <p class="user-info">👤 Aprendiz: <strong><?php echo htmlspecialchars($_SESSION['aprendiz']); ?></strong>
            </p>
        </div>

        <?php if (!empty($error_msg)): ?>
            <div class="error-message">
                ⚠️ <?php echo htmlspecialchars($error_msg); ?>
            </div>
        <?php endif; ?>

        <div class="categorias-grid" id="categoriasGrid">
            <!-- Opción MIXTA (todas las categorías) - DESTACADA -->
            <?php if ($total_preguntas > 0): ?>
                <form method="POST" action="../../backend/controllers/SeleccionarCategoriaController.php"
                    class="categoria-card-form pagina-item">
                    <input type="hidden" name="id_categoria" value="MIXTA">
                    <button type="submit" class="categoria-card categoria-mixta" style="animation-delay: 0s">
                        <div class="categoria-icon">🎲</div>
                        <h3 class="categoria-nombre">Mixta</h3>
                        <p class="categoria-info"><?php echo $total_preguntas; ?> preguntas disponibles</p>
                        <p class="categoria-desc">Todas las categorías mezcladas</p>
                        <div class="categoria-hover-effect">
                            <span>¡Seleccionar!</span>
                        </div>
                    </button>
                </form>
            <?php endif; ?>

            <!-- Categorías específicas -->
            <?php if (!empty($categorias_con_preguntas)): ?>
                <?php foreach ($categorias_con_preguntas as $index => $categoria): ?>
                    <form method="POST" action="../../backend/controllers/SeleccionarCategoriaController.php"
                        class="categoria-card-form pagina-item">
                        <input type="hidden" name="id_categoria"
                            value="<?php echo htmlspecialchars($categoria['ID_categoria']); ?>">
                        <button type="submit" class="categoria-card"
                            style="animation-delay: <?php echo ($index + 1) * 0.1; ?>s">
                            <div class="categoria-icon">
                                <?php
                                // Iconos según la categoría
                                $iconos = [
                                    'Historia' => '🏛️',
                                    'Ciencia' => '🔬',
                                    'Arte y Literatura' => '🎨',
                                    'Geografía' => '🌍',
                                    'Deportes' => '⚽',
                                    'Entretenimiento' => '🎬',
                                    'Tecnología' => '💻',
                                    'Matemáticas' => '🔢',
                                    'Música' => '🎵',
                                    'Naturaleza' => '🌿',
                                    'Cine y TV' => '🎬',
                                    'Cultura General' => '📖',
                                    'Biología' => '🧬',
                                    'Videojuegos' => '🎮',
                                    'Economía' => '💰'
                                ];
                                $nombre = $categoria['nombre_categoria'];
                                echo isset($iconos[$nombre]) ? $iconos[$nombre] : '📖';
                                ?>
                            </div>
                            <h3 class="categoria-nombre"><?php echo htmlspecialchars($categoria['nombre_categoria']); ?></h3>
                            <p class="categoria-info"><?php echo $categoria['cantidad_preguntas']; ?>
                                pregunta<?php echo $categoria['cantidad_preguntas'] > 1 ? 's' : ''; ?>
                                disponible<?php echo $categoria['cantidad_preguntas'] > 1 ? 's' : ''; ?></p>
                            <div class="categoria-hover-effect">
                                <span>¡Seleccionar!</span>
                            </div>
                        </button>
                    </form>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (empty($categorias_con_preguntas) && $total_preguntas == 0): ?>
                <div class="no-categorias">
                    <p>⚠️ No hay preguntas disponibles en este momento.</p>
                    <a href="../../backend/controllers/logout.php" class="btn-volver">Volver al inicio</a>
                </div>
            <?php endif; ?>
        </div>

        <!-- 🔥 CONTROLES DE PAGINACIÓN -->
        <div class="pagination-wrapper">
            <button class="pagination-btn" id="prevBtn" onclick="cambiarPagina(-1)">
                ← Anterior
            </button>

            <div class="page-numbers" id="pageNumbers"></div>

            <div class="pagination-info" id="pageInfo">
                Página <span id="currentPage">1</span> de <span id="totalPages">1</span>
            </div>

            <button class="pagination-btn" id="nextBtn" onclick="cambiarPagina(1)">
                Siguiente →
            </button>
        </div>

        <div class="footer-actions">
            <a href="../../backend/controllers/logout.php" class="btn-logout">← Cerrar Sesión</a>
        </div>
    </div>

    <style>
        /* ========================================
           ESTILOS ORIGINALES (TU CSS)
        ======================================== */
        .user-info {
            margin-top: 10px;
            font-size: 1em;
            color: #fff;
            background: rgba(0, 0, 0, 0.2);
            padding: 8px 15px;
            border-radius: 20px;
            display: inline-block;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 10px;
            margin: 0 20px 20px 20px;
            border: 2px solid #f5c6cb;
            text-align: center;
            font-weight: 600;
            animation: shake 0.5s;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-10px);
            }

            75% {
                transform: translateX(10px);
            }
        }

        .categoria-mixta {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%) !important;
            border-color: #39B54A !important;
        }

        .categoria-mixta:hover {
            transform: translateY(-10px) scale(1.08) !important;
            box-shadow: 0 25px 60px rgba(255, 165, 0, 0.5) !important;
        }

        .categoria-mixta .categoria-nombre {
            color: #1a1a1a !important;
            font-size: 1.8em;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .categoria-mixta .categoria-info {
            color: #333 !important;
            font-weight: 600;
        }

        .categoria-mixta .categoria-desc {
            color: #444 !important;
            font-weight: 500;
        }

        .categoria-mixta .categoria-icon {
            font-size: 5em;
            animation: rotateDice 4s ease-in-out infinite;
        }

        @keyframes rotateDice {

            0%,
            100% {
                transform: rotate(0deg) translateY(0px);
            }

            25% {
                transform: rotate(10deg) translateY(-5px);
            }

            50% {
                transform: rotate(0deg) translateY(0px);
            }

            75% {
                transform: rotate(-10deg) translateY(-5px);
            }
        }

        .categoria-desc {
            font-size: 0.9em;
            color: #888;
            margin-top: 5px;
            font-style: italic;
        }

        .no-categorias {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            color: #666;
            font-size: 1.2em;
        }

        .no-categorias p {
            margin-bottom: 20px;
        }

        .btn-volver {
            display: inline-block;
            background: linear-gradient(135deg, #39B54A 0%, #00A14B 100%);
            color: white;
            padding: 12px 30px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 5px 20px rgba(57, 181, 74, 0.3);
        }

        .btn-volver:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(57, 181, 74, 0.4);
        }

        /* ========================================
           NUEVOS ESTILOS PARA PAGINACIÓN
        ======================================== */

        /* Control de visibilidad */
        .pagina-item.ocultar-pagina {
            display: none !important;
        }

        /* Wrapper de paginación */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 30px 20px 20px 20px;
            padding: 20px;
            flex-wrap: wrap;
        }

        .pagination-info {
            background: rgba(255, 255, 255, 0.95);
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            color: #2c3e50;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .pagination-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95em;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .pagination-btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .pagination-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background: linear-gradient(135deg, #95a5a6 0%, #7f8c8d 100%);
        }

        .page-numbers {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .page-number {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 45px;
            text-align: center;
        }

        .page-number:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        .page-number.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: #764ba2;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        /* Animación suave al cambiar */
        .categorias-grid {
            transition: opacity 0.3s ease;
        }

        .categorias-grid.fade {
            opacity: 0.3;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .categoria-mixta .categoria-nombre {
                font-size: 1.5em;
            }

            .categoria-mixta .categoria-icon {
                font-size: 3.5em;
            }

            .pagination-wrapper {
                gap: 10px;
                padding: 15px;
            }

            .pagination-btn {
                padding: 10px 15px;
                font-size: 0.85em;
            }

            .page-number {
                padding: 8px 12px;
                min-width: 40px;
            }
        }

        @media (max-width: 480px) {
            .user-info {
                font-size: 0.9em;
                padding: 6px 12px;
            }

            .categoria-mixta .categoria-nombre {
                font-size: 1.3em;
            }

            .categoria-mixta .categoria-icon {
                font-size: 3em;
            }

            .pagination-wrapper {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>

    <script>
        // ============================================
        // SISTEMA DE PAGINACIÓN
        // ============================================

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

                // Scroll suave
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }, 150);
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
                // Si hay 6 o menos, ocultar controles
                document.querySelector('.pagination-wrapper').style.display = 'none';
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
    </script>
</body>

</html>