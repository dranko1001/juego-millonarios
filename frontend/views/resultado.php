<?php
session_start();

if (!isset($_SESSION['puntaje_pesos'])) {
    $_SESSION['puntaje_pesos'] = 0;
}

if (!isset($_SESSION['preguntas_correctas'])) {
    $_SESSION['preguntas_correctas'] = 0;
}



$esCorrecta = ($_SESSION['ultima_respuesta'] === 'correcta');
$esTiempoAgotado = ($_SESSION['ultima_respuesta'] === 'tiempo_agotado');
$preguntasCorrectas = (int)($_SESSION['preguntas_correctas'] ?? 0); 
$puntajePesos = (int)($_SESSION['puntaje_pesos'] ?? 0); 
$ultimoPuntajeGanado = (int)($_SESSION['ultimo_puntaje_ganado'] ?? 0); 
$respuestaElegida = $_SESSION['respuesta_elegida'] ?? '';
$respuestaCorrectaLetra = $_SESSION['respuesta_correcta_letra'] ?? '';
$respuestaCorrectaTexto = $_SESSION['respuesta_correcta_texto'] ?? '';
$enunciado = $_SESSION['enunciado_actual'] ?? '';
$categoriaNombre = $_SESSION['categoria_nombre'] ?? 'Desconocida';

// Obtener el texto de la opción elegida
$opcionesMostradas = $_SESSION['opciones_mostradas'] ?? [];
$textoRespuestaElegida = $opcionesMostradas[$respuestaElegida] ?? '';
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

    <?php if ($esTiempoAgotado): ?>
        <!-- ============ CASO: TIEMPO AGOTADO ============ -->
        <div class="emoji">⏰</div>
        <div class="resultado-incorrecto" style="color: #ff9800;">¡TIEMPO AGOTADO!</div>
        
        <div class="info-pregunta">
            <p class="enunciado"><?php echo htmlspecialchars($enunciado); ?></p>
        </div>
        
        <div class="info-respuesta correcta">
            <p><strong>Respuesta correcta era:</strong> <span class="respuesta-letra"><?php echo htmlspecialchars($respuestaCorrectaLetra); ?>:</span> <?php echo htmlspecialchars($respuestaCorrectaTexto); ?></p>
        </div>
        
        <div class="info-categoria">
            <p>📚 Categoría: <strong><?php echo htmlspecialchars($categoriaNombre); ?></strong></p>
        </div>
        
        <div class="puntaje-final">
            <div class="label-puntaje-final">💵 Puntaje Final:</div>
            <div class="valor-puntaje-final">$<?php echo number_format($puntajePesos); ?></div>
            <div class="preguntas-correctas"><?php echo $preguntasCorrectas; ?> pregunta<?php echo $preguntasCorrectas != 1 ? 's' : ''; ?> correcta<?php echo $preguntasCorrectas != 1 ? 's' : ''; ?></div>
        </div>
        
        <h3>¡Se acabó el tiempo!</h3>
        <p style="color: #fff; margin: 15px 0;">No respondiste a tiempo, pero tu puntaje ha sido guardado.</p>
        
        <div class="botones-container">
            <a href="reiniciar.php" class="boton boton-reiniciar">
                🔄 Jugar de Nuevo (Misma Categoría)
            </a>
            
            <a href="reiniciar.php?cambiar_categoria=1" class="boton boton-cambiar">
                📚 Cambiar Categoría
            </a>
            
            <a href="../../backend/controllers/logout.php" class="boton boton-salir">
                🚪 Salir
            </a>
        </div>
        
    <?php elseif ($esCorrecta): ?>
        <!-- ============ CASO: RESPUESTA CORRECTA ============ -->
        <div class="emoji">🎉</div>
        <div class="resultado-correcto">¡CORRECTO!</div>
        
        <?php if ($ultimoPuntajeGanado > 0): ?>
        <div class="puntaje-ganado">
            <span class="signo-mas">+</span> $<?php echo number_format($ultimoPuntajeGanado); ?>
        </div>
        <?php endif; ?>
        
        <div class="info-pregunta">
            <p class="enunciado"><?php echo htmlspecialchars($enunciado); ?></p>
        </div>
        
        <div class="info-respuesta">
            <p><strong>Tu respuesta:</strong> <span class="respuesta-letra"><?php echo htmlspecialchars($respuestaElegida); ?>:</span> <?php echo htmlspecialchars($textoRespuestaElegida); ?></p>
        </div>
        
        <div class="info-categoria">
            <p>📚 Categoría: <strong><?php echo htmlspecialchars($categoriaNombre); ?></strong></p>
        </div>
        
        <div class="puntaje-total">
            <div class="label-puntaje">💰 Puntaje Acumulado:</div>
            <div class="valor-puntaje">$<?php echo number_format($puntajePesos); ?></div>
            <div class="preguntas-correctas"><?php echo $preguntasCorrectas; ?> pregunta<?php echo $preguntasCorrectas != 1 ? 's' : ''; ?> correcta<?php echo $preguntasCorrectas != 1 ? 's' : ''; ?></div>
        </div>
        
        <div class="botones-container">
            <a href="../../backend/controllers/PreguntasController.php" class="boton boton-siguiente">
                ➡️ Siguiente Pregunta
            </a>
            
            <a href="reiniciar.php?cambiar_categoria=1" 
               onclick="return confirm('¿Deseas cambiar de categoría? Tu progreso se reiniciará.')"
               class="boton boton-cambiar">
                🔄 Cambiar Categoría
            </a>
        </div>
        
    <?php else: ?>
        <!-- ============ CASO: RESPUESTA INCORRECTA ============ -->
        <div class="emoji">😢</div>
        <div class="resultado-incorrecto">INCORRECTO</div>
        
        <div class="info-pregunta">
            <p class="enunciado"><?php echo htmlspecialchars($enunciado); ?></p>
        </div>
        
        <div class="info-respuesta error">
            <p><strong>Tu respuesta:</strong> <span class="respuesta-letra incorrecta"><?php echo htmlspecialchars($respuestaElegida); ?>:</span> <?php echo htmlspecialchars($textoRespuestaElegida); ?></p>
        </div>
        
        <div class="info-respuesta correcta">
            <p><strong>Respuesta correcta:</strong> <span class="respuesta-letra"><?php echo htmlspecialchars($respuestaCorrectaLetra); ?>:</span> <?php echo htmlspecialchars($respuestaCorrectaTexto); ?></p>
        </div>
        
        <div class="info-categoria">
            <p>📚 Categoría: <strong><?php echo htmlspecialchars($categoriaNombre); ?></strong></p>
        </div>
        
        <div class="puntaje-final">
            <div class="label-puntaje-final">💵 Puntaje Final:</div>
            <div class="valor-puntaje-final">$<?php echo number_format($puntajePesos); ?></div>
            <div class="preguntas-correctas"><?php echo $preguntasCorrectas; ?> pregunta<?php echo $preguntasCorrectas != 1 ? 's' : ''; ?> correcta<?php echo $preguntasCorrectas != 1 ? 's' : ''; ?></div>
        </div>
        
        <h3>¡Juego Terminado!</h3>
        
        <div class="botones-container">
            <a href="reiniciar.php" class="boton boton-reiniciar">
                🔄 Jugar de Nuevo (Misma Categoría)
            </a>
            
            <a href="reiniciar.php?cambiar_categoria=1" class="boton boton-cambiar">
                📚 Cambiar Categoría
            </a>
            
            <a href="../../backend/controllers/logout.php" class="boton boton-salir">
                🚪 Salir
            </a>
        </div>
        
    <?php endif; ?>

</div>

</body>
</html>