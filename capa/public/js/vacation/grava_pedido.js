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

    // recuperando período selecionado pelo usuário
    pedido.periodo = $('#periodos').val();

    // recuperando id do exercídio de férias
    pedido.id = $('#id-exercicio').val();
    
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
      $.ajax({
        type: 'post',
        url: '../../../app/requests/post/vacation/processa_pedido_ferias.php',
        dataType: 'json',
        data: {
          pedido: pedido
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
          // inserindo número do registro
          $('#ticket').html(dados.registro);

          // verificando se o pedido foi gravado com sucesso
          if (dados.resultado) {
            swal({
              title: 'Aviso',
              text: 'Pedido gravado com sucesso. Um e-mail solicitando a aprovação do pedido foi enviado para Adilson Badaró.',
              icon: 'success'              
            }).then((valor) => {
              if (valor) {
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
  });
});