<?php
// backend/models/ComodinModel.php
require_once __DIR__ . '/PreguntaModel.php';

class ComodinModel
{

    /**
     * Inicializa los comodines en la sesión si no existen
     */
    public static function inicializarComodines()
    {
        if (!isset($_SESSION['comodines'])) {
            $_SESSION['comodines'] = [
                'cincuenta_cincuenta' => true,  // Disponible
                'cambio_pregunta' => true,       // Disponible
                'ayuda_publico' => true,         // Disponible
                'llamada_amigo' => true          // Disponible
            ];
        }
    }

    /**
     * Verifica si un comodín está disponible
     */
    public static function estaDisponible($tipoComodin)
    {
        self::inicializarComodines();
        return $_SESSION['comodines'][$tipoComodin] ?? false;
    }

    /**
     * Marca un comodín como usado
     */
    public static function marcarComoUsado($tipoComodin)
    {
        self::inicializarComodines();
        if (isset($_SESSION['comodines'][$tipoComodin])) {
            $_SESSION['comodines'][$tipoComodin] = false;
            return true;
        }
        return false;
    }

    /**
     * Resetea todos los comodines (al cambiar de categoría)
     */
    public static function resetearComodines()
    {
        $_SESSION['comodines'] = [
            'cincuenta_cincuenta' => true,
            'cambio_pregunta' => true,
            'ayuda_publico' => true,
            'llamada_amigo' => true
        ];
    }

    /**
     * COMODÍN 50/50
     * Elimina 2 opciones incorrectas aleatoriamente
     * @return array - Letras de las opciones a eliminar ['A', 'C']
     */
    public static function aplicarCincuentaCincuenta()
    {
        if (!self::estaDisponible('cincuenta_cincuenta')) {
            return ['error' => 'Comodín ya usado'];
        }

        // Validar que exista la información de la pregunta actual
        if (!isset($_SESSION['respuesta_correcta_letra']) || !isset($_SESSION['opciones_mostradas'])) {
            return ['error' => 'No hay pregunta activa'];
        }

        $respuestaCorrectaLetra = $_SESSION['respuesta_correcta_letra'];
        $opciones = array_keys($_SESSION['opciones_mostradas']); // ['A', 'B', 'C', 'D']

        // Filtrar solo las incorrectas
        $incorrectas = array_filter($opciones, function ($letra) use ($respuestaCorrectaLetra) {
            return $letra !== $respuestaCorrectaLetra;
        });

        // Convertir a array indexado y mezclar
        $incorrectas = array_values($incorrectas);
        shuffle($incorrectas);

        // Tomar 2 incorrectas
        $opcionesAEliminar = array_slice($incorrectas, 0, 2);

        // Marcar como usado
        self::marcarComoUsado('cincuenta_cincuenta');

        // Guardar en sesión las opciones eliminadas
        $_SESSION['opciones_eliminadas_50_50'] = $opcionesAEliminar;

        return [
            'success' => true,
            'opciones_eliminar' => $opcionesAEliminar
        ];
    }

    /**
     * COMODÍN CAMBIO DE PREGUNTA
     * Obtiene una nueva pregunta de la misma dificultad y categoría
     * @return array - Nueva pregunta o error
     */
    public static function aplicarCambioPregunta()
    {
        if (!self::estaDisponible('cambio_pregunta')) {
            return ['error' => 'Comodín ya usado'];
        }

        // Validar información necesaria
        if (!isset($_SESSION['dificultad_pregunta']) || !isset($_SESSION['pregunta_actual_id'])) {
            return ['error' => 'No hay pregunta activa'];
        }

        $dificultadActual = $_SESSION['dificultad_pregunta'];
        $preguntaActualId = $_SESSION['pregunta_actual_id'];
        $categoriaSeleccionada = $_SESSION['categoria_seleccionada'] ?? null;
        $preguntasRespondidas = $_SESSION['preguntas_respondidas'] ?? [];

        // Asegurar que la pregunta actual también esté excluida
        if (!in_array($preguntaActualId, $preguntasRespondidas)) {
            $preguntasRespondidas[] = $preguntaActualId;
        }

        $preguntaModel = new PreguntaModel();
        $nuevaPregunta = null;

        // Buscar nueva pregunta según categoría
        if ($categoriaSeleccionada === "MIXTA") {
            $nuevaPregunta = $preguntaModel->obtenerPreguntaAleatoriaPorDificultad($dificultadActual, $preguntasRespondidas);
        } else {
            $nuevaPregunta = $preguntaModel->obtenerPreguntaPorCategoriaYDificultad($categoriaSeleccionada, $dificultadActual, $preguntasRespondidas);
        }

        if (!$nuevaPregunta) {
            return ['error' => 'No hay más preguntas disponibles con esa dificultad'];
        }

        // Preparar las opciones mezcladas
        $opciones = [
            $nuevaPregunta['opcion1_pregunta'],
            $nuevaPregunta['opcion2_pregunta'],
            $nuevaPregunta['opcion3_pregunta'],
            $nuevaPregunta['opcion4_pregunta']
        ];

        shuffle($opciones);

        $letras = ['A', 'B', 'C', 'D'];
        $opciones_mostradas = [];
        for ($i = 0; $i < 4; $i++) {
            $opciones_mostradas[$letras[$i]] = $opciones[$i];
        }

        $respuestaCorrectaLetra = array_search($nuevaPregunta['correcta_pregunta'], $opciones_mostradas);

        // Actualizar sesión con la nueva pregunta
        $_SESSION['pregunta_actual_id'] = $nuevaPregunta['ID_pregunta'];
        $_SESSION['respuesta_correcta_letra'] = $respuestaCorrectaLetra;
        $_SESSION['respuesta_correcta_texto'] = $nuevaPregunta['correcta_pregunta'];
        $_SESSION['enunciado_pregunta'] = $nuevaPregunta['enunciado_pregunta'];
        $_SESSION['opciones_mostradas'] = $opciones_mostradas;
        $_SESSION['dificultad_pregunta'] = $nuevaPregunta['TBL_dificultades_ID_dificultad'];

        // NO cambiar el tiempo - mantener el tiempo_inicio_pregunta original
        // El temporizador seguirá corriendo desde donde estaba

        // Agregar a preguntas respondidas
        $_SESSION['preguntas_respondidas'][] = $nuevaPregunta['ID_pregunta'];

        // Marcar comodín como usado
        self::marcarComoUsado('cambio_pregunta');

        return [
            'success' => true,
            'pregunta' => [
                'enunciado' => $nuevaPregunta['enunciado_pregunta'],
                'opciones' => $opciones_mostradas,
                'id_pregunta' => $nuevaPregunta['ID_pregunta']
            ]
        ];
    }

    /**
     * COMODÍN AYUDA DEL PÚBLICO
     * Solo marca el comodín como usado (el tiempo extra se maneja en frontend)
     * @return array - Confirmación
     */
    public static function aplicarAyudaPublico()
    {
        if (!self::estaDisponible('ayuda_publico')) {
            return ['error' => 'Comodín ya usado'];
        }

        // Marcar como usado
        self::marcarComoUsado('ayuda_publico');

        return [
            'success' => true,
            'mensaje' => 'Tienes 1 minuto extra para pensar'
        ];
    }

    /**
     * COMODÍN LLAMADA A UN AMIGO
     * Solo marca el comodín como usado (el tiempo extra se maneja en frontend)
     * @return array - Confirmación
     */
    public static function aplicarLlamadaAmigo()
    {
        if (!self::estaDisponible('llamada_amigo')) {
            return ['error' => 'Comodín ya usado'];
        }

        // Marcar como usado
        self::marcarComoUsado('llamada_amigo');

        return [
            'success' => true,
            'mensaje' => 'Llamando a un amigo... 30 segundos extra'
        ];
    }
}
?>