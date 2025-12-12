<?php
// backend/controllers/CambiarCategoriaController.php
session_start();

// Verificar autenticación
if (!isset($_SESSION["aprendiz"]) || !isset($_SESSION["id_jugador"])) {
    header("Location: ../../frontend/views/login_aprendiz.php");
    exit();
}

require_once __DIR__ . '/../models/ComodinModel.php';
require_once __DIR__ . '/../models/JugadorModel.php';

// 1. Guardar el puntaje actual antes de cambiar
if (isset($_SESSION['puntaje_pesos']) && $_SESSION['puntaje_pesos'] > 0) {
    $jugadorModel = new JugadorModel();
    $jugadorModel->actualizarPuntaje(
        $_SESSION['id_jugador'],
        $_SESSION['puntaje_pesos']
    );
}

// 2. Resetear comodines - ¡IMPORTANTE!
ComodinModel::resetearComodines();

// 3. Limpiar variables de la partida actual
unset($_SESSION['categoria_seleccionada']);
unset($_SESSION['categoria_nombre']);
unset($_SESSION['pregunta_actual_id']);
unset($_SESSION['respuesta_correcta_letra']);
unset($_SESSION['respuesta_correcta_texto']);
unset($_SESSION['enunciado_pregunta']);
unset($_SESSION['opciones_mostradas']);
unset($_SESSION['dificultad_pregunta']);
unset($_SESSION['pregunta_activa']);
unset($_SESSION['preguntas_respondidas']);
unset($_SESSION['preguntas_correctas']);
unset($_SESSION['puntaje_pesos']);
unset($_SESSION['tiempo_inicio_pregunta']);
unset($_SESSION['tiempo_limite_segundos']);

// 4. Redirigir a selección de categoría
header("Location: ../../frontend/views/seleccionar_categoria.php");
exit();
?>