<?php
session_start();

if (isset($_SESSION["admin"])) {
    $rol = "admin";
    $enlaceVolver = "menuOpciones.php";
} elseif (isset($_SESSION["aprendiz"])) {
    $rol = "aprendiz";
    $enlaceVolver = "validar_codigo.php";
} else {
    header("Location: login_administrador.php");
    exit;
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
        <h1>Reglas del Juego Millonarios</h1>

        <section>
            <h2>Objetivo del Juego</h2>
            <p>Responder correctamente una serie de preguntas para avanzar y clasificar en el ranking.</p>
        </section>

        <section>
            <h2>Mecánica del Juego</h2>
            <ul>
                <li><strong>Preguntas Múltiples:</strong> Solo una opción correcta.</li>
                <li><strong>Escala de Puntuación:</strong> Avanza si acierta.</li>
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
</html>
