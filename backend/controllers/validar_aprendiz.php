<?php

require_once "../models/pdoconexion.php"; 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ficha = trim($_POST["ficha"]);
    $usuario = trim($_POST["usuario_jugador"]); 

    // Validar campos vacíos
    if (empty($ficha) || empty($usuario)) {
        header("Location: ../../frontend/views/login_aprendiz.php?error=campos_vacios");
        exit();
    }

    $db = new PDOConnection();
    $conn = $db->conectar(); 

    // Primero verificar si el jugador existe
    $sqlVerificar = "SELECT * FROM tbl_jugadores
                     WHERE ficha_jugador = :ficha
                     AND usuario_jugador = :usuario";

    try {
        $stmtVerificar = $conn->prepare($sqlVerificar);
        $stmtVerificar->execute([':ficha' => $ficha, ':usuario' => $usuario]);

        if ($stmtVerificar->rowCount() > 0) {
            // Jugador existe
            $jugador = $stmtVerificar->fetch(PDO::FETCH_ASSOC);
            $_SESSION["aprendiz"] = $usuario;
            $_SESSION["ficha_aprendiz"] = $ficha;
            $_SESSION["id_jugador"] = $jugador['ID_jugador'];
            
        } else {
            // Jugador no existe, crear uno nuevo
            $sqlInsertar = "INSERT INTO tbl_jugadores (ficha_jugador, usuario_jugador, puntaje_jugador) 
                           VALUES (:ficha, :usuario, 0)";
            
            $stmtInsertar = $conn->prepare($sqlInsertar);
            $stmtInsertar->execute([':ficha' => $ficha, ':usuario' => $usuario]);
            
            $_SESSION["aprendiz"] = $usuario;
            $_SESSION["ficha_aprendiz"] = $ficha;
            $_SESSION["id_jugador"] = $conn->lastInsertId();
        }
        
        // Redirigir a validar código
        header("Location: ../../frontend/views/validar_codigo.php");
        exit();

    } catch (PDOException $e) {
        error_log("Error en validar_aprendiz: " . $e->getMessage());
        header("Location: ../../frontend/views/login_aprendiz.php?error=db_error");
        exit();
    }
}
?>