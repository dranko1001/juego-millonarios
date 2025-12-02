<?php
// Asegúrate de que la ruta a MySQL.php sea correcta
require_once __DIR__ . '/MySQL.php'; 

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
        
        // La consulta SQL selecciona una pregunta al azar (LIMIT 1)
        // Usamos ORDER BY RAND() que es simple pero puede no ser eficiente si se extienden muchas preguntas 
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

        $resultado = $this->mysql->efectuarConsulta($sql);
        $pregunta = null;

        if ($resultado && $resultado->num_rows > 0) {
            $pregunta = $resultado->fetch_assoc();
            
            // esto desordena las preguntas para que las respuestas no estén siempre en el mismo orden
            $opciones = [
                'A' => $pregunta['opcion1_pregunta'],
                'B' => $pregunta['opcion2_pregunta'],
                'C' => $pregunta['opcion3_pregunta'],
                'D' => $pregunta['opcion4_pregunta']
            ];
            
            // Guardamos las opciones desordenadas y la letra correcta (opcion1_pregunta, etc.)
            // En el controlador mezclaremos las opciones y asignaremos una letra aleatoria.
            $pregunta['opciones'] = $opciones;
            
        }

        $this->mysql->desconectar();
        return $pregunta;
    }

    // Aquí irían otros métodos como validarRespuesta($id, $respuesta)
}
?>