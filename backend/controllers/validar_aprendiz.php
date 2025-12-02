<?php
require_once "../models/MySQL.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ficha = $_POST["ficha"];
    $usuario = $_POST["usuario_jugador"];

    $db = new MySQL();
    $conn = $db->conectar();

    $sql = "SELECT * FROM tbl_jugadores
            WHERE ficha_jugador = '$ficha'
            AND usuario_jugador = '$usuario'";

    $resultado = $db->efectuarConsulta($sql);

    if (mysqli_num_rows($resultado) > 0) {

        $_SESSION["aprendiz"] = $usuario;
        header("Location: ../../frontend/views/prueba.html");
        exit();

    } else {

        header("Location: ../views/login_aprendiz.php");
        exit();
    }
}
?>
