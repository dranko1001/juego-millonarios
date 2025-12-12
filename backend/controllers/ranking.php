<?php
// backend/controllers/ranking.php

// OPCIÓN 1: Si renombraste el archivo a minúsculas
require_once __DIR__ . '/../models/pdoconexion.php';


// OPCIÓN 2: Si dejaste el archivo con mayúscula
// require_once '../models/PDOConnection.php';

// Inicializar variables
$jugadores = [];
$mensaje = null;

try {
    // Crear instancia de la conexión
    $db = new PDOConnection();
    $conexion = $db->getConexion();

    // Preparar la consulta SQL
    $sql = "SELECT ID_jugador,
                ficha_jugador, 
                usuario_jugador, 
                puntaje_jugador 
            FROM tbl_jugadores 
            ORDER BY puntaje_jugador DESC 
            LIMIT 10";

    // Preparar y ejecutar
    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    // Obtener los resultados
    $jugadores = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verificar si hay resultados
    if (empty($jugadores)) {
        $mensaje = "No hay jugadores registrados aún. ¡Sé el primero en jugar!";
    }

    // Desconectar
    $db->desconectar();

} catch (PDOException $e) {
    // Si hay error, capturarlo
    $mensaje = "Error al obtener el ranking. Por favor intenta más tarde.";

    // Solo para desarrollo (mostrar el error real):
    $mensaje .= "<br><small>Debug: " . $e->getMessage() . "</small>";

    $jugadores = [];
}

?>