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
    <title>Resultado - ¿Quién Quiere Ser Millonario?</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
        }
        .contenedor-resultado { 
            max-width: 700px; 
            margin: 50px auto; 
            padding: 40px; 
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            text-align: center;
        }
        .resultado-correcto {
            color: #28a745;
            font-size: 2.5em;
            font-weight: bold;
            margin: 20px 0;
        }
        .resultado-incorrecto {
            color: #dc3545;
            font-size: 2.5em;
            font-weight: bold;
            margin: 20px 0;
        }
        .info-respuesta {
            background: #f8f9fa;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            font-size: 1.1em;
        }
        .puntaje {
            font-size: 1.5em;
            color: #333;
            margin: 20px 0;
        }
        .boton {
            padding: 15px 40px;
            font-size: 1.2em;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
            transition: all 0.3s;
        }
        .boton-siguiente {
            background: #28a745;
            color: white;
        }
        .boton-siguiente:hover {
            background: #218838;
            transform: translateY(-2px);
        }
        .boton-reiniciar {
            background: #007bff;
            color: white;
        }
        .boton-reiniciar:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }
        .emoji {
            font-size: 4em;
            margin: 20px 0;
        }
    </style>
</head>
<body>

<div class="contenedor-resultado">
    
    <?php if ($esCorrecta): ?>
        
        <div class="emoji">🎉</div>
        <div class="resultado-correcto">¡CORRECTO!</div>
        
        <div class="info-respuesta">
            <p><strong>Tu respuesta:</strong> <?php echo htmlspecialchars($respuestaElegida); ?></p>
        </div>
        
        <div class="puntaje">
            Preguntas correctas: <strong><?php echo $preguntasCorrectas; ?></strong>
        </div>
        
        <a href="../../backend/controllers/PreguntasController.php" class="boton boton-siguiente">
            📝 Siguiente Pregunta
        </a>
        
    <?php else: ?>
        
        <div class="emoji">😢</div>
        <div class="resultado-incorrecto">INCORRECTO</div>
        
        <div class="info-respuesta">
            <p><strong>Tu respuesta:</strong> <?php echo htmlspecialchars($respuestaElegida); ?></p>
            <p><strong>Respuesta correcta:</strong> <?php echo htmlspecialchars($respuestaCorrectaLetra); ?></p>
        </div>
        
        <div class="puntaje">
            Respondiste correctamente: <strong><?php echo $preguntasCorrectas; ?> pregunta(s)</strong>
        </div>
        
        <h3>¡Juego Terminado!</h3>
        
        <a href="reiniciar.php" class="boton boton-reiniciar">
            🔄 Jugar de Nuevo
        </a>
        
    <?php endif; ?>

</div>

</body>
</html>