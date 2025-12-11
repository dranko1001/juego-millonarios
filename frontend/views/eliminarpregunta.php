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

// BUSCADOR
$search = trim($_GET['buscar'] ?? '');

// PAGINACIÓN
$porPagina = 10;
$pagina = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
$inicio = ($pagina - 1) * $porPagina;

// CONTAR TOTAL DE REGISTROS
$sqlCount = "SELECT COUNT(*) 
             FROM tbl_preguntas p
             JOIN tbl_categorias c ON p.TBL_categorias_ID_categoria = c.ID_categoria
             JOIN tbl_dificultades d ON p.TBL_dificultades_ID_dificultad = d.ID_dificultad";

$paramsCount = [];

if ($search) {
    $sqlCount .= " WHERE p.enunciado_pregunta LIKE :search";
    $paramsCount[':search'] = "%$search%";
}

$stmtCount = $pdo->prepare($sqlCount);
$stmtCount->execute($paramsCount);
$totalRegistros = $stmtCount->fetchColumn();

$totalPaginas = ceil($totalRegistros / $porPagina);

$sql = "SELECT p.ID_pregunta, p.enunciado_pregunta, 
               p.opcion1_pregunta, p.opcion2_pregunta, p.opcion3_pregunta, p.opcion4_pregunta,
               p.correcta_pregunta, c.ID_categoria, c.nombre_categoria, d.ID_dificultad, d.nombre_dificultad
        FROM tbl_preguntas p
        JOIN tbl_categorias c ON p.TBL_categorias_ID_categoria = c.ID_categoria
        JOIN tbl_dificultades d ON p.TBL_dificultades_ID_dificultad = d.ID_dificultad";

$params = [];

if ($search) {
    $sql .= " WHERE p.enunciado_pregunta LIKE :search";
    $params[':search'] = "%$search%";
}

$sql .= " ORDER BY p.ID_pregunta ASC LIMIT :inicio, :porPagina";

$stmt = $pdo->prepare($sql);

foreach ($params as $k => $v) {
    $stmt->bindValue($k, $v);
}

$stmt->bindValue(':inicio', $inicio, PDO::PARAM_INT);
$stmt->bindValue(':porPagina', $porPagina, PDO::PARAM_INT);

$stmt->execute();
$preguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sqlCat = "SELECT ID_categoria, nombre_categoria FROM tbl_categorias ORDER BY ID_categoria ASC";
$categorias = $pdo->query($sqlCat)->fetchAll();

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
            <input type="text" name="buscar" placeholder="Buscar por texto de la pregunta" class="form-control me-2"
                   value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <?php if ($totalPaginas > 1): ?>
        <div class="d-flex justify-content-end mb-3">
            <div class="btn-group">
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <a href="?pagina=<?= $i ?>&buscar=<?= urlencode($search) ?>"
                       class="btn <?= $i == $pagina ? 'btn-primary' : 'btn-secondary' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
        </div>
        <?php endif; ?>

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
                        <tr><td colspan="10" class="text-center">No se encontraron preguntas.</td></tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>

    </div>

</div>
</div>

<!-- Modal para eliminar -->
<div class="modal fade" id="eliminarModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="../../backend/controllers/eliminarpregunta_controller.php">
          <div class="modal-header">
            <h5 class="modal-title">Eliminar Pregunta</h5>
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
  var id = button.getAttribute('data-id');
  var enunciado = button.getAttribute('data-enunciado');

  document.getElementById('modal-id').value = id;
  document.getElementById('modal-enunciado').textContent = enunciado;
});
</script>

</body>
</html>
