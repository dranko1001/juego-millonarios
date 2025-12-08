<?php
// backend/models/JugadorModel.php
require_once __DIR__ . '/pdoconexion.php';

class JugadorModel {
    private $mysql;
    
    public function __construct() {
        $this->mysql = new PDOConnection();
    }
    
    /**
     * Actualiza el puntaje del jugador solo si el nuevo puntaje es mayor que el actual
     * Esto permite guardar el mejor puntaje histórico del jugador
     * 
     * @param int $idJugador - ID del jugador en tbl_jugadores
     * @param int $nuevoPuntaje - Nuevo puntaje a guardar
     * @return bool - true si se actualizó, false si no
     */
    public function actualizarPuntaje($idJugador, $nuevoPuntaje) {
        try {
            $this->mysql->conectar();
            $conexion = $this->mysql->getConexion();
            
            // Solo actualizar si el nuevo puntaje es mayor que el actual
            $sql = "UPDATE tbl_jugadores 
                    SET puntaje_jugador = :puntaje 
                    WHERE ID_jugador = :id 
                    AND puntaje_jugador < :puntaje";
            
            $stmt = $conexion->prepare($sql);
            $stmt->execute([
                ':id' => $idJugador,
                ':puntaje' => $nuevoPuntaje
            ]);
            
            $filasAfectadas = $stmt->rowCount();
            $this->mysql->desconectar();
            
            return $filasAfectadas > 0;
            
        } catch (PDOException $e) {
            $this->mysql->desconectar();
            error_log("Error al actualizar puntaje del jugador: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Obtiene el puntaje actual del jugador
     * 
     * @param int $idJugador - ID del jugador
     * @return int - Puntaje actual del jugador
     */
    public function obtenerPuntaje($idJugador) {
        try {
            $this->mysql->conectar();
            $conexion = $this->mysql->getConexion();
            
            $sql = "SELECT puntaje_jugador FROM tbl_jugadores WHERE ID_jugador = :id";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([':id' => $idJugador]);
            
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->mysql->desconectar();
            
            return $resultado ? (int)$resultado['puntaje_jugador'] : 0;
            
        } catch (PDOException $e) {
            $this->mysql->desconectar();
            error_log("Error al obtener puntaje del jugador: " . $e->getMessage());
            return 0;
        }
    }
}
?>
