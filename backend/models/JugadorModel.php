<?php
// backend/models/JugadorModel.php
require_once __DIR__ . '/pdoconexion.php';

class JugadorModel {
    private $mysql;
    
    public function __construct() {
        $this->mysql = new PDOConnection();
    }
    
    /**
     * Actualiza el puntaje del jugador SIEMPRE
     * Cambiado: Ya no valida si es mayor, simplemente actualiza
     */
    public function actualizarPuntaje($idJugador, $nuevoPuntaje) {
        try {
            $this->mysql->conectar();
            $conexion = $this->mysql->getConexion();
            
            
            $sql = "UPDATE tbl_jugadores 
                    SET puntaje_jugador = :puntaje 
                    WHERE ID_jugador = :id";
            
            $stmt = $conexion->prepare($sql);
            $resultado = $stmt->execute([
                ':id' => $idJugador,
                ':puntaje' => $nuevoPuntaje
            ]);
            
            $filasAfectadas = $stmt->rowCount();
            
            // Log en tabla de debug
            $this->guardarLog('ACTUALIZAR_PUNTAJE', 
                "ID: $idJugador | Puntaje: $nuevoPuntaje | Filas afectadas: $filasAfectadas",
                $idJugador, $nuevoPuntaje);
            
            $this->mysql->desconectar();
            
            return $filasAfectadas > 0;
            
        } catch (PDOException $e) {
            $this->mysql->desconectar();
            $this->guardarLog('ERROR_ACTUALIZAR', $e->getMessage(), $idJugador, $nuevoPuntaje);
            error_log("Error al actualizar puntaje del jugador: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Obtiene el puntaje actual del jugador
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

    public function eliminarJugador($idJugador)
    {
        try {
            $this->mysql->conectar();
            $conexion = $this->mysql->getConexion();

            $sql = "DELETE FROM tbl_jugadores WHERE ID_jugador = :id";
            $stmt = $conexion->prepare($sql);
            $resultado = $stmt->execute([':id' => $idJugador]);

            $this->mysql->desconectar();

            return $resultado;

        } catch (PDOException $e) {
            $this->mysql->desconectar();
            error_log("Error al eliminar jugador: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Guarda logs en la tabla de debug
     */
    private function guardarLog($tipo, $mensaje, $id_jugador = null, $puntaje = null) {
        try {
            $db = new PDOConnection();
            $conn = $db->conectar();
            
            $sql = "INSERT INTO tbl_logs_debug (tipo, mensaje, id_jugador, puntaje) 
                    VALUES (:tipo, :mensaje, :id_jugador, :puntaje)";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':tipo' => $tipo,
                ':mensaje' => $mensaje,
                ':id_jugador' => $id_jugador,
                ':puntaje' => $puntaje
            ]);
            $db->desconectar();
        } catch (Exception $e) {
            // Silenciar errores de log
        }
    }
}

?>