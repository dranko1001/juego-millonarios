<?php
session_start();

// Verificar que hay información de respuesta
if (!isset($_SESSION['ultima_respuesta'])) {
    header('Location: ../controllers/PreguntaController.php');
    exit;
}

$esCorrecta = ($_SESSION['ultima_respuesta'] === 'correcta');
$preguntasCorrectas = $_SESSION['preguntas_correctas'] ?? 0;
$respuestaElegida = $_SESSION['respuesta_elegida'] ?? '';
$respuestaCorrectaLetra = $_SESSION['respuesta_correcta_letra'] ?? '';
$enunciado = $_SESSION['enunciado_actual'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado - ¿Quién Quiere Ser Millonario?</title>
    <link rel="stylesheet" href="../css/resultado.css">
</head>
<body>

<div class="contenedor-resultado">
    
    <?php if ($esCorrecta): ?>
        
        
        <!-- <div class="emoji">🎉</div> -->
        <div class="resultado-correcto">¡CORRECTO!</div>
        
        <div class="info-respuesta">
            <p><strong>Tu respuesta:</strong> <?php echo htmlspecialchars($respuestaElegida); ?></p>
        </div>
        
        <div class="puntaje">
            Puntaje: <strong><?php echo $preguntasCorrectas; ?></strong>
        </div>
        
        <a href="../../backend/controllers/PreguntasController.php" class="boton boton-siguiente">
             Siguiente Pregunta
        </a>
        
    <?php else: ?>
        
        
        <!-- <div class="emoji"></div> --> 
        <div class="resultado-incorrecto">INCORRECTO</div>
        
        <div class="info-respuesta">
            <p><strong>Tu respuesta:</strong> <?php echo htmlspecialchars($respuestaElegida); ?></p>
            <p><strong>Respuesta correcta:</strong> <?php echo htmlspecialchars($respuestaCorrectaLetra); ?></p>
        </div>
        
        <div class="puntaje">
            Puntaje total: <strong><?php echo $preguntasCorrectas; ?> pregunta(s)</strong>
        </div>
        
        <h3>¡Juego Terminado!</h3>
        
        <a href="reiniciar.php" class="boton boton-reiniciar">
             Jugar de Nuevo
        </a>
        
    <?php endif; ?>

</div>

</body>
</html>