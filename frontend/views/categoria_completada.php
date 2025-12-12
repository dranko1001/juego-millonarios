<?php
session_start();

// Variables recibidas desde el controlador
$aprendiz = $_SESSION["aprendiz"] ?? "Aprendiz";
$porcentaje = $_SESSION["porcentaje"] ?? 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Categoría Completada! - Millonarios SENA</title>
    <link rel="stylesheet" href="../css/categoria_completada.css">
</head>
<body>

<div class="contenedor-resultado">
    
    <div class="emoji">🎉</div>
    
    <div class="resultado-correcto" style="font-size: 2.5em; margin-bottom: 20px;">
        ¡CATEGORÍA COMPLETADA!
    </div>
    
    <div class="felicitaciones">
        <h2> ¡Felicitaciones, <?php echo htmlspecialchars($aprendiz); ?>! 🏆</h2>
        <p>Has completado todas las preguntas de la categoría:</p>

        <?php
        if ($porcentaje >= 90) {
            echo " ¡Excelente! Dominas completamente este tema.";
        } elseif ($porcentaje >= 70) {
            echo " ¡Muy bien! Tienes un buen conocimiento de este tema.";
        } elseif ($porcentaje >= 50) {
            echo " ¡Buen intento! Sigue practicando para mejorar.";
        } else {
            echo "📚 Sigue estudiando, cada intento te hace mejor.";
        }
        ?>
    </div>
    
    <div class="botones-container">
        <a href="../../frontend/views/reiniciar.php?cambiar_categoria=1" class="boton boton-nueva-categoria">
             Seleccionar Otra Categoría
        </a>
        
        <a href="reiniciar.php" class="boton boton-reintentar">
             Reintentar Esta Categoría
        </a>
        
        <a href="../../backend/controllers/logout.php" class="boton boton-salir">
             Cerrar Sesión
        </a>
    </div>

</div>

</body>
</html>
