// Pasar los datos de la fila al modal
var editarModal = document.getElementById('editarModal');
editarModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget;

  document.getElementById('modal-id').value = button.getAttribute('data-id');
  document.getElementById('modal-enunciado').value = button.getAttribute('data-enunciado');
  document.getElementById('modal-op1').value = button.getAttribute('data-op1');
  document.getElementById('modal-op2').value = button.getAttribute('data-op2');
  document.getElementById('modal-op3').value = button.getAttribute('data-op3');
  document.getElementById('modal-op4').value = button.getAttribute('data-op4');
  document.getElementById('modal-correcta').value = button.getAttribute('data-correcta');
  document.getElementById('modal-categoria').value = button.getAttribute('data-categoria');
  document.getElementById('modal-dificultad').value = button.getAttribute('data-dificultad');
});