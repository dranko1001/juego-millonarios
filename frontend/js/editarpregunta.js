function abrirModalEdicion(pregunta) {
    // Llenar campos del formulario
    document.getElementById('modal-id').value = pregunta.ID_pregunta;
    document.getElementById('modal-enunciado').value = pregunta.enunciado_pregunta;
    document.getElementById('modal-op1').value = pregunta.opcion1_pregunta;
    document.getElementById('modal-op2').value = pregunta.opcion2_pregunta;
    document.getElementById('modal-op3').value = pregunta.opcion3_pregunta;
    document.getElementById('modal-op4').value = pregunta.opcion4_pregunta;
    document.getElementById('modal-categoria').value = pregunta.ID_categoria;
    document.getElementById('modal-dificultad').value = pregunta.ID_dificultad;
    
    // Limpiar todos los radio buttons primero
    document.querySelectorAll('input[name="correcta_pregunta"]').forEach(radio => {
        radio.checked = false;
    });
    
    // Determinar qué radio button marcar comparando con el texto de cada opción
    const correcta = pregunta.correcta_pregunta.toString().trim();
    
    // Comparar con cada opción para encontrar la correcta
    if (correcta === pregunta.opcion1_pregunta.toString().trim()) {
        document.getElementById('radio-A').checked = true;
    } else if (correcta === pregunta.opcion2_pregunta.toString().trim()) {
        document.getElementById('radio-B').checked = true;
    } else if (correcta === pregunta.opcion3_pregunta.toString().trim()) {
        document.getElementById('radio-C').checked = true;
    } else if (correcta === pregunta.opcion4_pregunta.toString().trim()) {
        document.getElementById('radio-D').checked = true;
    } else {
        // Si no coincide con ninguna, intentar con el valor directo (por si acaso es A, B, C o D)
        const correctaUpper = correcta.toUpperCase();
        const radioElement = document.getElementById('radio-' + correctaUpper);
        
        if (radioElement) {
            radioElement.checked = true;
        } else {
            // Fallback: mapear valores numéricos o textuales
            const mapeo = {
                '1': 'A',
                '2': 'B', 
                '3': 'C',
                '4': 'D',
                'OPCION1': 'A',
                'OPCION2': 'B',
                'OPCION3': 'C',
                'OPCION4': 'D'
            };
            
            const valorMapeado = mapeo[correctaUpper];
            if (valorMapeado) {
                document.getElementById('radio-' + valorMapeado).checked = true;
            } else {
                console.warn('Valor de respuesta correcta no reconocido:', pregunta.correcta_pregunta);
                // Por defecto marcar A
                document.getElementById('radio-A').checked = true;
            }
        }
    }
    
    // Abrir modal
    const modal = new bootstrap.Modal(document.getElementById('editarModal'));
    modal.show();
}