<?php
// backend/models/CodigoAccesoModel.php
require_once __DIR__ . '/pdoconexion.php';

class CodigoAccesoModel {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new PDOConnection();
    }

    /**
     * Generar un código de acceso aleatorio
     */
    public function generarCodigo() {
        // Generar código de 6 dígitos
        return sprintf("%06d", mt_rand(100000, 999999));
    }

    /**
     * Crear un nuevo código de acceso
     */
    public function crearCodigo() {
        $this->conn = $this->db->conectar();
        
        $codigo = $this->generarCodigo();
        $fecha = date('Y-m-d');
        $validar = 1; // Código válido
        
        $sql = "INSERT INTO tbl_codigoacesso 
                (codigo_codigoAcesso, validar_codigoAcesso, fecha_codigoAcesso) 
                VALUES (:codigo, :validar, :fecha)";
        
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':codigo', $codigo);
            $stmt->bindParam(':validar', $validar);
            $stmt->bindParam(':fecha', $fecha);
            
            if ($stmt->execute()) {
                return $codigo;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Error al crear código: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Validar si un código existe y es válido
     */
    public function validarCodigo($codigo) {
        $this->conn = $this->db->conectar();
        
        $sql = "SELECT * FROM tbl_codigoacesso 
                WHERE codigo_codigoAcesso = :codigo 
                AND validar_codigoAcesso = 1";
        
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':codigo', $codigo);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al validar código: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Invalidar un código (después de usarlo)
     */
    public function invalidarCodigo($codigo) {
        $this->conn = $this->db->conectar();
        
        $sql = "UPDATE tbl_codigoacesso 
                SET validar_codigoAcesso = 0 
                WHERE codigo_codigoAcesso = :codigo";
        
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':codigo', $codigo);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al invalidar código: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Obtener todos los códigos activos
     */
    public function obtenerCodigosActivos() {
        $this->conn = $this->db->conectar();
        
        $sql = "SELECT * FROM tbl_codigoacesso 
                WHERE validar_codigoAcesso = 1 
                ORDER BY fecha_codigoAcesso DESC";
        
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener códigos: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Eliminar código
     */
    public function eliminarCodigo($id) {
        $this->conn = $this->db->conectar();
        
        $sql = "DELETE FROM tbl_codigoacesso WHERE ID_codigoAcesso = :id";
        
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al eliminar código: " . $e->getMessage());
            return false;
        }
    }
}
?>