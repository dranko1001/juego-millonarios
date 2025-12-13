<?php
// backend/controllers/ranking.php

require_once __DIR__ . '/../models/pdoconexion.php';

//*inicio variables
$jugadores = [];
$mensaje = null;

try {
    //*crear instancia de conexion
    $db = new PDOConnection();
    $conexion = $db->getConexion();

    //*consulta SQL
    $sql = "SELECT 
                ID_jugador,
                ficha_jugador, 
                usuario_jugador, 
                puntaje_jugador 
            FROM tbl_jugadores 
            ORDER BY puntaje_jugador DESC 
            LIMIT 10";

    //*preparar para ejecutar
    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    //*obtener resultados
    $jugadores = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //*verificar resultados
    if (empty($jugadores)) {
        $mensaje = "No hay jugadores registrados aún. ¡Sé el primero en jugar!";
    }

    //*desconectar
    $db->desconectar();

} catch (PDOException $e) {
  
    $mensaje = "Error al obtener el ranking. Por favor intenta más tarde.";


    $mensaje .= "<br><small>Debug: " . $e->getMessage() . "</small>";

    $jugadores = [];
}
?>