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
<title>Editar Preguntas</title>
<link rel="stylesheet" href="../css/preguntas.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container-full">
<h1 class="title-page">Editar Preguntas</h1>

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

        <h2 class="form-title">Buscar y Editar Pregunta</h2>

        
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
                                <button class="btn btn-warning btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editarModal"
                                        data-id="<?= $p['ID_pregunta'] ?>"
                                        data-enunciado="<?= htmlspecialchars($p['enunciado_pregunta'], ENT_QUOTES) ?>"
                                        data-op1="<?= htmlspecialchars($p['opcion1_pregunta'], ENT_QUOTES) ?>"
                                        data-op2="<?= htmlspecialchars($p['opcion2_pregunta'], ENT_QUOTES) ?>"
                                        data-op3="<?= htmlspecialchars($p['opcion3_pregunta'], ENT_QUOTES) ?>"
                                        data-op4="<?= htmlspecialchars($p['opcion4_pregunta'], ENT_QUOTES) ?>"
                                        data-correcta="<?= htmlspecialchars($p['correcta_pregunta'], ENT_QUOTES) ?>"
                                        data-categoria="<?= $p['ID_categoria'] ?>"
                                        data-dificultad="<?= $p['ID_dificultad'] ?>">
                                    Editar
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


<div class="modal fade" id="editarModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="POST" action="../../backend/controllers/editarpregunta_controller.php">
          <div class="modal-header">
            <h5 class="modal-title">Editar Pregunta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
              <input type="hidden" name="ID_pregunta" id="modal-id">

              <div class="mb-3">
                  <label>Pregunta:</label>
                  <textarea name="enunciado_pregunta" id="modal-enunciado" class="form-control" required></textarea>
              </div>

              <div class="mb-2">
                  <label>Opción A:</label>
                  <input type="text" name="opcion1_pregunta" id="modal-op1" class="form-control" required>
              </div>

              <div class="mb-2">
                  <label>Opción B:</label>
                  <input type="text" name="opcion2_pregunta" id="modal-op2" class="form-control" required>
              </div>

              <div class="mb-2">
                  <label>Opción C:</label>
                  <input type="text" name="opcion3_pregunta" id="modal-op3" class="form-control" required>
              </div>

              <div class="mb-2">
                  <label>Opción D:</label>
                  <input type="text" name="opcion4_pregunta" id="modal-op4" class="form-control" required>
              </div>

              <div class="mb-2">
                  <label>Respuesta Correcta:</label>
                  <input type="text" name="correcta_pregunta" id="modal-correcta" class="form-control" required>
              </div>

              <div class="mb-3">
                  <label>Categoría:</label>
                  <select name="ID_categoria" id="modal-categoria" class="form-control" required>
                      <?php foreach($categorias as $cat): ?>
                          <option value="<?= $cat['ID_categoria'] ?>"><?= htmlspecialchars($cat['nombre_categoria']) ?></option>
                      <?php endforeach; ?>
                  </select>
              </div>

              <div class="mb-3">
                  <label>Dificultad:</label>
                  <select name="ID_dificultad" id="modal-dificultad" class="form-control" required>
                      <option value="1">Fácil</option>
                      <option value="2">Medio</option>
                      <option value="3">Difícil</option>
                  </select>
              </div>

          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Guardar Cambios</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>
var editarModal = document.getElementById('editarModal');

editarModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget;

  document.getElementById('modal-id').value = button.getAttribute('data-id');
  document.getElementById('modal-enunciado').value = button.getAttribute('data-enunciado');
  document.getElementById('modal-op1').value = button.getAttribute('data-op1');
  document.getElementById('modal-op2').value = button.getAttribute('data-op2');
  document.getElementById('modal-op3').value = button.getAttribute('data-op3');
  document.getElementById('modal-op4').value = button.getAttribute('data-op4');
  document.getElementById('modal-correcta').value = button.getAttribute('data-correcta');
  document.getElementById('modal-categoria').value = button.getAttribute('data-categoria');
  document.getElementById('modal-dificultad').value = button.getAttribute('data-dificultad');
});
</script>

</body>
</html>
