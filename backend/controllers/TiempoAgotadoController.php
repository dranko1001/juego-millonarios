<?php
// backend/controllers/TiempoAgotadoController.php
session_start();

// Función para guardar logs
function guardarLog($tipo, $mensaje, $id_jugador = null, $puntaje = null) {
    try {
        require_once __DIR__ . '/../models/pdoconexion.php';
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
        error_log("Error al guardar log: " . $e->getMessage());
    }
}

// ✅ IMPORTANTE: Inicializar puntaje_pesos si no existe
if (!isset($_SESSION['puntaje_pesos'])) {
    $_SESSION['puntaje_pesos'] = 0;
}

if (!isset($_SESSION['preguntas_correctas'])) {
    $_SESSION['preguntas_correctas'] = 0;
}

guardarLog(
    'TIEMPO_AGOTADO_AUTO',
    'Redirección automática por tiempo agotado',
    $_SESSION['id_jugador'] ?? null,
    $_SESSION['puntaje_pesos']
);

// ✅ INTENTAR RECUPERAR LA RESPUESTA CORRECTA SI NO ESTÁ EN SESIÓN
if ((!isset($_SESSION['respuesta_correcta_letra']) || !isset($_SESSION['respuesta_correcta_texto'])) 
    && isset($_SESSION['pregunta_actual_id'])) {
    
    try {
        require_once __DIR__ . '/../models/PreguntaModel.php';
        $preguntaModel = new PreguntaModel();
        $pregunta = $preguntaModel->obtenerPreguntaPorId($_SESSION['pregunta_actual_id']);
        
        if ($pregunta) {
            // Usar las opciones guardadas en sesión si existen
            if (isset($_SESSION['opciones_mostradas']) && !empty($_SESSION['opciones_mostradas'])) {
                $respuestaCorrectaLetra = array_search($pregunta['correcta_pregunta'], $_SESSION['opciones_mostradas']);
            } else {
                $respuestaCorrectaLetra = 'A';
            }
            
            $_SESSION['respuesta_correcta_letra'] = $respuestaCorrectaLetra;
            $_SESSION['respuesta_correcta_texto'] = $pregunta['correcta_pregunta'];
            $_SESSION['enunciado_pregunta'] = $pregunta['enunciado_pregunta'];
            
            guardarLog(
                'RECUPERACION_EXITOSA',
                'Respuesta correcta recuperada de la BD',
                $_SESSION['id_jugador'] ?? null,
                null
            );
        }
    } catch (Exception $e) {
        guardarLog(
            'ERROR_RECUPERACION',
            'No se pudo recuperar la pregunta: ' . $e->getMessage(),
            $_SESSION['id_jugador'] ?? null,
            null
        );
    }
}

// ✅ Establecer valores por defecto si aún no existen
if (!isset($_SESSION['respuesta_elegida'])) {
    $_SESSION['respuesta_elegida'] = '';
}

if (!isset($_SESSION['enunciado_pregunta'])) {
    $_SESSION['enunciado_pregunta'] = 'Pregunta no disponible';
}

if (!isset($_SESSION['respuesta_correcta_letra'])) {
    $_SESSION['respuesta_correcta_letra'] = 'N/A';
}

if (!isset($_SESSION['respuesta_correcta_texto'])) {
    $_SESSION['respuesta_correcta_texto'] = 'No disponible';
}

if (!isset($_SESSION['opciones_mostradas'])) {
    $_SESSION['opciones_mostradas'] = [];
}

// Guardar puntaje actual
if (isset($_SESSION['id_jugador']) && isset($_SESSION['puntaje_pesos'])) {
    require_once __DIR__ . '/../models/JugadorModel.php';
    $jugadorModel = new JugadorModel();
    $jugadorModel->actualizarPuntaje(
        $_SESSION['id_jugador'], 
        $_SESSION['puntaje_pesos']
    );
    
    guardarLog(
        'PUNTAJE_GUARDADO',
        'Puntaje guardado: $' . number_format($_SESSION['puntaje_pesos']),
        $_SESSION['id_jugador'],
        $_SESSION['puntaje_pesos']
    );
}

// Marcar como tiempo agotado
$_SESSION['ultima_respuesta'] = 'tiempo_agotado';
$_SESSION['pregunta_activa'] = false;
$_SESSION['enunciado_actual'] = $_SESSION['enunciado_pregunta'];

guardarLog(
    'REDIRECCION',
    'Redirigiendo a resultado.php - Variables verificadas',
    $_SESSION['id_jugador'] ?? null,
    $_SESSION['puntaje_pesos']
);

header('Location: ../../frontend/views/resultado.php');
exit;
?>