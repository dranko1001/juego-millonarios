<?php
session_start();
require_once __DIR__ . "/../models/pdoconexion.php";

$db = new PDOConnection();
$pdo = $db->getConexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recoger datos del formulario
    $enunciado       = trim($_POST['enunciado_pregunta'] ?? '');
    $opcion1         = trim($_POST['opcion1_pregunta'] ?? '');
    $opcion2         = trim($_POST['opcion2_pregunta'] ?? '');
    $opcion3         = trim($_POST['opcion3_pregunta'] ?? '');
    $opcion4         = trim($_POST['opcion4_pregunta'] ?? '');
    $correcta        = intval($_POST['correcta_pregunta'] ?? 0);
    $categoria_id    = intval($_POST['ID_categoria'] ?? 0);
    $dificultad_id   = intval($_POST['ID_dificultad'] ?? 0);

    // Validar que todos los campos estén completos
    if ($enunciado && $opcion1 && $opcion2 && $opcion3 && $opcion4 && $correcta && $categoria_id && $dificultad_id) {

        try {
            // Insertar en la tabla tbl_preguntas
            $sql = "INSERT INTO tbl_preguntas 
                    (enunciado_pregunta, opcion1_pregunta, opcion2_pregunta, opcion3_pregunta, opcion4_pregunta, correcta_pregunta, TBL_categorias_ID_categoria, TBL_dificultades_ID_dificultad)
                    VALUES
                    (:enunciado, :op1, :op2, :op3, :op4, :correcta, :categoria, :dificultad)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':enunciado'  => $enunciado,
                ':op1'        => $opcion1,
                ':op2'        => $opcion2,
                ':op3'        => $opcion3,
                ':op4'        => $opcion4,
                ':correcta'   => $correcta,
                ':categoria'  => $categoria_id,
                ':dificultad' => $dificultad_id
            ]);

            $_SESSION['msg_pregunta'] = "Pregunta creada correctamente.";

        } catch (PDOException $e) {
            $_SESSION['msg_pregunta'] = "Error al guardar la pregunta: " . $e->getMessage();
        }

    } else {
        $_SESSION['msg_pregunta'] = "Todos los campos son obligatorios.";
    }

    // Redirigir de vuelta al formulario
    header("Location: ../../../../frontend/views/crearpregunta.php");
    exit();
}
