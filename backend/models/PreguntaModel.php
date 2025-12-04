<?php
require_once __DIR__ . '/MySQL_PDO.php'; 

class PreguntaModel {
    private $mysql;

    public function __construct() {
        $this->mysql = new MySQL();
    }

    /**
     * Obtiene una pregunta aleatoria de la base de datos.
     * @return array|null Un array asociativo con los datos de la pregunta o null si no hay preguntas.
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
                // Preparar las opciones
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
     * Valida si la respuesta es correcta
     * @param int $idPregunta ID de la pregunta
     * @param string $respuestaUsuario La letra que eligió el usuario
     * @return array Array con 'es_correcta' (bool) y 'respuesta_correcta' (string)
     */
    public function validarRespuesta($idPregunta, $respuestaUsuario) {
        $this->mysql->conectar();
        $conexion = $this->mysql->getConexion();
        
        $sql = "
            SELECT 
                correcta_pregunta,
                opcion1_pregunta,
                opcion2_pregunta,
                opcion3_pregunta,
                opcion4_pregunta
            FROM tbl_preguntas
            WHERE ID_pregunta = :id_pregunta
            LIMIT 1
        ";

        try {
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id_pregunta', $idPregunta, PDO::PARAM_INT);
            $stmt->execute();
            
            $pregunta = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$pregunta) {
                $this->mysql->desconectar();
                return [
                    'es_correcta' => false,
                    'respuesta_correcta' => null,
                    'error' => 'Pregunta no encontrada'
                ];
            }
            
            // Crear el mismo array de opciones que en obtenerPreguntaAleatoria
            $opciones = [
                'A' => $pregunta['opcion1_pregunta'],
                'B' => $pregunta['opcion2_pregunta'],
                'C' => $pregunta['opcion3_pregunta'],
                'D' => $pregunta['opcion4_pregunta']
            ];
            
            // Buscar qué letra corresponde a la respuesta correcta
            $letraCorrecta = array_search($pregunta['correcta_pregunta'], $opciones);
            
            $this->mysql->desconectar();
            
            return [
                'es_correcta' => ($respuestaUsuario === $letraCorrecta),
                'respuesta_correcta' => $letraCorrecta,
                'texto_correcto' => $pregunta['correcta_pregunta']
            ];
            
        } catch (PDOException $e) {
            $this->mysql->desconectar();
            error_log("Error al validar respuesta: " . $e->getMessage());
            return [
                'es_correcta' => false,
                'respuesta_correcta' => null,
                'error' => 'Error en la validación'
            ];
        }
    }
    
    /**
     * Obtiene el total de preguntas disponibles
     * @return int Total de preguntas
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