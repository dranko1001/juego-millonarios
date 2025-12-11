var eliminarModal = document.getElementById('eliminarModal');
eliminarModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget;
  document.getElementById('modal-id').value = button.getAttribute('data-id');
  document.getElementById('modal-enunciado').textContent = button.getAttribute('data-enunciado');
});