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

$search = trim($_GET['buscar'] ?? '');

$sql = "SELECT p.ID_pregunta, p.enunciado_pregunta, p.opcion1_pregunta, p.opcion2_pregunta, 
               p.opcion3_pregunta, p.opcion4_pregunta, p.correcta_pregunta, 
               c.nombre_categoria, d.nombre_dificultad
        FROM tbl_preguntas p
        JOIN tbl_categorias c ON p.TBL_categorias_ID_categoria = c.ID_categoria
        JOIN tbl_dificultades d ON p.TBL_dificultades_ID_dificultad = d.ID_dificultad";

$params = [];
if ($search) {
    $sql .= " WHERE p.enunciado_pregunta LIKE :search";
    $params[':search'] = "%$search%";
}

$sql .= " ORDER BY p.ID_pregunta ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$preguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Eliminar Preguntas</title>
<link rel="stylesheet" href="../css/preguntas.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-full">
<h1 class="title-page">Eliminar Preguntas</h1>
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
        <h2 class="form-title">Buscar y Eliminar Pregunta</h2>

        <form method="GET" class="mb-4 d-flex">
            <input type="text" name="buscar" placeholder="Buscar por texto de la pregunta" class="form-control me-2" value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pregunta</th>
                        <th>Opción A</th>
                        <th>Opción B</th>
                        <th>Opción C</th>
                        <th>Opción D</th>
                        <th>Correcta</th>
                        <th>Categoría</th>
                        <th>Dificultad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($preguntas): ?>
                        <?php foreach ($preguntas as $p): ?>
                            <tr>
                                <td><?= $p['ID_pregunta'] ?></td>
                                <td><?= htmlspecialchars($p['enunciado_pregunta']) ?></td>
                                <td><?= htmlspecialchars($p['opcion1_pregunta']) ?></td>
                                <td><?= htmlspecialchars($p['opcion2_pregunta']) ?></td>
                                <td><?= htmlspecialchars($p['opcion3_pregunta']) ?></td>
                                <td><?= htmlspecialchars($p['opcion4_pregunta']) ?></td>
                                <td><?= htmlspecialchars($p['correcta_pregunta']) ?></td>
                                <td><?= htmlspecialchars($p['nombre_categoria']) ?></td>
                                <td><?= htmlspecialchars($p['nombre_dificultad']) ?></td>
                                <td>
                                    
                                    <button class="btn btn-danger btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#eliminarModal"
                                            data-id="<?= $p['ID_pregunta'] ?>"
                                            data-enunciado="<?= htmlspecialchars($p['enunciado_pregunta'], ENT_QUOTES) ?>">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" class="text-center">No se encontraron preguntas.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
</div>

<div class="modal fade" id="eliminarModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="../../backend/controllers/eliminarpregunta_controller.php">
          <div class="modal-header">
            <h5 class="modal-title">Confirmar Eliminación</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
              <input type="hidden" name="ID_pregunta" id="modal-id">
              <p>¿Estás seguro de que deseas eliminar la siguiente pregunta?</p>
              <p id="modal-enunciado" class="fw-bold"></p>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger">Eliminar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>
var eliminarModal = document.getElementById('eliminarModal');
eliminarModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget;
  document.getElementById('modal-id').value = button.getAttribute('data-id');
  document.getElementById('modal-enunciado').textContent = button.getAttribute('data-enunciado');
});
</script>
</body>
</html>
