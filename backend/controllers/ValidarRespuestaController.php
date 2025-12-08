<?php
// backend/controllers/ValidarRespuestaController.php
session_start();

// Función para guardar logs en la base de datos
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

// Verificar que lleguen los datos por POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['respuesta_elegida']) || !isset($_POST['id_pregunta'])) {
    guardarLog('ERROR', 'No llegaron datos POST correctamente', null, null);
    header('Location: PreguntasController.php');
    exit;
}

$respuestaElegida = $_POST['respuesta_elegida'];
$idPregunta = (int)$_POST['id_pregunta'];

guardarLog('INICIO', 'Validando respuesta - Pregunta: ' . $idPregunta, $_SESSION['id_jugador'] ?? null, null);

$respuestaCorrectaLetra = $_SESSION['respuesta_correcta_letra'] ?? null;
$respuestaCorrectaTexto = $_SESSION['respuesta_correcta_texto'] ?? null;

if (!$respuestaCorrectaLetra || !$respuestaCorrectaTexto) {
    guardarLog('ERROR', 'No hay respuesta correcta en sesión', $_SESSION['id_jugador'] ?? null, null);
    $_SESSION['error'] = 'Error: Datos de pregunta no encontrados en sesión';
    header('Location: PreguntasController.php');
    exit;
}

$esCorrecta = ($respuestaElegida === $respuestaCorrectaLetra);

if (!isset($_SESSION['puntaje_pesos'])) {
    $_SESSION['puntaje_pesos'] = 0;
}

if (!isset($_SESSION['preguntas_correctas'])) {
    $_SESSION['preguntas_correctas'] = 0;
}

if ($esCorrecta) {
    $_SESSION['preguntas_correctas']++;
    $_SESSION['ultima_respuesta'] = 'correcta';
    
    $dificultadId = $_SESSION['dificultad_pregunta'] ?? 1;
    $puntajes = [1 => 100000, 2 => 150000, 3 => 175000];
    $puntajeGanado = $puntajes[$dificultadId] ?? 100000;
    
    $_SESSION['puntaje_pesos'] += $puntajeGanado;
    $_SESSION['ultimo_puntaje_ganado'] = $puntajeGanado;
    
    guardarLog(
        'CORRECTA', 
        'Respuesta correcta | Dificultad: ' . $dificultadId . ' | Ganado: $' . number_format($puntajeGanado) . ' | Total: $' . number_format($_SESSION['puntaje_pesos']),
        $_SESSION['id_jugador'] ?? null,
        $_SESSION['puntaje_pesos']
    );
    
    // ✅ NUEVO: Guardar también después de respuesta correcta
    if (isset($_SESSION['id_jugador'])) {
        require_once __DIR__ . '/../models/JugadorModel.php';
        $jugadorModel = new JugadorModel();
        $resultado = $jugadorModel->actualizarPuntaje(
            $_SESSION['id_jugador'], 
            $_SESSION['puntaje_pesos']
        );
        
        guardarLog(
            'GUARDAR_CORRECTA',
            'Guardado después de correcta - Resultado: ' . ($resultado ? 'ÉXITO' : 'FALLÓ'),
            $_SESSION['id_jugador'],
            $_SESSION['puntaje_pesos']
        );
    }
    
} else {
    $_SESSION['ultima_respuesta'] = 'incorrecta';
    $_SESSION['ultimo_puntaje_ganado'] = 0;
    
    guardarLog(
        'INCORRECTA', 
        'Respuesta incorrecta | Puntaje final: $' . number_format($_SESSION['puntaje_pesos']),
        $_SESSION['id_jugador'] ?? null,
        $_SESSION['puntaje_pesos']
    );
    
    // Guardar puntaje cuando pierde
    if (isset($_SESSION['id_jugador']) && isset($_SESSION['puntaje_pesos'])) {
        require_once __DIR__ . '/../models/JugadorModel.php';
        $jugadorModel = new JugadorModel();
        
        // Obtener puntaje actual de la BD ANTES de guardar
        $puntajeActualBD = $jugadorModel->obtenerPuntaje($_SESSION['id_jugador']);
        
        guardarLog(
            'ANTES_GUARDAR', 
            'BD actual: $' . number_format($puntajeActualBD) . ' | A guardar: $' . number_format($_SESSION['puntaje_pesos']),
            $_SESSION['id_jugador'],
            $puntajeActualBD
        );
        
        $resultado = $jugadorModel->actualizarPuntaje(
            $_SESSION['id_jugador'], 
            $_SESSION['puntaje_pesos']
        );
        
        // Verificar puntaje DESPUÉS de guardar
        $puntajeDespuesBD = $jugadorModel->obtenerPuntaje($_SESSION['id_jugador']);
        
        guardarLog(
            'DESPUES_GUARDAR', 
            'Resultado: ' . ($resultado ? 'ÉXITO ✓' : 'FALLÓ ✗') . ' | BD ahora: $' . number_format($puntajeDespuesBD),
            $_SESSION['id_jugador'],
            $puntajeDespuesBD
        );
        
    } else {
        $error = 'Faltan datos: ';
        $error .= !isset($_SESSION['id_jugador']) ? 'id_jugador ' : '';
        $error .= !isset($_SESSION['puntaje_pesos']) ? 'puntaje_pesos ' : '';
        
        guardarLog('ERROR_SESION', $error, null, null);
    }
}

$_SESSION['respuesta_elegida'] = $respuestaElegida;
$_SESSION['enunciado_actual'] = $_SESSION['enunciado_pregunta'] ?? '';

guardarLog('FIN', 'Redirigiendo a resultado.php', $_SESSION['id_jugador'] ?? null, $_SESSION['puntaje_pesos'] ?? 0);

header('Location: ../../frontend/views/resultado.php');
exit;
?>