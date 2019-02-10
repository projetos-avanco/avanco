$(function() {
  // visualizando pesquisa externa
  $(document).on('click', '#visualizar-pesquisa-prox', function(e) {
    e.preventDefault;

    var id = $(this).val();

    $.ajax({
      type: 'post',
      url: '../../../database/functions/schedule/customers/ajax/dados_pesquisa_prox.php',
      dataType: 'json',
      data: {
        id: id
      },
      success: function(dados) {
        // exibindo pesquisa externa alert
        swal({
          icon: 'info',
          title: 'Pesquisa Externa!',
          text:               
            'Data: '                 + dados.registrado    + "\n\n" +
            'Realizada: '            + dados.supervisor    + "\n\n" +
            'Situação: '             + dados.status        + "\n\n" +
            'Qualidade do Serviço: ' + dados.qualidade     + "\n\n" +
            'Serviço Realizado: '    + dados.entrega       + "\n\n" +
            'Considerações: '        + dados.consideracoes
        });              
      },
      error: function(dados) {
        console.log(dados);
      }
    });
  });
});