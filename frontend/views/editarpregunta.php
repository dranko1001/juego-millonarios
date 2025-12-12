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

        <?php if (isset($_SESSION['msg_editar'])): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['msg_editar']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['msg_editar']); ?>
        <?php endif; ?>

        <!-- Buscador -->
        <form method="GET" class="mb-4 d-flex">
            <input type="text" name="buscar" placeholder="Buscar por texto de la pregunta" class="form-control me-2"
                   value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <?php if ($search): ?>
                <a href="editarpregunta.php" class="btn btn-secondary ms-2">Limpiar</a>
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
                                <button class="btn btn-warning btn-sm w-100"
                                        onclick="abrirModalEdicion(<?= htmlspecialchars(json_encode($p), ENT_QUOTES) ?>)">
                                    <i class="bi bi-pencil"></i> Editar
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


<!-- Modal para editar -->
<div class="modal fade" id="editarModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="POST" action="../../backend/controllers/editarpregunta_controller.php">
          <div class="modal-header bg-warning text-dark">
            <h5 class="modal-title">
                <i class="bi bi-pencil-square"></i> Editar Pregunta
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
              <input type="hidden" name="ID_pregunta" id="modal-id">
              <input type="hidden" name="pagina_actual" value="<?= $pagina ?>">
              <input type="hidden" name="buscar" value="<?= htmlspecialchars($search) ?>">

              <div class="mb-3">
                  <label class="form-label fw-bold">Pregunta:</label>
                  <textarea name="enunciado_pregunta" id="modal-enunciado" class="form-control" rows="3" required></textarea>
              </div>

              <div class="mb-3 border p-3 rounded bg-light">
                  <label class="form-label fw-bold mb-3">Opciones de Respuesta:</label>
                  
                  <div class="mb-2">
                      <div class="input-group">
                          <div class="input-group-text">
                              <input type="radio" name="correcta_pregunta" value="A" id="radio-A" required>
                          </div>
                          <span class="input-group-text"><strong>A)</strong></span>
                          <input type="text" name="opcion1_pregunta" id="modal-op1" class="form-control" required>
                      </div>
                  </div>

                  <div class="mb-2">
                      <div class="input-group">
                          <div class="input-group-text">
                              <input type="radio" name="correcta_pregunta" value="B" id="radio-B" required>
                          </div>
                          <span class="input-group-text"><strong>B)</strong></span>
                          <input type="text" name="opcion2_pregunta" id="modal-op2" class="form-control" required>
                      </div>
                  </div>

                  <div class="mb-2">
                      <div class="input-group">
                          <div class="input-group-text">
                              <input type="radio" name="correcta_pregunta" value="C" id="radio-C" required>
                          </div>
                          <span class="input-group-text"><strong>C)</strong></span>
                          <input type="text" name="opcion3_pregunta" id="modal-op3" class="form-control" required>
                      </div>
                  </div>

                  <div class="mb-2">
                      <div class="input-group">
                          <div class="input-group-text">
                              <input type="radio" name="correcta_pregunta" value="D" id="radio-D" required>
                          </div>
                          <span class="input-group-text"><strong>D)</strong></span>
                          <input type="text" name="opcion4_pregunta" id="modal-op4" class="form-control" required>
                      </div>
                  </div>

                  <small class="text-muted">
                      <i class="bi bi-info-circle"></i> Selecciona el radio button de la respuesta correcta
                  </small>
              </div>

              <div class="row">
                  <div class="col-md-6 mb-3">
                      <label class="form-label fw-bold">Categoría:</label>
                      <select name="ID_categoria" id="modal-categoria" class="form-select" required>
                          <?php foreach($categorias as $cat): ?>
                              <option value="<?= $cat['ID_categoria'] ?>"><?= htmlspecialchars($cat['nombre_categoria']) ?></option>
                          <?php endforeach; ?>
                      </select>
                  </div>

                  <div class="col-md-6 mb-3">
                      <label class="form-label fw-bold">Dificultad:</label>
                      <select name="ID_dificultad" id="modal-dificultad" class="form-select" required>
                          <option value="1">Fácil</option>
                          <option value="2">Medio</option>
                          <option value="3">Difícil</option>
                      </select>
                  </div>
              </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="bi bi-x-circle"></i> Cancelar
            </button>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle"></i> Guardar Cambios
            </button>
          </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/editarpregunta.js"></script>

</body>
</html>