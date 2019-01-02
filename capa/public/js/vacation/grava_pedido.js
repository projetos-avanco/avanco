$(function() {
  // gravando pedido de férias
  $(document).on('click', '#btn-gravar', function(e) {
    e.preventDefault;

    var flag = false;

    var exercicio = {};

    // recuperando período selecionado pelo usuário
    exercicio.periodo = $('#periodos').val();

    // verificando qual foi o período selecionado pelo usuário e recuperando as datas
    switch (exercicio.periodo) {
      case '1':
        var periodo1 = {};

        periodo1.dataInicial = $('.row #linha-1 #data-inicial-1').val();
        periodo1.dataFinal   = $('.row #linha-1 #data-final-1').val();

        // verificando se o período 1 foi preenchido
        if (periodo1.dataInicial == '' || periodo1.dataFinal == '') {
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
        var periodo1 = {};
        var periodo2 = {};

        periodo1.dataInicial = $('.row #linha-1 #data-inicial-1').val();
        periodo1.dataFinal   = $('.row #linha-1 #data-final-1').val();

        periodo2.dataInicial = $('.row #linha-2 #data-inicial-2').val();
        periodo2.dataFinal   = $('.row #linha-2 #data-final-2').val();

        // verificando se o período 1 foi preenchido
        if (periodo1.dataInicial == '' || periodo1.dataFinal == '') {
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
        if (periodo2.dataInicial == '' || periodo2.dataFinal == '') {
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
        var periodo1 = {};
        var periodo2 = {};
        var periodo3 = {};

        periodo1.dataInicial = $('.row #linha-1 #data-inicial-1').val();
        periodo1.dataFinal   = $('.row #linha-1 #data-final-1').val();

        periodo2.dataInicial = $('.row #linha-2 #data-inicial-2').val();
        periodo2.dataFinal   = $('.row #linha-2 #data-final-2').val();

        periodo3.dataInicial = $('.row #linha-3 #data-inicial-3').val();
        periodo3.dataFinal   = $('.row #linha-3 #data-final-3').val();

        // verificando se o período 1 foi preenchido
        if (periodo1.dataInicial == '' || periodo1.dataFinal == '') {
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
        if (periodo2.dataInicial == '' || periodo2.dataFinal == '') {
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
        if (periodo3.dataInicial == '' || periodo3.dataFinal == '') {
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
        url: '../../../app/requests/post/vacation/.php',
        dataType: 'html',
        data: {
          id: id              
        },
        success: function(dados) {
          console.log(dados);
        },
        error: function(erro) {
          console.log(erro);
        }
      });
    }
  });
});