<?php
session_start();

<<<<<<< HEAD
if (isset($_SESSION["admin"])) {
    $rol = "admin";
    $enlaceVolver = "menu.php";
} elseif (isset($_SESSION["aprendiz"])) {
    $rol = "aprendiz";
    $enlaceVolver = "validar_codigo.php";
} else {
    header("Location: login_administrador.php");
    exit;
=======
$rol = $_SESSION["rol"] ?? null;

if ($rol === "admin") {
    $enlaceVolver = "menuOpciones.php";
} elseif ($rol === "aprendiz") {
    $enlaceVolver = "validar_codigo.php";
} else {
    // Para "usuario" y cualquier otro rol
    $enlaceVolver = "menu.php";
>>>>>>> a42d31c3e01ccb02d466db6915b87275bf1dabbe
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reglas del Juego Millonarios</title>
    <link rel="stylesheet" href="../css/reglas.css">
</head>

<body>
    <div class="container">
<<<<<<< HEAD
        <h1>Reglas del Juego Millonarios</h1>

        <section>
            <h2>Objetivo del Juego</h2>
            <p>Responder correctamente una serie de preguntas para avanzar y clasificar en el ranking.</p>
=======
        <h1>📋 Reglas del Juego Millonarios</h1>

        <section>
            <h2>Objetivo del Juego</h2>
            <p>El objetivo principal es responder correctamente una serie de preguntas de conocimiento general para
                avanzar en la escala de puntuacion y clasificar en el ranking.</p>
>>>>>>> a42d31c3e01ccb02d466db6915b87275bf1dabbe
        </section>

        <section>
            <h2>Mecánica del Juego</h2>
            <ul>
<<<<<<< HEAD
                <li><strong>Preguntas Múltiples:</strong> Solo una opción correcta.</li>
                <li><strong>Escala de Puntuación:</strong> Avanza si acierta.</li>
=======
                <li><strong>Preguntas Multiples:</strong> Secuencia de preguntas con cuatro opciones, solo una correcta.
                </li>
                <li><strong>Escala de Puntuacion:</strong> Avanza si responde correctamente.</li>
>>>>>>> a42d31c3e01ccb02d466db6915b87275bf1dabbe
                <li><strong>Respuesta Incorrecta:</strong> Termina el juego.</li>
                <li><strong>Retirada:</strong> Puede retirarse en cualquier momento.</li>
            </ul>
        </section>

        <section>
            <h2>Comodines</h2>
            <ul>
                <li><strong>50/50:</strong> Elimina dos opciones incorrectas.</li>
                <li><strong>Llamada:</strong> Consulta a un contacto.</li>
                <li><strong>Cambio de Pregunta:</strong> Cambia la pregunta actual.</li>
                <li><strong>Respuesta del Público:</strong> La audiencia vota.</li>
            </ul>
        </section>

        <a href="<?= $enlaceVolver ?>" class="btn btn-secondary">Volver</a>
    </div>
</body>
<<<<<<< HEAD
=======

>>>>>>> a42d31c3e01ccb02d466db6915b87275bf1dabbe
</html>