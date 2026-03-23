<?php
session_start();

//  Verificar qué tipo de usuario está en sesión
$esAdmin = isset($_SESSION["admin"]);
$esAprendiz = isset($_SESSION["aprendiz"]);

// Determinar el enlace de volver según el tipo de usuario
if ($esAdmin) {
    $enlaceVolver = "menu.php";
    $tipoUsuario = "admin";
} elseif ($esAprendiz) {
    $enlaceVolver = "login_aprendiz.php";
    $tipoUsuario = "Aprendiz";
} else {
    // Si no hay sesión activa, redirigir al login
    $enlaceVolver = "login_aprendiz.php";
    $tipoUsuario = null;
    $mostrarInfoUsuario = false;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reglas del Juego Millonarios</title>
    <link rel="stylesheet" href="../css/reglas.css">
    <link rel="icon" href="../media/sena logo.png">
</head>

<body>
    <div class="container">
        <h1> Reglas del Juego Millonarios</h1>

        <section>
            <h2> Objetivo del Juego</h2>
            <p>El objetivo principal es responder correctamente una serie de preguntas de conocimiento general para
                avanzar en la escala de puntuación y clasificar en el ranking.</p>
        </section>

        <section>
            <h2> Mecánica del Juego</h2>
            <ul>
                <li><strong>Preguntas Múltiples:</strong> Secuencia de preguntas con cuatro opciones, solo una correcta.</li>
                <li><strong>Escala de Puntuación:</strong> Avanza si responde correctamente.</li>
                <li><strong>Respuesta Incorrecta:</strong> Termina el juego.</li>
                <li><strong>Retirada:</strong> Puede retirarse en cualquier momento y guardar su puntaje.</li>
                <li><strong>Tiempo Límite:</strong> Tienes 2 minutos por pregunta. Si se agota el tiempo, pierdes.</li>
            </ul>
        </section>

        <section>
            <h2> Comodines</h2>
            <p><strong>Cada comodín puede usarse UNA SOLA VEZ por partida:</strong></p>
            <ul>
                <li><strong>50/50:</strong> Elimina dos opciones incorrectas.</li>
                <li><strong>📞 Llamada a un Amigo:</strong> Consulta a un contacto (otorga 30 segundos extra).</li>
                <li><strong>🔄 Cambio de Pregunta:</strong> Cambia la pregunta actual por otra de la misma dificultad.</li>
                <li><strong>👥 Ayuda del Público:</strong> La audiencia vota por la respuesta (otorga 1 minuto extra).</li>
            </ul>
        </section>

        <section>
            <h2> Sistema de Puntaje</h2>
            <ul>
                <li><strong>Pregunta Fácil:</strong> $100,000</li>
                <li><strong>Pregunta Media:</strong> $150,000</li>
                <li><strong>Pregunta Difícil:</strong> $175,000</li>
            </ul>
            <p><strong>Nota:</strong> Las primeras 3 preguntas siempre son fáciles para ayudarte a empezar.</p>
        </section>

        <section>
            <h2> Reglas Importantes</h2>
            <ul>
                <li>No puedes recargar la página para reiniciar el tiempo.</li>
                <li>Si recargas, la pregunta será la misma con el tiempo continuando.</li>
                <li>Solo se guarda tu MEJOR puntaje en la base de datos.</li>
                <li>Los comodines no se pueden usar dos veces en la misma partida.</li>
            </ul>
        </section>

        <div class="footer-actions" style="margin-top: 30px; text-align: center;">
            <a href="<?php echo htmlspecialchars($enlaceVolver); ?>" class="btn btn-secondary" style="display: inline-block; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; padding: 15px 30px; border-radius: 12px; font-weight: 700; transition: all 0.3s ease; box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);">
                 Volver
            </a>
        </div>
    </div>
</body>

</html>