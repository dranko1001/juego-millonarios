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
            <p class="user-info">👤 Aprendiz: <strong><?php echo htmlspecialchars($_SESSION['aprendiz']); ?></strong></p>
        </div>

        <?php if (!empty($error_msg)): ?>
            <div class="error-message">
                ⚠️ <?php echo htmlspecialchars($error_msg); ?>
            </div>
        <?php endif; ?>

        <div class="categorias-grid">
            <!-- Opción MIXTA (todas las categorías) - DESTACADA -->
            <?php if ($total_preguntas > 0): ?>
                <form method="POST" action="../../backend/controllers/SeleccionarCategoriaController.php" class="categoria-card-form">
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
                    <form method="POST" action="../../backend/controllers/SeleccionarCategoriaController.php" class="categoria-card-form">
                        <input type="hidden" name="id_categoria" value="<?php echo htmlspecialchars($categoria['ID_categoria']); ?>">
                        <button type="submit" class="categoria-card" style="animation-delay: <?php echo ($index + 1) * 0.1; ?>s">
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
                                    'Naturaleza' => '🌿'
                                ];
                                $nombre = $categoria['nombre_categoria'];
                                echo isset($iconos[$nombre]) ? $iconos[$nombre] : '📖';
                                ?>
                            </div>
                            <h3 class="categoria-nombre"><?php echo htmlspecialchars($categoria['nombre_categoria']); ?></h3>
                            <p class="categoria-info"><?php echo $categoria['cantidad_preguntas']; ?> pregunta<?php echo $categoria['cantidad_preguntas'] > 1 ? 's' : ''; ?> disponible<?php echo $categoria['cantidad_preguntas'] > 1 ? 's' : ''; ?></p>
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

        <div class="footer-actions">
            <a href="../../backend/controllers/logout.php" class="btn-logout">← Cerrar Sesión</a>
        </div>
    </div>

    <style>
        /* Estilos adicionales inline para elementos específicos */
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
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        /* Estilo especial para categoría MIXTA */
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
            0%, 100% { transform: rotate(0deg) translateY(0px); }
            25% { transform: rotate(10deg) translateY(-5px); }
            50% { transform: rotate(0deg) translateY(0px); }
            75% { transform: rotate(-10deg) translateY(-5px); }
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

        /* Ajustes responsive */
        @media (max-width: 768px) {
            .categoria-mixta .categoria-nombre {
                font-size: 1.5em;
            }

            .categoria-mixta .categoria-icon {
                font-size: 3.5em;
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
        }
    </style>
</body>
</html>