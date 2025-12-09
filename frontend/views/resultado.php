<?php
session_start();
// ✅ DEBUG: Mostrar info de sesión actual
$DEBUG_INFO = [
    'id_jugador' => $_SESSION['id_jugador'] ?? 'NO EXISTE',
    'puntaje_pesos' => $_SESSION['puntaje_pesos'] ?? 'NO EXISTE',
    'preguntas_correctas' => $_SESSION['preguntas_correctas'] ?? 'NO EXISTE',
    'ultima_respuesta' => $_SESSION['ultima_respuesta'] ?? 'NO EXISTE'
];

// Verificar que hay información de respuesta
if (!isset($_SESSION['ultima_respuesta'])) {
    header('Location: ../../backend/controllers/PreguntasController.php');
    exit;
}

$esCorrecta = ($_SESSION['ultima_respuesta'] === 'correcta');
$esTiempoAgotado = ($_SESSION['ultima_respuesta'] === 'tiempo_agotado');
$preguntasCorrectas = $_SESSION['preguntas_correctas'] ?? 0;
$puntajePesos = $_SESSION['puntaje_pesos'] ?? 0;
$ultimoPuntajeGanado = $_SESSION['ultimo_puntaje_ganado'] ?? 0;
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

<!-- DEBUG INFO - Eliminar en producción -->
<div style="position: fixed; bottom: 10px; right: 10px; background: rgba(0,0,0,0.8); color: white; padding: 15px; border-radius: 10px; font-family: monospace; font-size: 12px; max-width: 300px; z-index: 9999;">
    <strong>🔍 DEBUG INFO:</strong><br>
    <strong>ID Jugador:</strong> <?php echo $DEBUG_INFO['id_jugador']; ?><br>
    <strong>Puntaje:</strong> $<?php echo number_format($DEBUG_INFO['puntaje_pesos']); ?><br>
    <strong>Correctas:</strong> <?php echo $DEBUG_INFO['preguntas_correctas']; ?><br>
    <strong>Última resp:</strong> <?php echo $DEBUG_INFO['ultima_respuesta']; ?><br>
    <hr style="border-color: rgba(255,255,255,0.3);">
    <a href="../../backend/ver_logs.php" target="_blank" style="color: #FFD700; text-decoration: none;">📋 Ver Logs Completos</a>
</div>

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

<style>
    /* Estilos adicionales para mejorar la vista */
    .info-pregunta {
        background: rgba(57, 181, 74, 0.1);
        padding: 20px;
        border-radius: 15px;
        margin: 20px 0;
        border-left: 5px solid #39B54A;
    }
    
    .enunciado {
        font-size: 1.2em;
        font-weight: 600;
        color: #333;
        line-height: 1.5;
        margin: 0;
    }
    
    .info-respuesta {
        background: #f8f9fa;
        padding: 15px 20px;
        border-radius: 10px;
        margin: 15px 0;
        border-left: 5px solid #39B54A;
    }
    
    .info-respuesta.error {
        border-left-color: #dc3545;
        background: #fff5f5;
    }
    
    .info-respuesta.correcta {
        border-left-color: #28a745;
        background: #f0fff4;
    }
    
    .info-respuesta p {
        margin: 8px 0;
        font-size: 1.1em;
    }
    
    .respuesta-letra {
        display: inline-block;
        background: #39B54A;
        color: white;
        padding: 4px 10px;
        border-radius: 5px;
        font-weight: bold;
        margin-right: 8px;
    }
    
    .respuesta-letra.incorrecta {
        background: #dc3545;
    }
    
    .info-categoria {
        background: rgba(255, 215, 0, 0.2);
        padding: 12px 20px;
        border-radius: 10px;
        margin: 15px 0;
        text-align: center;
        border: 2px solid #FFD700;
    }
    
    .info-categoria p {
        margin: 0;
        font-size: 1.1em;
        color: #333;
    }
    
    /* ✅ NUEVOS ESTILOS: Puntaje ganado con animación */
    .puntaje-ganado {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        color: white;
        padding: 15px 30px;
        border-radius: 15px;
        margin: 20px 0;
        font-size: 2em;
        font-weight: bold;
        text-align: center;
        box-shadow: 0 5px 20px rgba(255, 215, 0, 0.5);
        animation: pulseGlow 1.5s ease-in-out infinite;
    }
    
    .signo-mas {
        color: #fff;
        font-size: 1.2em;
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
    }
    
    @keyframes pulseGlow {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 5px 20px rgba(255, 215, 0, 0.5);
        }
        50% {
            transform: scale(1.05);
            box-shadow: 0 8px 30px rgba(255, 215, 0, 0.8);
        }
    }
    
    /* ✅ NUEVOS ESTILOS: Puntaje total acumulado */
    .puntaje-total {
        background: linear-gradient(135deg, #39B54A 0%, #00A14B 100%);
        padding: 25px;
        border-radius: 20px;
        margin: 25px 0;
        text-align: center;
        box-shadow: 0 8px 25px rgba(57, 181, 74, 0.4);
        border: 3px solid #fff;
    }
    
    .label-puntaje {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1em;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .valor-puntaje {
        color: #FFD700;
        font-size: 3em;
        font-weight: 900;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        margin: 10px 0;
        letter-spacing: 2px;
    }
    
    .preguntas-correctas {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9em;
        margin-top: 10px;
        font-weight: 500;
    }
    
    /* ✅ NUEVOS ESTILOS: Puntaje final (cuando pierde) */
    .puntaje-final {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        padding: 25px;
        border-radius: 20px;
        margin: 25px 0;
        text-align: center;
        box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
        border: 3px solid #fff;
    }
    
    .label-puntaje-final {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1em;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .valor-puntaje-final {
        color: #FFD700;
        font-size: 2.5em;
        font-weight: 900;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        margin: 10px 0;
        letter-spacing: 2px;
    }
    
    .botones-container {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 25px;
    }
    
    .boton {
        display: block;
        text-align: center;
        padding: 15px 30px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 700;
        font-size: 1.1em;
        transition: all 0.3s ease;
        border: 3px solid transparent;
    }
    
    .boton-siguiente {
        background: linear-gradient(135deg, #39B54A 0%, #00A14B 100%);
        color: white;
        border-color: white;
        box-shadow: 0 5px 20px rgba(57, 181, 74, 0.3);
    }
    
    .boton-cambiar {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        color: #1a1a1a;
        border-color: white;
        box-shadow: 0 5px 20px rgba(255, 165, 0, 0.3);
    }
    
    .boton-reiniciar {
        background: linear-gradient(135deg, #39B54A 0%, #00A14B 100%);
        color: white;
        border-color: white;
        box-shadow: 0 5px 20px rgba(57, 181, 74, 0.3);
    }
    
    .boton-salir {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        color: white;
        border-color: white;
        box-shadow: 0 5px 20px rgba(108, 117, 125, 0.3);
    }
    
    .boton:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }
    
    .boton:active {
        transform: translateY(-1px);
    }
    
    .emoji {
        font-size: 5em;
        margin: 20px 0;
        animation: bounce 1s ease-in-out;
    }
    
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }
    
    @media (max-width: 768px) {
        .enunciado {
            font-size: 1em;
        }
        
        .info-respuesta p {
            font-size: 1em;
        }
        
        .boton {
            font-size: 1em;
            padding: 12px 20px;
        }
        
        .emoji {
            font-size: 4em;
        }
        
        .valor-puntaje {
            font-size: 2em;
        }
        
        .puntaje-ganado {
            font-size: 1.5em;
        }
        
        .valor-puntaje-final {
            font-size: 2em;
        }
    }
</style>

</body>
</html>