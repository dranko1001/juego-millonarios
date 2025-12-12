function abrirModalEliminar(id, enunciado) {
    document.getElementById('modal-id').value = id;
    document.getElementById('modal-enunciado').textContent = enunciado;
    
    const modal = new bootstrap.Modal(document.getElementById('eliminarModal'));
    modal.show();
}