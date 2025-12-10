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
     * @param array $preguntasExcluidas - IDs de preguntas a excluir
     */
    public function obtenerPreguntaAleatoria($preguntasExcluidas = []) {
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
        ";
        
        // Excluir preguntas ya respondidas
        if (!empty($preguntasExcluidas)) {
            $placeholders = str_repeat('?,', count($preguntasExcluidas) - 1) . '?';
            $sql .= " WHERE ID_pregunta NOT IN ($placeholders)";
        }
        
        $sql .= " ORDER BY RAND() LIMIT 1";

        try {
            $stmt = $conexion->prepare($sql);
            
            if (!empty($preguntasExcluidas)) {
                $stmt->execute($preguntasExcluidas);
            } else {
                $stmt->execute();
            }
            
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
     * Obtiene una pregunta aleatoria filtrada por categoría
     * @param int $id_categoria - ID de la categoría
     * @param array $preguntasExcluidas - IDs de preguntas a excluir
     */
    public function obtenerPreguntaPorCategoria($id_categoria, $preguntasExcluidas = []) {
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
            WHERE TBL_categorias_ID_categoria = ?
        ";
        
        // Excluir preguntas ya respondidas
        if (!empty($preguntasExcluidas)) {
            $placeholders = str_repeat('?,', count($preguntasExcluidas) - 1) . '?';
            $sql .= " AND ID_pregunta NOT IN ($placeholders)";
        }
        
        $sql .= " ORDER BY RAND() LIMIT 1";

        try {
            $stmt = $conexion->prepare($sql);
            
            // Preparar parámetros: primero el ID de categoría, luego los excluidos
            $params = [$id_categoria];
            if (!empty($preguntasExcluidas)) {
                $params = array_merge($params, $preguntasExcluidas);
            }
            
            $stmt->execute($params);
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
     * Cuenta las preguntas disponibles por categoría
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

    /**
     * ✅ NUEVO: Obtiene una pregunta específica por su ID
     * Este método se usa cuando se agota el tiempo para recuperar la respuesta correcta
     * @param int $idPregunta - ID de la pregunta a obtener
     * @return array|null - Datos de la pregunta o null si no existe
     */
    public function obtenerPreguntaPorId($idPregunta) {
        try {
            $this->mysql->conectar();
            $conexion = $this->mysql->getConexion();
            
            $sql = "SELECT 
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
                    WHERE ID_pregunta = :id";
            
            $stmt = $conexion->prepare($sql);
            $stmt->execute([':id' => $idPregunta]);
            
            $pregunta = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->mysql->desconectar();
            
            return $pregunta;
            
        } catch (PDOException $e) {
            $this->mysql->desconectar();
            error_log("Error al obtener pregunta por ID: " . $e->getMessage());
            return null;
        }
    }
}
?>