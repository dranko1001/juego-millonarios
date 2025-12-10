<?php
// backend/ver_logs.php
require_once __DIR__ . '../../models/pdoconexion.php';

$db = new PDOConnection();
$conn = $db->conectar();

echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Logs de Debug</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        h1 { color: #333; }
        table { border-collapse: collapse; width: 100%; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #4CAF50; color: white; position: sticky; top: 0; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        tr:hover { background-color: #f5f5f5; }
        .tipo { font-weight: bold; padding: 4px 8px; border-radius: 4px; display: inline-block; }
        .CORRECTA { background: #d4edda; color: #155724; }
        .INCORRECTA { background: #f8d7da; color: #721c24; }
        .ERROR { background: #f8d7da; color: #721c24; }
        .ANTES_GUARDAR { background: #fff3cd; color: #856404; }
        .DESPUES_GUARDAR { background: #d1ecf1; color: #0c5460; }
        .GUARDAR_CORRECTA { background: #d1ecf1; color: #0c5460; }
        .botones { margin: 20px 0; }
        .btn { padding: 10px 20px; margin-right: 10px; background: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn:hover { background: #45a049; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
    </style>
</head>
<body>";

echo "<h1>🔍 Logs de Debug del Sistema</h1>";

echo "<div class='botones'>
    <a href='ver_logs.php' class='btn'>🔄 Refrescar</a>
    <a href='limpiar_logs.php' class='btn btn-danger' onclick='return confirm(\"¿Seguro que quieres limpiar todos los logs?\")'>🗑️ Limpiar Logs</a>
</div>";

// Ver logs
$sql = "SELECT * FROM tbl_logs_debug ORDER BY fecha DESC LIMIT 100";
$stmt = $conn->query($sql);

echo "<h2>📋 Últimos 100 Logs</h2>";
echo "<table>
    <tr>
        <th>ID</th>
        <th>Fecha/Hora</th>
        <th>Tipo</th>
        <th>Mensaje</th>
        <th>ID Jugador</th>
        <th>Puntaje</th>
    </tr>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['fecha']}</td>
        <td><span class='tipo {$row['tipo']}'>{$row['tipo']}</span></td>
        <td>{$row['mensaje']}</td>
        <td>" . ($row['id_jugador'] ?? '-') . "</td>
        <td>" . ($row['puntaje'] ? '$' . number_format($row['puntaje']) : '-') . "</td>
    </tr>";
}
echo "</table>";

// Ver jugadores
$sql2 = "SELECT * FROM tbl_jugadores ORDER BY ID_jugador DESC LIMIT 20";
$stmt2 = $conn->query($sql2);

echo "<h2>👥 Últimos 20 Jugadores en la BD</h2>";
echo "<table>
    <tr>
        <th>ID</th>
        <th>Ficha</th>
        <th>Usuario</th>
        <th>Puntaje</th>
    </tr>";

while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    $color = $row['puntaje_jugador'] > 0 ? 'color: #28a745; font-weight: bold;' : 'color: #dc3545;';
    echo "<tr>
        <td>{$row['ID_jugador']}</td>
        <td>{$row['ficha_jugador']}</td>
        <td>{$row['usuario_jugador']}</td>
        <td style='$color'>\$" . number_format($row['puntaje_jugador']) . "</td>
    </tr>";
}
echo "</table>";

echo "</body></html>";

$db->desconectar();
?>