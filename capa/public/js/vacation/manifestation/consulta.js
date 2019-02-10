$(function() {
  // consultando exercícios de férias
  $(document).on('click', '#btn-consultar', function(e) {
    e.preventDefault;

    var id = $('#colaborador').val();

    if (id != 0) {
      // requisitando o exercício do colaborador
      $.ajax({
        type: 'post',
        url: '../../../app/requests/post/vacation/recebe_consulta_manifestacao.php',
        dataType: 'html',
        data: {
          id: id              
        },
        success: function(tr) {
          $('#tbody').html(tr);

          // recuperando o id do exercício
          var exercicio = $('.table tbody').find('tr[data-id]').data('id');

          // requisitando o pedido do colaborador
          $.ajax({
            type: 'post',
            url: '../../../app/requests/post/vacation/recebe_consulta_pedido.php',
            dataType: 'html',
            data: {                  
              exercicio: exercicio
            },
            success: function(pedido) {
              $('#pedido').html(pedido);
            },
            error: function(resposta) {
              console.log(resposta);
            }
          });
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