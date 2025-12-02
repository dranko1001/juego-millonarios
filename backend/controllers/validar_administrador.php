<?php
require_once "../models/MySQL.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    $db = new MySQL();
    $conn = $db->conectar();

    $usuario = mysqli_real_escape_string($conn, $usuario);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM tbl_administradores 
            WHERE usuario_administrador = '$usuario'
            AND password_administrador = '$password'";

    $resultado = $db->efectuarConsulta($sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {

        $_SESSION["admin"] = $usuario;

        header("Location: ../../frontend/views/menu.html");
        exit();

    } else {
        header("Location: ../views/login_administrador.php");
        exit();
    }

}
?>
