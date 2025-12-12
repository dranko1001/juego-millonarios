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

        <?php if (isset($_SESSION['msg_pregunta'])): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['msg_pregunta']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['msg_pregunta']); ?>
        <?php endif; ?>

        <!-- Buscador -->
        <form method="GET" class="mb-4 d-flex">
            <input type="text" name="buscar" placeholder="Buscar por texto de la pregunta" class="form-control me-2"
                   value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <?php if ($search): ?>
                <a href="eliminarpregunta.php" class="btn btn-secondary ms-2">Limpiar</a>
            <?php endif; ?>
        </form>

        <!-- Información de paginación -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <small class="text-muted">
                    Mostrando <?= min($inicio + 1, $totalRegistros) ?> - <?= min($inicio + $porPagina, $totalRegistros) ?> 
                    de <?= $totalRegistros ?> preguntas
                </small>
            </div>
        </div>

        <!-- Paginación superior -->
        <?php if ($totalPaginas > 1): ?>
        <div class="d-flex justify-content-end mb-3">
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <!-- Botón anterior -->
                    <li class="page-item <?= $pagina <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?pagina=<?= $pagina - 1 ?>&buscar=<?= urlencode($search) ?>">
                            Anterior
                        </a>
                    </li>

                    <!-- Primera página -->
                    <?php if ($pagina > 3): ?>
                        <li class="page-item">
                            <a class="page-link" href="?pagina=1&buscar=<?= urlencode($search) ?>">1</a>
                        </li>
                        <?php if ($pagina > 4): ?>
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- Páginas cercanas -->
                    <?php 
                    $inicio_pag = max(1, $pagina - 2);
                    $fin_pag = min($totalPaginas, $pagina + 2);
                    
                    for ($i = $inicio_pag; $i <= $fin_pag; $i++): 
                    ?>
                        <li class="page-item <?= $i == $pagina ? 'active' : '' ?>">
                            <a class="page-link" href="?pagina=<?= $i ?>&buscar=<?= urlencode($search) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <!-- Última página -->
                    <?php if ($pagina < $totalPaginas - 2): ?>
                        <?php if ($pagina < $totalPaginas - 3): ?>
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        <?php endif; ?>
                        <li class="page-item">
                            <a class="page-link" href="?pagina=<?= $totalPaginas ?>&buscar=<?= urlencode($search) ?>">
                                <?= $totalPaginas ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- Botón siguiente -->
                    <li class="page-item <?= $pagina >= $totalPaginas ? 'disabled' : '' ?>">
                        <a class="page-link" href="?pagina=<?= $pagina + 1 ?>&buscar=<?= urlencode($search) ?>">
                            Siguiente
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <?php endif; ?>

        <!-- Tabla de preguntas -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th>Pregunta</th>
                        <th>Opción A</th>
                        <th>Opción B</th>
                        <th>Opción C</th>
                        <th>Opción D</th>
                        <th style="width: 80px;">Correcta</th>
                        <th style="width: 120px;">Categoría</th>
                        <th style="width: 100px;">Dificultad</th>
                        <th style="width: 100px;">Acciones</th>
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
                            <td class="text-center">
                                <span class="badge bg-success"><?= htmlspecialchars($p['correcta_pregunta']) ?></span>
                            </td>
                            <td><?= htmlspecialchars($p['nombre_categoria']) ?></td>
                            <td><?= htmlspecialchars($p['nombre_dificultad']) ?></td>
                            <td>
                                <button class="btn btn-danger btn-sm w-100"
                                        onclick="abrirModalEliminar(<?= $p['ID_pregunta'] ?>, '<?= htmlspecialchars($p['enunciado_pregunta'], ENT_QUOTES) ?>')">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                                    <p class="mt-2">No se encontraron preguntas<?= $search ? ' con el criterio de búsqueda' : '' ?>.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>

        <!-- Paginación inferior -->
        <?php if ($totalPaginas > 1): ?>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                <small class="text-muted">Página <?= $pagina ?> de <?= $totalPaginas ?></small>
            </div>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item <?= $pagina <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?pagina=<?= $pagina - 1 ?>&buscar=<?= urlencode($search) ?>">
                            Anterior
                        </a>
                    </li>

                    <?php 
                    $inicio_pag = max(1, $pagina - 2);
                    $fin_pag = min($totalPaginas, $pagina + 2);
                    
                    for ($i = $inicio_pag; $i <= $fin_pag; $i++): 
                    ?>
                        <li class="page-item <?= $i == $pagina ? 'active' : '' ?>">
                            <a class="page-link" href="?pagina=<?= $i ?>&buscar=<?= urlencode($search) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item <?= $pagina >= $totalPaginas ? 'disabled' : '' ?>">
                        <a class="page-link" href="?pagina=<?= $pagina + 1 ?>&buscar=<?= urlencode($search) ?>">
                            Siguiente
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <?php endif; ?>

    </div>

</div>
</div>

<!-- Modal para eliminar -->
<div class="modal fade" id="eliminarModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="../../backend/controllers/eliminarpregunta_controller.php">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title">
                <i class="bi bi-exclamation-triangle-fill"></i> Eliminar Pregunta
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
              <input type="hidden" name="ID_pregunta" id="modal-id">
              <input type="hidden" name="pagina_actual" value="<?= $pagina ?>">
              <input type="hidden" name="buscar" value="<?= htmlspecialchars($search) ?>">
              
              <div class="alert alert-warning">
                  <i class="bi bi-exclamation-circle"></i>
                  <strong>¡Atención!</strong> Esta acción no se puede deshacer.
              </div>
              
              <p class="mb-2">¿Estás seguro de que deseas eliminar la siguiente pregunta?</p>
              <div class="card">
                  <div class="card-body">
                      <p id="modal-enunciado" class="fw-bold mb-0"></p>
                  </div>
              </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="bi bi-x-circle"></i> Cancelar
            </button>
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-trash"></i> Sí, eliminar
            </button>
          </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>
function abrirModalEliminar(id, enunciado) {
    document.getElementById('modal-id').value = id;
    document.getElementById('modal-enunciado').textContent = enunciado;
    
    const modal = new bootstrap.Modal(document.getElementById('eliminarModal'));
    modal.show();
}
</script>

</body>
</html>