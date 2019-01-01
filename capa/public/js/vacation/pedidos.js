$(function() {
  $(document).ready(function(e) {
    e.preventDefault;

    var id = $('#id').val();

    if (id != 0) {
      $.ajax({
        type: 'post',
        url: '../../../app/requests/post/vacation/recebe_pedido_exercicio.php',
        dataType: 'html',
        data: {
          id: id              
        },
        success: function(tr) {
          $('#tbody').html(tr);
        },
        error: function(resposta) {
          console.log(resposta);
        }
      });
    } else {
      alert('Selecione um Colaborador!');
    }
  });
});