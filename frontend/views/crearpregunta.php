<?php
session_start();

if (!isset($_SESSION["admin"]) || empty($_SESSION["admin"])) {
    header("Location: login_administrador.php");
    exit();
}

$nombre_admin = $_SESSION["admin"];

require_once __DIR__ . "/../../backend/models/pdoconexion.php";

$db = new PDOConnection();
$pdo = $db->getConexion();

$sql = "SELECT ID_categoria, nombre_categoria FROM tbl_categorias ORDER BY ID_categoria ASC";
$stmt = $pdo->query($sql);
$categorias = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Preguntas</title>

    <link rel="stylesheet" href="../css/preguntas.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-full">
    <h1 class="title-page">Gestión de Preguntas</h1>
    <div class="main-content">

        <nav class="sidebar-menu">
            <ul class="menu-list">
                <li><a href="./crearpregunta.php" class="menu-item menu-create">Crear Pregunta</a></li>
                <li><a href="./editarpregunta.php" class="menu-item menu-edit">Editar Pregunta</a></li>
                <li><a href="./eliminarpregunta.php" class="menu-item menu-delete">Eliminar Pregunta</a></li>
            </ul>
            <a href="./menuOpciones.php" class="btn back-link">Volver</a>
        </nav>

        <div class="content-area">
            <h2 class="form-title">Crear Nueva Pregunta</h2>
             <!--  Mostrar solo mensaje de crear -->
    <?php if (isset($_SESSION['msg_crear_pregunta'])): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['msg_crear_pregunta']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['msg_crear_pregunta']); ?>
    <?php endif; ?>

            <form id="form-crear-pregunta" method="POST" action="../../backend/controllers/crearpregunta_controller.php">

                <div class="metadata-grid">
                    
                    <div class="form-group">
                        <label>Categoría:</label>
                        <div class="select-with-button">
                            <select name="ID_categoria" required>
                                <option value="">Seleccione una categoría</option>
                                <?php foreach ($categorias as $cat): ?>
                                    <option value="<?= $cat['ID_categoria'] ?>">
                                        <?= htmlspecialchars($cat['nombre_categoria']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <button type="button" class="btn btn-success add-category-btn" 
                                    data-bs-toggle="modal" data-bs-target="#categoryModal">
                                Agregar Categoría
                            </button>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label>Nivel de dificultad:</label>
                        <select name="ID_dificultad" required>
                            <option value="">Selecciona el Nivel</option>
                            <option value="1">Facil</option>
                            <option value="2">Medio</option>
                            <option value="3">Dificil</option>
                        </select>
                    </div>
                </div>

                
                <div class="form-group">
                    <label>Pregunta:</label>
                    <textarea name="enunciado_pregunta" rows="3" required></textarea>
                </div>

                
                <div class="form-group">
                    <label>Opciones de Respuesta (marca la correcta):</label>
                    <div class="mb-2">
                        <input type="radio" name="correcta_pregunta" value="1" required> A. 
                        <input type="text" name="opcion1_pregunta" placeholder="Opción A" required class="form-control">
                    </div>
                    <div class="mb-2">
                        <input type="radio" name="correcta_pregunta" value="2" required> B. 
                        <input type="text" name="opcion2_pregunta" placeholder="Opción B" required class="form-control">
                    </div>
                    <div class="mb-2">
                        <input type="radio" name="correcta_pregunta" value="3" required> C. 
                        <input type="text" name="opcion3_pregunta" placeholder="Opción C" required class="form-control">
                    </div>
                    <div class="mb-2">
                        <input type="radio" name="correcta_pregunta" value="4" required> D. 
                        <input type="text" name="opcion4_pregunta" placeholder="Opción D" required class="form-control">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary save-btn">Guardar Pregunta</button>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Agregar Categoría</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form method="POST" action="../../backend/controllers/crearcategoria.php">
            <label>Nombre de la categoría:</label>
            <input type="text" name="nombre_categoria" class="form-control" required>
            <button type="submit" name="crear_categoria" class="btn btn-success w-100 mt-3">
                Guardar Categoría
            </button>
        </form>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
