<?php
// backend/models/JugadorModel.php
require_once __DIR__ . '/pdoconexion.php';

class JugadorModel
{
    private $mysql;

    public function __construct()
    {
        $this->mysql = new PDOConnection();
    }

    /**
     * Actualiza el puntaje del jugador
     */
    public function actualizarPuntaje($idJugador, $nuevoPuntaje)
    {
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

            $this->guardarLog(
                'ACTUALIZAR_PUNTAJE',
                "ID: $idJugador | Puntaje: $nuevoPuntaje | Filas afectadas: $filasAfectadas",
                $idJugador,
                $nuevoPuntaje
            );

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
    public function obtenerPuntaje($idJugador)
    {
        try {
            $this->mysql->conectar();
            $conexion = $this->mysql->getConexion();

            $sql = "SELECT puntaje_jugador FROM tbl_jugadores WHERE ID_jugador = :id";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([':id' => $idJugador]);

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->mysql->desconectar();

            return $resultado ? (int) $resultado['puntaje_jugador'] : 0;

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
    private function guardarLog($tipo, $mensaje, $id_jugador = null, $puntaje = null)
    {
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

    /**
     * Crea un nuevo jugador en la base de datos
     */
    public function crearJugador($ficha, $usuario)
    {
        try {
            $this->mysql->conectar();
            $conexion = $this->mysql->getConexion();

            $sql = "INSERT INTO tbl_jugadores (ficha_jugador, usuario_jugador, puntaje_jugador) 
                    VALUES (:ficha, :usuario, 0)";

            $stmt = $conexion->prepare($sql);
            $stmt->execute([
                ':ficha' => $ficha,
                ':usuario' => $usuario
            ]);

            $idJugador = $conexion->lastInsertId();
            $this->mysql->desconectar();

            return $idJugador;

        } catch (PDOException $e) {
            $this->mysql->desconectar();
            error_log("Error al crear jugador: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Obtiene los datos de un jugador por ID
     */
    public function obtenerJugadorPorId($idJugador)
    {
        try {
            $this->mysql->conectar();
            $conexion = $this->mysql->getConexion();

            $sql = "SELECT * FROM tbl_jugadores WHERE ID_jugador = :id";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([':id' => $idJugador]);

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->mysql->desconectar();

            return $resultado;

        } catch (PDOException $e) {
            $this->mysql->desconectar();
            error_log("Error al obtener jugador: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Obtiene todos los jugadores ordenados por puntaje
     */
    public function obtenerTodosLosJugadores($orden = 'DESC')
    {
        try {
            $this->mysql->conectar();
            $conexion = $this->mysql->getConexion();

            $sql = "SELECT * FROM tbl_jugadores 
                    ORDER BY puntaje_jugador $orden";

            $stmt = $conexion->prepare($sql);
            $stmt->execute();

            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->mysql->desconectar();

            return $resultado;

        } catch (PDOException $e) {
            $this->mysql->desconectar();
            error_log("Error al obtener jugadores: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Obtiene el ranking de los mejores jugadores
     */
    public function obtenerRanking($limite = 10)
    {
        try {
            $this->mysql->conectar();
            $conexion = $this->mysql->getConexion();

            $sql = "SELECT * FROM tbl_jugadores 
                    WHERE puntaje_jugador > 0
                    ORDER BY puntaje_jugador DESC 
                    LIMIT :limite";

            $stmt = $conexion->prepare($sql);
            $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
            $stmt->execute();

            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->mysql->desconectar();

            return $resultado;

        } catch (PDOException $e) {
            $this->mysql->desconectar();
            error_log("Error al obtener ranking: " . $e->getMessage());
            return [];
        }
    }

    /**
     * limpiar jugadores y logs de la base de datos
     */
    public function limpiarTodosLosJugadores()
    {
        try {
            $this->mysql->conectar();
            $conexion = $this->mysql->getConexion();

            //*eliminar relaciones
            $conexion->exec("DELETE FROM tbl_jugadores_has_tbl_codigoacesso");

            //*eliminar jugadores y reiniciar auto_increment
            $conexion->exec("DELETE FROM tbl_jugadores");

            //*reiniciar el auto_increment de jugadores
            $conexion->exec("ALTER TABLE tbl_jugadores AUTO_INCREMENT = 1");

            //*eliminar logs
            $conexion->exec("DELETE FROM tbl_logs_debug");

            //*reiniciar el auto_increment de logs
            $conexion->exec("ALTER TABLE tbl_logs_debug AUTO_INCREMENT = 1");

            $this->mysql->desconectar();

            return ['success' => true];

        } catch (PDOException $e) {
            $this->mysql->desconectar();
            error_log("Error al limpiar jugadores: " . $e->getMessage());

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
?>