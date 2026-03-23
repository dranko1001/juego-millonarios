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
    
    <!-- enlaces para que funcione bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="icon" href="../media/sena logo.png">
</head>

<body>
    <div class="categoria-container">
        <div class="header">
            <h1> <img src="../media/icons/libro.png" alt=""> Selecciona una Categoría</h1>
            <p class="subtitle">Elige el tema de las preguntas que responderás</p>
            <p class="user-info"> Aprendiz: <strong><?php echo htmlspecialchars($_SESSION['aprendiz']); ?></strong></p>
        </div>

        <?php if (!empty($error_msg)): ?>
            <div class="error-message">
                ⚠️ <?php echo htmlspecialchars($error_msg); ?>
            </div>
        <?php endif; ?>

        <!-- CAMPO DE BÚSQUEDA -->
        <div class="search-container">
            <input type="text" 
                   id="searchInput" 
                   class="search-input" 
                   placeholder="🔍 Buscar categoría..." 
                   autocomplete="off">
            <button type="button" id="clearSearch" class="clear-search-btn" style="display: none;">✕</button>
        </div>

        <!-- LOADER DE CARGA -->
        <div class="loader-overlay" id="loaderOverlay">
            <div class="loader-content">
                <div class="loader-spinner"></div>
                <h3 class="loader-text">Cargando categorías...</h3>
                <p class="loader-subtext">Por favor espera un momento </p>
            </div>
        </div>

        <div class="categorias-grid" id="categoriasGrid">
            <!-- Opción MIXTA (todas las categorías) -->
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
                                    'Economía' => '💰',
                                    //agregar iconos segun cuantas categorias quieran crear
                                    'Física' => '⚛️',
'Química' => '🧪',
'Astronomía' => '🌌',
'Filosofía' => '📘',
'Psicología' => '🧠',
'Sociología' => '👥',
'Política' => '🏛️',
'Religión' => '⛪',
'Educación' => '🎓',
   'SENA' => '🏫',
    'Halloween' => '🎃',
    'Navidad' => '🎄',
        'Administración' => '🗂️',
    'Contabilidad' => '🧮',
    'Costura'       => '🧵',
    'Cocina'        => '🍳',
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

        <!-- CONTROLES DE PAGINACIÓN -->
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
            <a href="../../backend/controllers/logout.php" class="btn-logout"> Cerrar Sesión</a>
        </div>
    </div>

    <!-- Scripts  body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
    <!--  Script de paginación  -->
    <script src="../js/seleccionarCategoria.js"></script>
</body>

</html>