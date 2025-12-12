<?php
session_start();
require_once __DIR__ . "/../models/pdoconexion.php";

$db = new PDOConnection();
$pdo = $db->getConexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pregunta      = intval($_POST['ID_pregunta'] ?? 0);
    $enunciado        = trim($_POST['enunciado_pregunta'] ?? '');
    $opcion1          = trim($_POST['opcion1_pregunta'] ?? '');
    $opcion2          = trim($_POST['opcion2_pregunta'] ?? '');
    $opcion3          = trim($_POST['opcion3_pregunta'] ?? '');
    $opcion4          = trim($_POST['opcion4_pregunta'] ?? '');
    $correcta         = strtoupper(trim($_POST['correcta_pregunta'] ?? '')); // A, B, C o D
    $categoria_id     = intval($_POST['ID_categoria'] ?? 0);
    $dificultad_id    = intval($_POST['ID_dificultad'] ?? 0);
    $pagina_actual    = intval($_POST['pagina_actual'] ?? 1);
    $buscar           = trim($_POST['buscar'] ?? '');

    // Validar que la respuesta correcta sea A, B, C o D
    if (!in_array($correcta, ['A', 'B', 'C', 'D'])) {
        $_SESSION['msg_editar'] = "✗ La respuesta correcta debe ser A, B, C o D.";
        
        $url = "../../frontend/views/editarpregunta.php?pagina=$pagina_actual";
        if ($buscar) {
            $url .= "&buscar=" . urlencode($buscar);
        }
        
        header("Location: $url");
        exit();
    }

    if ($id_pregunta && $enunciado && $opcion1 && $opcion2 && $opcion3 && $opcion4 && $correcta && $categoria_id && $dificultad_id) {
        try {
            // Mapear la letra a su texto correspondiente
            $textoCorrecta = '';
            switch ($correcta) {
                case 'A':
                    $textoCorrecta = $opcion1;
                    break;
                case 'B':
                    $textoCorrecta = $opcion2;
                    break;
                case 'C':
                    $textoCorrecta = $opcion3;
                    break;
                case 'D':
                    $textoCorrecta = $opcion4;
                    break;
            }

            $sql = "UPDATE tbl_preguntas SET
                        enunciado_pregunta = :enunciado,
                        opcion1_pregunta   = :op1,
                        opcion2_pregunta   = :op2,
                        opcion3_pregunta   = :op3,
                        opcion4_pregunta   = :op4,
                        correcta_pregunta  = :correcta,
                        TBL_categorias_ID_categoria = :categoria,
                        TBL_dificultades_ID_dificultad = :dificultad
                    WHERE ID_pregunta = :id";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':enunciado' => $enunciado,
                ':op1'       => $opcion1,
                ':op2'       => $opcion2,
                ':op3'       => $opcion3,
                ':op4'       => $opcion4,
                ':correcta'  => $textoCorrecta,  // Ahora guarda el texto completo
                ':categoria' => $categoria_id,
                ':dificultad'=> $dificultad_id,
                ':id'        => $id_pregunta
            ]);

            if ($stmt->rowCount() > 0) {
                $_SESSION['msg_editar'] = "✓ Pregunta actualizada correctamente.";
            } else {
                $_SESSION['msg_editar'] = "⚠ No se realizaron cambios en la pregunta.";
            }
        } catch (PDOException $e) {
            $_SESSION['msg_editar'] = "✗ Error al actualizar la pregunta: " . $e->getMessage();
        }
    } else {
        $_SESSION['msg_editar'] = "✗ Todos los campos son obligatorios.";
    }

    // Mantener la página y búsqueda actual
    $url = "../../frontend/views/editarpregunta.php?pagina=$pagina_actual";
    if ($buscar) {
        $url .= "&buscar=" . urlencode($buscar);
    }
    
    header("Location: $url");
    exit();
}
?>