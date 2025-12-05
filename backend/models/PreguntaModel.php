<?php
// backend/models/PreguntaModel.php
require_once __DIR__ . '/pdoconexion.php'; 

class PreguntaModel {
    private $mysql;

    public function __construct() {
        $this->mysql = new PDOConnection();
    }

    /**
     * Obtiene una pregunta aleatoria
     */
    public function obtenerPreguntaAleatoria() {
        $this->mysql->conectar();
        $conexion = $this->mysql->getConexion();
        
        $sql = "
            SELECT 
                ID_pregunta,
                enunciado_pregunta,
                opcion1_pregunta,
                opcion2_pregunta,
                opcion3_pregunta,
                opcion4_pregunta,
                correcta_pregunta
            FROM tbl_preguntas
            ORDER BY RAND()
            LIMIT 1
        ";

        try {
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            
            $pregunta = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($pregunta) {
                $opciones = [
                    'A' => $pregunta['opcion1_pregunta'],
                    'B' => $pregunta['opcion2_pregunta'],
                    'C' => $pregunta['opcion3_pregunta'],
                    'D' => $pregunta['opcion4_pregunta']
                ];

                $pregunta['opciones'] = $opciones;
            }
            
            $this->mysql->desconectar();
            return $pregunta;
            
        } catch (PDOException $e) {
            $this->mysql->desconectar();
            error_log("Error al obtener pregunta: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Cuenta las preguntas totales
     */
    public function contarPreguntas() {
        $this->mysql->conectar();
        $conexion = $this->mysql->getConexion();
        
        $sql = "SELECT COUNT(*) as total FROM tbl_preguntas";
        
        try {
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->mysql->desconectar();
            return $resultado['total'];
            
        } catch (PDOException $e) {
            $this->mysql->desconectar();
            error_log("Error al contar preguntas: " . $e->getMessage());
            return 0;
        }
    }
    
    // Ya no necesitas validarRespuesta() aquí porque lo haces en el controlador con sesiones
}
?>