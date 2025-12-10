<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENA</title>
    <link rel="stylesheet" href="../css/estiloPrueba.css">
</head>

<body>
    <div class="game-container">
        <!-- Header -->
        <div class="header">
            <h1>Bienvenidos al SENA</h1>
        </div>

        <!-- Contenido principal -->
        <div class="main-content">
            <!-- Panel izquierdo: Logo y comodines -->
            <div class="left-panel">
                <div class="logo-container">
                    <img src="../media/logo.jpg" alt="Logo HLEP">
                </div>

                <div class="lifelines">
                    <div class="lifeline" title="Pregunta al público">
                        <span class="lifeline-icon">👥</span>
                    </div>
                    <div class="lifeline" title="Llamar a un amigo">
                        <span class="lifeline-icon">📞</span>
                    </div>
                    <div class="lifeline" title="50:50">
                        <span class="lifeline-icon">50:50</span>
                    </div>
                </div>
            </div>

            <!-- Panel central: Pregunta y respuestas -->
            <div class="center-panel">
                <div class="question-container">
                    <p class="question-text">
                        ¿Qué letra debe aparecer al comienzo del número de registro de todas las aeronaves no militares
                        en los Estados Unidos?
                    </p>
                </div>

                <div class="answers-grid">
                    <button class="answer-btn">
                        <span class="answer-letter">A</span>
                        <span>Respuesta A</span>
                    </button>
                    <button class="answer-btn">
                        <span class="answer-letter">B</span>
                        <span>Respuesta B</span>
                    </button>
                    <button class="answer-btn">
                        <span class="answer-letter">C</span>
                        <span>Respuesta C</span>
                    </button>
                    <button class="answer-btn">
                        <span class="answer-letter">D</span>
                        <span>Respuesta D</span>
                    </button>
                </div>

                <div class="action-buttons">
                    <button class="next-btn">Siguiente Pregunta</button>
                </div>
            </div>
        </div>
    </div>tones con franja izquierda</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f0f0f0;
        padding: 40px;
    }

    .boton {
        padding: 12px 20px;
        border: none;
        color: white;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        width: 220px;
        text-align: left;
        font-weight: bold;
        margin-bottom: 12px;
    }

    /* Cada botón con su color base + la franja del 15% */
    .btnVerde {
        background: linear-gradient(to right, #2ecc71 15%, #27ae60 15%);
    }

    .btnRojo {
        background: linear-gradient(to right, #e74c3c 15%, #c0392b 15%);
    }

    .btnAzul {
        background: linear-gradient(to right, #3498db 15%, #2980b9 15%);
    }

    .btnNaranja {
        background: linear-gradient(to right, #f39c12 15%, #d68910 15%);
    }
</style>

</head>
<body>

<h2>Ejemplo de Botones con Franja Izquierda</h2>

<button class="boton btnVerde">Botón Verde</button>
<button class="boton btnRojo">Botón Rojo</button>
<button class="boton btnAzul">Botón Azul</button>
<button class="boton btnNaranja">Botón Naranja</button>

</body>
</html>

</body>

</html>