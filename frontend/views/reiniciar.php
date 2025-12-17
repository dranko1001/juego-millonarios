<?php
// frontend/views/reiniciar.php

// Habilitar reporte de errores para debug (remover en producción)
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Guardar puntaje antes de reiniciar
if (isset($_SESSION['id_jugador']) && isset($_SESSION['puntaje_pesos'])) {
    try {
        require_once __DIR__ . '/../../backend/models/pdoconexion.php';
        require_once __DIR__ . '/../../backend/models/JugadorModel.php';
        
        $jugadorModel = new JugadorModel();
        $jugadorModel->actualizarPuntaje(
            $_SESSION['id_jugador'], 
            $_SESSION['puntaje_pesos']
        );
    } catch (Exception $e) {
        // Log del error (opcional)
        error_log("Error al actualizar puntaje: " . $e->getMessage());
    }
}

// Cargar ComodinModel
require_once __DIR__ . '/../../backend/models/comodinModel.php';

// Verificar si quiere cambiar de categoría ANTES de resetear
$cambiarCategoria = isset($_GET['cambiar_categoria']) && $_GET['cambiar_categoria'] == '1';

// Limpiar todas las variables de sesión del juego
unset($_SESSION['pregunta_actual_id']);
unset($_SESSION['respuesta_correcta_letra']);
unset($_SESSION['respuesta_correcta_texto']);
unset($_SESSION['enunciado_pregunta']);
unset($_SESSION['ultima_respuesta']);
unset($_SESSION['respuesta_elegida']);
unset($_SESSION['preguntas_correctas']);
unset($_SESSION['enunciado_actual']);
unset($_SESSION['opciones_mostradas']);
unset($_SESSION['preguntas_respondidas']);
unset($_SESSION['puntaje_pesos']);
unset($_SESSION['ultimo_puntaje_ganado']);
unset($_SESSION['dificultad_pregunta']);
unset($_SESSION['pregunta_activa']); // IMPORTANTE: Limpiar flag de pregunta activa
unset($_SESSION['tiempo_inicio_pregunta']); // Limpiar tiempo
unset($_SESSION['tiempo_limite_segundos']); // Limpiar límite

// Resetear comodines
ComodinModel::resetearComodines();

// Verificar si quiere cambiar de categoría
if ($cambiarCategoria) {
    // Limpiar categoría y redirigir a selección
    unset($_SESSION['categoria_seleccionada']);
    unset($_SESSION['categoria_nombre']);
    
    header('Location: seleccionar_categoria.php');
    exit();
}

// Redirigir al inicio del juego manteniendo la categoría actual
header('Location: ../../backend/controllers/PreguntasController.php');
exit();
?>