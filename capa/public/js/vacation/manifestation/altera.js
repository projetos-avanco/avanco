$(function() {
  // gravando pedido de férias
  $(document).on('click', '#btn-gravar', function(e) {
    e.preventDefault;

    var flag = false;

    var pedido = {
      id: null,
      periodo: null,
      periodo1: {
        dataInicial: null,
        dataFinal: null,
      },
      periodo2: {
        dataInicial: null,
        dataFinal: null,
      },
      periodo3: {
        dataInicial: null,
        dataFinal: null,
      }
    };

    // recuperando id do exercídio de férias
    pedido.id = $('#id-exercicio').val();

    // recuperando período selecionado pelo usuário
    pedido.periodo = $('#periodos').val();

    // verificando se o usuário tentou gravar um pedido sem agenda um exercício
    if (pedido.periodo == 0) {
      swal({
        title: 'Aviso',
        text: 'É necessário selecionar um período antes de gravar a alteração de um pedido.',
        icon: 'warning'
      });      
    } else {
      // verificando qual foi o período selecionado pelo usuário e recuperando as datas
      switch (pedido.periodo) {
        case '1':      
          // recuperando datas
          pedido.periodo1.dataInicial = $('.row #linha-1 #data-inicial-1').val();
          pedido.periodo1.dataFinal   = $('.row #linha-1 #data-final-1').val();
          pedido.periodo1.totalDias   = $('.row #linha-1 #total-dias-1').val();

          // verificando se o período 1 foi preenchido
          if (pedido.periodo1.dataInicial == '' || pedido.periodo1.dataFinal == '') {
            flag = true;

            // adicionando classe erro
            $('.row #linha-1 #data-inicial-1').addClass('erro');

            swal({
              title: 'Aviso',
              text: 'Preencha todas as datas do(s) período(s) selecionado(s).',
              icon: 'warning'
            });
          } else {
            // removendo classe erro
            $('.row #linha-1 #data-inicial-1').removeClass('erro');
          }
        break;

        case '2':        
          // recuperando datas
          pedido.periodo1.dataInicial = $('.row #linha-1 #data-inicial-1').val();
          pedido.periodo1.dataFinal   = $('.row #linha-1 #data-final-1').val();
          pedido.periodo1.totalDias   = $('.row #linha-1 #total-dias-1').val();

          pedido.periodo2.dataInicial = $('.row #linha-2 #data-inicial-2').val();
          pedido.periodo2.dataFinal   = $('.row #linha-2 #data-final-2').val();
          pedido.periodo2.totalDias   = $('.row #linha-2 #total-dias-2').val();

          // verificando se o período 1 foi preenchido
          if (pedido.periodo1.dataInicial == '' || pedido.periodo1.dataFinal == '') {
            flag = true;

            // adicionando classe erro
            $('.row #linha-1 #data-inicial-1').addClass('erro');

            swal({
              title: 'Aviso',
              text: 'Preencha todas as datas do(s) período(s) selecionado(s).',
              icon: 'warning'
            });
          } else {
            // removendo classe erro
            $('.row #linha-1 #data-inicial-1').removeClass('erro');
          }

          // verificando se o período 2 foi preenchido
          if (pedido.periodo2.dataInicial == '' || pedido.periodo2.dataFinal == '') {
            flag = true;

            // adicionando classe erro
            $('.row #linha-2 #data-inicial-2').addClass('erro');

            swal({
              title: 'Aviso',
              text: 'Preencha todas as datas do(s) período(s) selecionado(s).',
              icon: 'warning'
            });
          } else {
            // removendo classe erro
            $('.row #linha-2 #data-inicial-2').removeClass('erro');          
          }
        break;
        
        case '3':        
          // recuperando datas
          pedido.periodo1.dataInicial = $('.row #linha-1 #data-inicial-1').val();
          pedido.periodo1.dataFinal   = $('.row #linha-1 #data-final-1').val();
          pedido.periodo1.totalDias   = $('.row #linha-1 #total-dias-1').val();

          pedido.periodo2.dataInicial = $('.row #linha-2 #data-inicial-2').val();
          pedido.periodo2.dataFinal   = $('.row #linha-2 #data-final-2').val();
          pedido.periodo2.totalDias   = $('.row #linha-2 #total-dias-2').val();

          pedido.periodo3.dataInicial = $('.row #linha-3 #data-inicial-3').val();
          pedido.periodo3.dataFinal   = $('.row #linha-3 #data-final-3').val();
          pedido.periodo3.totalDias   = $('.row #linha-3 #total-dias-3').val();

          // verificando se o período 1 foi preenchido
          if (pedido.periodo1.dataInicial == '' || pedido.periodo1.dataFinal == '') {
            flag = true;

            // adicionando classe erro
            $('.row #linha-1 #data-inicial-1').addClass('erro');

            swal({
              title: 'Aviso',
              text: 'Preencha todas as datas do(s) período(s) selecionado(s).',
              icon: 'warning'
            });
          } else {
            // removendo classe erro
            $('.row #linha-1 #data-inicial-1').removeClass('erro');
          }

          // verificando se o período 2 foi preenchido
          if (pedido.periodo2.dataInicial == '' || pedido.periodo2.dataFinal == '') {
            flag = true;

            // adicionando classe erro
            $('.row #linha-2 #data-inicial-2').addClass('erro');

            swal({
              title: 'Aviso',
              text: 'Preencha todas as datas do(s) período(s) selecionado(s).',
              icon: 'warning'
            });
          } else {
            // removendo classe erro
            $('.row #linha-2 #data-inicial-2').removeClass('erro');
          }

          // verificando se o período 3 foi preenchido
          if (pedido.periodo3.dataInicial == '' || pedido.periodo3.dataFinal == '') {
            flag = true;

            // adicionando classe erro
            $('.row #linha-3 #data-inicial-3').addClass('erro');

            swal({
              title: 'Aviso',
              text: 'Preencha todas as datas do(s) período(s) selecionado(s).',
              icon: 'warning'
            });
          } else {
            // removendo classe erro
            $('.row #linha-3 #data-inicial-3').removeClass('erro');
          }
        break;
      }
          
      // verificando se não houve erros de validação
      if (!flag) {
        // recuperando o id do colaborador selecionado
        var colaborador = $('#colaborador').val();
        
        $.ajax({
          type: 'post',
          url: '../../../app/requests/post/vacation/processa_alteracao_pedido_ferias.php',
          dataType: 'json',
          data: {
            pedido: pedido,
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
          success: function(dados) {            
            // verificando se o pedido foi gravado com sucesso
            if (dados.resultado) {
              swal({
                title: 'Aviso',
                text: 'Pedido alterado com sucesso. Um e-mail informando a aprovação das férias foi enviado.',
                icon: 'success'              
              }).then((valor) => {
                if (valor) {
                  // bloqueado seleção de períodos de férias e selecionando opção 0
                  $('#periodos').prop('disabled', true).prop('selectedIndex', 0);

                  // adicionando classe hidden
                  $('.row #linha-1').addClass('hidden');
                  $('.row #linha-2').addClass('hidden');
                  $('.row #linha-3').addClass('hidden');

                  // setando valor default
                  $('#data-inicial-1').val('');
                  $('#data-final-1').val('');

                  $('#data-inicial-2').val('');
                  $('#data-final-2').val('');

                  $('#data-inicial-3').val('');
                  $('#data-final-3').val('');

                  $('#total-dias-1').val('0');
                  $('#total-dias-2').val('0');
                  $('#total-dias-3').val('0');

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
                }
              });
            } else {
              swal({
                title: 'Aviso',
                text: 'Erro ao tentar gravar o pedido, informe ao Wellington Felix.',
                icon: 'warning'              
              });            
            }
          },
          error: function(erro) {
            console.log(erro);
          }
        });
      }
    }    
  });
});