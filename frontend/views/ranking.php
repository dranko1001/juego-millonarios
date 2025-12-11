<?php
// Incluir el controlador que procesa los datos
require_once __DIR__ . '/../../backend/controllers/ranking.php';
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking - Juego Millonarios</title>
    <link rel="stylesheet" href="../css/estiloPrueba.css">
</head>

<body>
    <div class="container">
        <h1 class="title">Top 10 Mejores Jugadores</h1>

        <?php if (isset($mensaje)): ?>
            <!-- Si hay un mensaje (error o no hay datos), mostrarlo -->
            <div class="message-box">
                <p><?php echo $mensaje; ?></p>
            </div>
        <?php else: ?>
            <!-- Si hay jugadores, mostrar la tabla -->
            <div class="ranking-container">
                <table class="ranking-table">
                    <thead>
                        <tr>
                            <th>Posición</th>
                            <th>Ficha</th>
                            <th>Usuario</th>
                            <th>Puntuación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Recorrer el array de jugadores
                        $posicion = 1; // Contador para la posición
                    
                        foreach ($jugadores as $jugador):
                            ?>
                            <tr class="ranking-row">
                                <td class="position">
                                    <?php
                                    // Mostrar medallas para los primeros 3
                                    if ($posicion == 1) {
                                        echo $posicion;
                                    } elseif ($posicion == 2) {
                                        echo $posicion;
                                    } elseif ($posicion == 3) {
                                        echo $posicion;
                                    } else {
                                        echo $posicion;
                                    }
                                    ?>
                                </td>
                                <td><?php echo htmlspecialchars($jugador['ficha_jugador']); ?></td>
                                <td><?php echo htmlspecialchars($jugador['usuario_jugador']); ?></td>
                                <td class="score">
                                    <?php echo number_format($jugador['puntaje_jugador'], 0, ',', '.'); ?> pts
                                </td>
                                <td>
                                <button class="swal2-confirm swal2-styled" type="button"
style="display: inline-block; --swal2-confirm-button-background-color: #dc3545; --swal2-confirm-button-hover-background-color: #c82333; --swal2-confirm-button-focus-box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.5);">Eliminar</button>
                                </td>
                            </tr>
                            <?php
                            $posicion++; 
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <div class="buttons-container">
            <a href="menu.php" class="btn btn-secondary">Volver al Menú</a>
        </div>
    </div>
</body>

</html>