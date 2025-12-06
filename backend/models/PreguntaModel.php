<?php
// backend/models/PreguntaModel.php
require_once __DIR__ . '/pdoconexion.php'; 

class PreguntaModel {
    private $mysql;

    public function __construct() {
        $this->mysql = new PDOConnection();
    }

    /**
     * Obtiene una pregunta aleatoria (sin filtro de categoría)
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
                correcta_pregunta,
                TBL_categorias_ID_categoria,
                TBL_dificultades_ID_dificultad
            FROM tbl_preguntas
            ORDER BY RAND()
            LIMIT 1
        ";

        try {
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            
            $pregunta = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->mysql->desconectar();
            return $pregunta;
            
        } catch (PDOException $e) {
            $this->mysql->desconectar();
            error_log("Error al obtener pregunta: " . $e->getMessage());
            return null;
        }
    }

    /**
     * NUEVO: Obtiene una pregunta aleatoria filtrada por categoría
     */
    public function obtenerPreguntaPorCategoria($id_categoria) {
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
                correcta_pregunta,
                TBL_categorias_ID_categoria,
                TBL_dificultades_ID_dificultad
            FROM tbl_preguntas
            WHERE TBL_categorias_ID_categoria = :id_categoria
            ORDER BY RAND()
            LIMIT 1
        ";

        try {
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
            $stmt->execute();
            
            $pregunta = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->mysql->desconectar();
            return $pregunta;
            
        } catch (PDOException $e) {
            $this->mysql->desconectar();
            error_log("Error al obtener pregunta por categoría: " . $e->getMessage());
            return null;
        }
    }

    /**
     * NUEVO: Cuenta las preguntas disponibles por categoría
     */
    public function contarPreguntasPorCategoria($id_categoria) {
        $this->mysql->conectar();
        $conexion = $this->mysql->getConexion();
        
        $sql = "SELECT COUNT(*) as total 
                FROM tbl_preguntas 
                WHERE TBL_categorias_ID_categoria = :id_categoria";
        
        try {
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
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
}
?>