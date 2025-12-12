<?php
// backend/controllers/CambiarCategoriaController.php
session_start();

//*verificar que la sesion de aprendiz este activa
if (!isset($_SESSION["aprendiz"]) || !isset($_SESSION["id_jugador"])) {
    header("Location: ../../frontend/views/login_aprendiz.php");
    exit();
}

require_once __DIR__ . '/../models/ComodinModel.php';
require_once __DIR__ . '/../models/JugadorModel.php';

//*guarda el puntaje antes de cambiar la sesion de categoria
//! mirar si toca quitarlo puede afectar
if (isset($_SESSION['puntaje_pesos']) && $_SESSION['puntaje_pesos'] > 0) {
    $jugadorModel = new JugadorModel();
    $jugadorModel->actualizarPuntaje(
        $_SESSION['id_jugador'],
        $_SESSION['puntaje_pesos']
    );
}

//*resetea los comodines
ComodinModel::resetearComodines();

//*limpiar las variables
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

//* re dirigue a la pagina de seleccionar categoria
header("Location: ../../frontend/views/seleccionar_categoria.php");
exit();
?>