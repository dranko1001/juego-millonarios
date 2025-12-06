<?php
// frontend/views/categoria_completada.php
session_start();

// Verificar autenticación
if (!isset($_SESSION["aprendiz"]) || !isset($_SESSION["codigo_validado"])) {
    header("Location: login_aprendiz.php");
    exit();
}

$categoriaNombre = $_SESSION['categoria_nombre'] ?? 'Desconocida';
$preguntasCorrectas = $_SESSION['preguntas_correctas'] ?? 0;
$preguntasRespondidas = count($_SESSION['preguntas_respondidas'] ?? []);
$aprendiz = $_SESSION['aprendiz'] ?? 'Aprendiz';

// Calcular porcentaje
$porcentaje = $preguntasRespondidas > 0 ? round(($preguntasCorrectas / $preguntasRespondidas) * 100) : 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Categoría Completada! - Millonarios SENA</title>
    <link rel="stylesheet" href="../css/resultado.css">
</head>
<body>

<div class="contenedor-resultado">
    
    <div class="emoji">🎉</div>
    
    <div class="resultado-correcto" style="font-size: 2.5em; margin-bottom: 20px;">
        ¡CATEGORÍA COMPLETADA!
    </div>
    
    <div class="felicitaciones">
        <h2>🏆 ¡Felicitaciones, <?php echo htmlspecialchars($aprendiz); ?>! 🏆</h2>
        <p>Has completado todas las preguntas de la categoría:</p>
    </div>
    
    <div class="info-categoria-final">
        <h3>📚 <?php echo htmlspecialchars($categoriaNombre); ?></h3>
    </div>
    
    <div class="estadisticas">
        <div class="stat-item">
            <div class="stat-icon">📝</div>
            <div class="stat-number"><?php echo $preguntasRespondidas; ?></div>
            <div class="stat-label">Preguntas<br>Respondidas</div>
        </div>
        
        <div class="stat-item">
            <div class="stat-icon">✅</div>
            <div class="stat-number"><?php echo $preguntasCorrectas; ?></div>
            <div class="stat-label">Respuestas<br>Correctas</div>
        </div>
        
        <div class="stat-item">
            <div class="stat-icon">📊</div>
            <div class="stat-number"><?php echo $porcentaje; ?>%</div>
            <div class="stat-label">Porcentaje de<br>Acierto</div>
        </div>
    </div>
    
    <div class="mensaje-motivacional">
        <?php
        if ($porcentaje >= 90) {
            echo "🌟 ¡Excelente! Dominas completamente este tema.";
        } elseif ($porcentaje >= 70) {
            echo "👏 ¡Muy bien! Tienes un buen conocimiento de este tema.";
        } elseif ($porcentaje >= 50) {
            echo "💪 ¡Buen intento! Sigue practicando para mejorar.";
        } else {
            echo "📚 Sigue estudiando, cada intento te hace mejor.";
        }
        ?>
    </div>
    
    <div class="botones-container">
        <a href="reiniciar.php?cambiar_categoria=1" class="boton boton-nueva-categoria">
            📚 Seleccionar Otra Categoría
        </a>
        
        <a href="reiniciar.php" class="boton boton-reintentar">
            🔄 Reintentar Esta Categoría
        </a>
        
        <a href="../../backend/controllers/logout.php" class="boton boton-salir">
            🚪 Cerrar Sesión
        </a>
    </div>

</div>

<style>
    body {
        background: linear-gradient(135deg, #39B54A 0%, #ffffff 100%);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .contenedor-resultado {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 25px;
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
        padding: 40px;
        max-width: 800px;
        width: 100%;
        animation: fadeInUp 0.8s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .emoji {
        font-size: 5em;
        text-align: center;
        margin: 20px 0;
        animation: celebrate 1.5s ease-in-out infinite;
    }
    
    @keyframes celebrate {
        0%, 100% { transform: scale(1) rotate(0deg); }
        25% { transform: scale(1.2) rotate(-15deg); }
        50% { transform: scale(1) rotate(0deg); }
        75% { transform: scale(1.2) rotate(15deg); }
    }

    .resultado-correcto {
        text-align: center;
        color: #39B54A;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-shadow: 0 3px 10px rgba(57, 181, 74, 0.3);
    }
    
    .felicitaciones {
        text-align: center;
        margin: 30px 0;
        padding: 25px;
        background: linear-gradient(135deg, rgba(57, 181, 74, 0.1), rgba(255, 215, 0, 0.1));
        border-radius: 15px;
        border: 3px solid #39B54A;
        box-shadow: 0 5px 20px rgba(57, 181, 74, 0.2);
    }
    
    .felicitaciones h2 {
        color: #39B54A;
        font-size: 2em;
        margin-bottom: 15px;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    .felicitaciones p {
        color: #666;
        font-size: 1.2em;
        margin: 0;
        font-weight: 500;
    }
    
    .info-categoria-final {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        padding: 25px;
        border-radius: 15px;
        margin: 25px 0;
        text-align: center;
        box-shadow: 0 10px 30px rgba(255, 165, 0, 0.4);
        border: 3px solid white;
    }
    
    .info-categoria-final h3 {
        color: #1a1a1a;
        font-size: 2em;
        margin: 0;
        font-weight: 800;
        text-shadow: 0 2px 5px rgba(255, 255, 255, 0.5);
    }
    
    .estadisticas {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin: 30px 0;
    }
    
    .stat-item {
        background: white;
        padding: 25px 15px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        border: 3px solid #39B54A;
        transition: all 0.3s ease;
    }
    
    .stat-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(57, 181, 74, 0.3);
    }

    .stat-icon {
        font-size: 2.5em;
        margin-bottom: 10px;
    }
    
    .stat-number {
        font-size: 3em;
        font-weight: 800;
        color: #39B54A;
        margin-bottom: 10px;
        text-shadow: 0 2px 5px rgba(57, 181, 74, 0.2);
        line-height: 1;
    }
    
    .stat-label {
        font-size: 0.9em;
        color: #666;
        font-weight: 600;
        line-height: 1.3;
    }
    
    .mensaje-motivacional {
        background: rgba(57, 181, 74, 0.1);
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        font-size: 1.3em;
        font-weight: 600;
        color: #39B54A;
        margin: 25px 0;
        border: 2px solid #39B54A;
        box-shadow: 0 5px 15px rgba(57, 181, 74, 0.2);
    }
    
    .botones-container {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-top: 30px;
    }
    
    .boton {
        display: block;
        text-align: center;
        padding: 18px 30px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 700;
        font-size: 1.1em;
        transition: all 0.3s ease;
        border: 3px solid white;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    }
    
    .boton-nueva-categoria {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        color: #1a1a1a;
    }
    
    .boton-reintentar {
        background: linear-gradient(135deg, #39B54A 0%, #00A14B 100%);
        color: white;
    }
    
    .boton-salir {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        color: white;
    }
    
    .boton:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }
    
    .boton:active {
        transform: translateY(-1px);
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .contenedor-resultado {
            padding: 25px;
        }

        .felicitaciones h2 {
            font-size: 1.5em;
        }
        
        .info-categoria-final h3 {
            font-size: 1.5em;
        }
        
        .estadisticas {
            grid-template-columns: 1fr;
            gap: 15px;
        }
        
        .stat-number {
            font-size: 2.5em;
        }

        .stat-label {
            font-size: 0.85em;
        }

        .mensaje-motivacional {
            font-size: 1.1em;
        }

        .boton {
            font-size: 1em;
            padding: 15px 20px;
        }

        .emoji {
            font-size: 4em;
        }
    }

    @media (max-width: 480px) {
        .resultado-correcto {
            font-size: 1.8em !important;
        }

        .felicitaciones h2 {
            font-size: 1.3em;
        }

        .felicitaciones p {
            font-size: 1em;
        }

        .stat-icon {
            font-size: 2em;
        }

        .stat-number {
            font-size: 2em;
        }
    }
</style>

</body>
</html>