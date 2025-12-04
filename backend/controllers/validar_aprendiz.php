<?php
require_once "../models/pdoconexion.php"; 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ficha = $_POST["ficha"];
    $usuario = $_POST["usuario_jugador"]; 

    $db = new PDOConnection();
    $conn = $db->conectar(); 

    $sql = "SELECT * FROM tbl_jugadores
            WHERE ficha_jugador = :ficha
            AND usuario_jugador = :usuario";

    try {
        $stmt = $conn->prepare($sql);

        $stmt->execute([':ficha' => $ficha, ':usuario' => $usuario]);

        if ($stmt->rowCount() > 0) {

            $_SESSION["aprendiz"] = $usuario;
            header("Location: ../../frontend/views/prueba.html");
            exit();

        } else {
            header("Location: ../views/login_aprendiz.php?error=invalido");
            exit();
        }

    } catch (PDOException $e) {
        header("Location: ../views/login_aprendiz.php?error=db_error");
        exit();
    }
}
?>