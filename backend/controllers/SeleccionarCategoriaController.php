<?php

session_start();

// Verificar que el aprendiz haya iniciado sesión y validado el código
if (!isset($_SESSION["aprendiz"]) || !isset($_SESSION["codigo_validado"])) {
    header("Location: ../../frontend/views/login_aprendiz.php");
    exit();
}

// Verificar que llegue por POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_categoria"])) {
    $id_categoria = $_POST["id_categoria"];
    
    // Limpiar cualquier dato de juego previo
    unset($_SESSION['pregunta_actual_id']);
    unset($_SESSION['respuesta_correcta_letra']);
    unset($_SESSION['respuesta_correcta_texto']);
    unset($_SESSION['enunciado_pregunta']);
    unset($_SESSION['ultima_respuesta']);
    unset($_SESSION['respuesta_elegida']);
    unset($_SESSION['preguntas_correctas']);
    unset($_SESSION['enunciado_actual']);
    unset($_SESSION['opciones_mostradas']);
    
    // Verificar si seleccionó MIXTA
    if ($id_categoria === "MIXTA") {
        // Modo mixto: todas las categorías
        $_SESSION["categoria_seleccionada"] = "MIXTA";
        $_SESSION["categoria_nombre"] = "Mixta (Todas las categorías)";
        
        // Redirigir al juego
        header("Location: PreguntasController.php");
        exit();
    } else {
        // Validar que la categoría existe
        $id_categoria = intval($id_categoria);
        
        require_once __DIR__ . '/../models/CategoriaModel.php';
        require_once __DIR__ . '/../models/PreguntaModel.php';
        
        $categoriaModel = new CategoriaModel();
        $preguntaModel = new PreguntaModel();
        
        $categoria = $categoriaModel->obtenerCategoriaPorId($id_categoria);
        
        if ($categoria) {
            // Verificar que haya preguntas disponibles en esta categoría
            $cantidad_preguntas = $preguntaModel->contarPreguntasPorCategoria($id_categoria);
            
            if ($cantidad_preguntas > 0) {
                // Guardar la categoría seleccionada en sesión
                $_SESSION["categoria_seleccionada"] = $id_categoria;
                $_SESSION["categoria_nombre"] = $categoria['nombre_categoria'];
                
                // Redirigir al juego
                header("Location: PreguntasController.php");
                exit();
            } else {
                // No hay preguntas en esta categoría
                header("Location: ../../frontend/views/seleccionar_categoria.php?error=sin_preguntas");
                exit();
            }
        } else {
            // Categoría no válida
            header("Location: ../../frontend/views/seleccionar_categoria.php?error=categoria_invalida");
            exit();
        }
    }
} else {
    // Si no llega por POST, redirigir a la selección
    header("Location: ../../frontend/views/seleccionar_categoria.php");
    exit();
}
?>