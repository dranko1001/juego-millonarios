<?php
require_once __DIR__ . '/../../backend/controllers/ranking.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking - Juego Millonarios</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="../css/estiloPrueba.css">
    <link rel="stylesheet" href="../css/ranking.css">

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <h1 class="title">🏆 Top 10 Mejores Jugadores</h1>

        <?php if (isset($mensaje)): ?>
            <div class="message-box">
                <p><?php echo htmlspecialchars($mensaje); ?></p>
            </div>
        <?php else: ?>
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
                    <tbody id="tabla-ranking">
                        <?php
                        $posicion = 1;
                        foreach ($jugadores as $jugador):
                            $emoji = '';
                            if ($posicion == 1);
                            elseif ($posicion == 2);
                            elseif ($posicion == 3);

                            // Validar que existan los datos necesarios
                            $idJugador = isset($jugador['ID_jugador']) ? (int) $jugador['ID_jugador'] : 0;
                            $fichaJugador = isset($jugador['ficha_jugador']) ? htmlspecialchars($jugador['ficha_jugador']) : 'N/A';
                            $usuarioJugador = isset($jugador['usuario_jugador']) ? htmlspecialchars($jugador['usuario_jugador']) : 'N/A';
                            $puntajeJugador = isset($jugador['puntaje_jugador']) ? (int) $jugador['puntaje_jugador'] : 0;
                            ?>
                            <tr class="ranking-row" id="fila-<?php echo $idJugador; ?>">
                                <td class="position">
                                    <?php echo $emoji . ' ' . $posicion; ?>
                                </td>
                                <td><?php echo $fichaJugador; ?></td>
                                <td><?php echo $usuarioJugador; ?></td>
                                <td class="score">
                                    $ <?php echo number_format($puntajeJugador, 0, ',', '.'); ?> pts
                                </td>
                                <td>
                                    <button class="btn-eliminar" data-id="<?php echo $idJugador; ?>"
                                        data-nombre="<?php echo $usuarioJugador; ?>" type="button">
                                         Eliminar
                                    </button>
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
            <a href="menu.php" class="btn btn-secondary">  Volver al Menú</a>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="../js/eliminarJugador.js"></script>
</body>
</html>
