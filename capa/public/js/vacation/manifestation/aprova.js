$(function() {
  // aprovando o pedido de férias
  $(document).on('click', '#btn-aprovar', function(e) {
    e.preventDefault;

    // recuperando id do exercídio de férias
    var id = $('.table tbody').find('tr[data-id]').data('id');

    // recuperando o id do colaborador selecionado
    var colaborador = $('#colaborador').val();

    $.ajax({
      type: 'post',
      url: '../../../app/requests/post/vacation/processa_aprovacao_pedido_ferias.php',
      dataType: 'json',
      data: {
        id: id,
        colaborador: colaborador
      },
      beforeSend: function () {
        swal({
          title: 'Aviso',
          text: 'Aguarde...',
          icon: 'info',
          buttons: false
        });
      },
      success: function(retorno) {
        // verificando se o pedido foi gravado com sucesso
        if (retorno) {
          swal({
            title: 'Aviso',
            text: 'Pedido aprovado com sucesso. Um e-mail informando a aprovação das férias foi enviado.',
            icon: 'success'              
          }).then((valor) => {
            if (valor) {
              location.reload();
            }
          });
        } else {
          swal({
            title: 'Aviso',
            text: 'Erro ao tentar aprovar o pedido, informe ao Wellington Felix.',
            icon: 'warning'              
          });            
        }
      },
      error: function(erro) {
        console.log(erro);
      }
    });      
  });
});