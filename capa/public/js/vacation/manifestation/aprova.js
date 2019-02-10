$(function() {
  // aprovando o pedido de férias
  $(document).on('click', '#btn-aprovar', function(e) {
    e.preventDefault;

    var id = undefined;
    var colaborador = undefined;

    // percorrendo botões da tabela de exercícios
    $('#relatorio tbody .btn-sm').each(function() {
      // verificando qual foi o botão selecionado pelo usuário
      if ($(this).hasClass('btn-success')) {
        // recuperando id do exercício de férias
        id = $(this).val();

        // recuperando o id do colaborador
        colaborador = $(this).attr('data-id-colaborador');
      }
    });

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
            text: 'Pedido aprovado, mas não foi possível enviar o e-mail de aprovação, consulte sua caixa de e-mail e refaça o envio.',
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