function abrirModalEliminar(button) {
    const id = button.getAttribute('data-id');
    const enunciado = button.getAttribute('data-enunciado');
    
    document.getElementById('modal-id').value = id;
    document.getElementById('modal-enunciado').textContent = enunciado;
    
    const modal = new bootstrap.Modal(document.getElementById('eliminarModal'));
    modal.show();
}