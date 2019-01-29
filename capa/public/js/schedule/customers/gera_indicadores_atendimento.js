$(function() {
  $(document).on('click', '#btn-consultar', function(e) {
    e.preventDefault;

    var atendimento = {};

    atendimento.id          = $('#id').val();
    atendimento.dataInicial = $('#data-inicial').val();
    atendimento.dataFinal   = $('#data-final').val();

    // verificando se alguma empresa foi selecionada
    if (atendimento.id === '') {
      swal({
        title: "Aviso!",
        text: "Pesquise e selecione uma empresa antes de consultar.",
        icon: "info",
      });
    } else {
      $.ajax({
        type: 'post',
        url: '../../../database/functions/schedule/customers/ajax/dados_paginacao_atendimento.php',
        dataType: 'json',
        data: {
          id: atendimento.id,
          data_inicial: atendimento.dataInicial,
          data_final: atendimento.dataFinal
        },
        beforeSend: function () {
          swal({
            title: 'Aviso',
            text: 'Calculando Indicadores de Atendimento, aguarde...',
            icon: 'info',
            buttons: false
          });
        },
        success: function(dados) {
          swal({
            title: 'Aviso',
            text: 'Indicadores de Atendimento calculados.',
            icon: 'success'            
          });

          // verificando se nenhuma empresa foi selecionada
          if (dados === '0') {
            swal({
              title: 'Aviso',
              text: 'Não foi selecionado nenhuma empresa',
              icon: 'info'              
            });            
          } else {
            // verificando se o percentual avancino é nulo
            if (dados.percentual_avancino === null) {
              dados.percentual_avancino = '0';
            }

            // verificando se o percentual de perda é nulo
            if (dados.percentual_perda === null) {
              dados.percentual_perda = '0';
            }

            // verificando se o percentual de fila é nulo
            if (dados.percentual_fila === null) {
              dados.percentual_fila = '0';
            }

            $('#atendimentos-realizados').val(dados.atendimentos_realizados);
            $('#percentual-perda').val(dados.percentual_perda + '%');
            $('#percentual-avancino').val(dados.percentual_avancino + '%');
            $('#percentual-fila').val(dados.percentual_fila + '%');
          }
        },
        error: function(erro) {
          console.log(erro);
        }
      });
    }
  });
});