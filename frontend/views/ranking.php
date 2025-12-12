<?php
// Incluir el controlador que obtiene los datos del ranking
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
            <div class="message-box">
                <p><?php echo $mensaje; ?></p>
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
                    <tbody>
                        <?php
                        $posicion = 1;
                        foreach ($jugadores as $jugador):
                        ?>
                            <tr class="ranking-row">
                                <td><?php echo $posicion; ?></td>
                                <td><?php echo htmlspecialchars($jugador['ficha_jugador']); ?></td>
                                <td><?php echo htmlspecialchars($jugador['usuario_jugador']); ?></td>
                                <td class="score">
                                    <?php echo number_format($jugador['puntaje_jugador'], 0, ',', '.'); ?> pts
                                </td>
                                <td>
                                    <button class="btn-eliminar" data-id="<?php echo $jugador['ID_jugador']; ?>">Eliminar</button>
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

<script>
// CORREGIDO: fetch bien escrito y con ruta absoluta correcta
document.querySelectorAll('.btn-eliminar').forEach(btn => {
    btn.addEventListener('click', function () {

        let id = this.getAttribute('data-id');

        if (confirm("¿Seguro que deseas eliminar este jugador permanentemente?")) {

            fetch("../../backend/controllers/eliminar_ranking.php", {

                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "id=" + id
            })
            .then(res => res.text())
            .then(data => {
                console.log("RESPUESTA SERVIDOR:", data);

                if (data.trim() === "ok") {
                    this.closest('tr').remove();
                } else {
                    alert("Error eliminando el jugador: " + data);
                }
            })
            .catch(err => alert("Error en la conexión: " + err));
        }
    });
});
</script>

</body>
</html>
