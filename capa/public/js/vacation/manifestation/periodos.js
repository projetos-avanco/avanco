$(function() {
  // alterando pedido
  $(document).on('click', '#btn-alterar', function(e) {
    e.preventDefault;

    // liberando seleção de períodos de férias
    $('#periodos').prop('disabled', false);
  });

  // selecionando período de dias
  $(document).on('change', '#periodos', function(e) {
    e.preventDefault;

    var exercicio = {};
    var tmp = '';

    // recuperando o regime de trabalho do colaborador
    exercicio.regime = $('#regime').val();

    // recuperando o contrato de trabalho do colaborador
    exercicio.contrato = $('#contrato').val();

    // recuperando o período de férias selecionado
    exercicio.periodo = $(this).val();

    // percorrendo botões da tabela de exercícios
    $('#relatorio tbody .btn-sm').each(function() {
      // verificando qual foi o botão selecionado pelo usuário
      if ($(this).hasClass('btn-success')) {
        // recuperando id do exercício de férias
        exercicio.id         = $(this).val();
        exercicio.inicial    = $(this).attr('data-inicial');
        exercicio.final      = $(this).attr('data-final');
        exercicio.vencimento = $(this).attr('data-vencimento');
      }
    });
    
    // separando a data do exercício final pela /
    tmp = exercicio.inicial.split('/');

    // alterando formato da data para aaaa-mm-dd
    exercicio.inicial = tmp[2] + '-' + tmp[1] + '-' + tmp[0];

    $('#exercicio-inicial').val(exercicio.inicial);

    // separando a data do exercício final pela /
    tmp = exercicio.final.split('/');

    // alterando formato da data para aaaa-mm-dd
    exercicio.final = tmp[2] + '-' + tmp[1] + '-' + tmp[0];

    $('#exercicio-final').val(exercicio.final);

    // separando a data de vencimento pela /
    tmp = exercicio.vencimento.split('/');

    // alterando formato da data de vencimento para aaaa-mm-dd
    exercicio.vencimento = tmp[2] + '-' + tmp[1] + '-' + tmp[0];

    $('#exercicio-vencimento').val(exercicio.vencimento);

    var date = new Date(exercicio.vencimento);

    exercicio.dia = date.getDate();

    // diminuindo 30 dias (1 meses) na data de vencimento
    date.setDate(exercicio.dia - 30);

    /*
    // verificando se o regime do colaborador é clt
    if (exercicio.regime == '1') {
      // diminuindo 60 dias (2 meses) na data de vencimento
      date.setDate(exercicio.dia - 60);
    // verificando se o regiem do colaborador é estágio
    } else if (exercicio.regime == '2') {
      // diminuindo 30 dias (1 meses) na data de vencimento
      date.setDate(exercicio.dia - 30);
    }
    */

    // dividindo a data de admissão em array para recuperar o exercício final
    exercicio.tmp = date.toISOString();
    exercicio.tmp = exercicio.tmp.split('T');
    exercicio.vencimento = exercicio.tmp[0];

    // setando valor default
    $('#data-inicial-1').val('');
    $('#data-inicial-2').val('');
    $('#data-inicial-3').val('');
    $('#data-inicial-4').val('');

    $('#data-final-1').val('');
    $('#data-final-2').val('');
    $('#data-final-3').val('');
    $('#data-final-4').val('');

    $('#total-dias-1').val('0');
    $('#total-dias-2').val('0');
    $('#total-dias-3').val('0');
    $('#total-dias-4').val('0');

    // setando id do exercício no input hidden da página
    $('#id-exercicio').val(exercicio.id);

    // verificando se o regime do colaborador é contratado
    if (exercicio.regime == '1') {
      // verificando qual foi o período de dias selecionado pelo usuário
      switch (exercicio.periodo) {
        case '1':
          // liberando data inicial para preenchimento
          $('#data-inicial-1').prop('readonly', false);

          // removendo e adicionando classe hidden
          $('.row #linha-1').removeClass('hidden');
          $('.row #linha-2').addClass('hidden');
          $('.row #linha-3').addClass('hidden');
          $('.row #linha-4').addClass('hidden');

          // removendo classe erro caso ela exista
          $('.row #linha-1 #data-inicial-1').removeClass('erro');

          // setando data mínima e máxima de acorodo com o exercício
          $('#data-inicial-1').prop('min', exercicio.final).prop('max', exercicio.vencimento);
          $('#data-final-1').prop('min', exercicio.final).prop('max', exercicio.vencimento);        
        break;

        case '2':
          // liberando data inicial para preenchimento
          $('#data-inicial-1').prop('readonly', false);
          $('#data-inicial-2').prop('readonly', false);

          // removendo e adicionando classe hidden
          $('.row #linha-1').removeClass('hidden');
          $('.row #linha-2').removeClass('hidden');
          $('.row #linha-3').addClass('hidden');
          $('.row #linha-4').addClass('hidden');

          // removendo classe erro caso ela exista
          $('.row #linha-1 #data-inicial-1').removeClass('erro');
          $('.row #linha-2 #data-inicial-2').removeClass('erro');

          // setando data mínima e máxima de acorodo com o exercício
          $('#data-inicial-1').prop('min', exercicio.final).prop('max', exercicio.vencimento);
          $('#data-final-1').prop('min', exercicio.final).prop('max', exercicio.vencimento);

          $('#data-inicial-2').prop('min', exercicio.final).prop('max', exercicio.vencimento);
          $('#data-final-2').prop('min', exercicio.final).prop('max', exercicio.vencimento);        
        break;

        case '3':
          // liberando data inicial para preenchimento
          $('#data-inicial-1').prop('readonly', false);
          $('#data-inicial-2').prop('readonly', false);
          $('#data-inicial-3').prop('readonly', false);

          // removendo classe hidden
          $('.row #linha-1').removeClass('hidden');
          $('.row #linha-2').removeClass('hidden');
          $('.row #linha-3').removeClass('hidden');

          // removendo classe erro caso ela exista
          $('.row #linha-1 #data-inicial-1').removeClass('erro');
          $('.row #linha-2 #data-inicial-2').removeClass('erro');
          $('.row #linha-3 #data-inicial-3').removeClass('erro');

          // setando data mínima e máxima de acorodo com o exercício
          $('#data-inicial-1').prop('min', exercicio.final).prop('max', exercicio.vencimento);
          $('#data-final-1').prop('min', exercicio.final).prop('max', exercicio.vencimento);

          $('#data-inicial-2').prop('min', exercicio.final).prop('max', exercicio.vencimento);
          $('#data-final-2').prop('min', exercicio.final).prop('max', exercicio.vencimento);

          $('#data-inicial-3').prop('min', exercicio.final).prop('max', exercicio.vencimento);
          $('#data-final-3').prop('min', exercicio.final).prop('max', exercicio.vencimento);
        break;

        case '4':        
          // liberando data inicial para preenchimento
          $('#data-inicial-1').prop('readonly', false);
          $('#data-inicial-2').prop('readonly', false);

          // removendo e adicionando classe hidden
          $('.row #linha-1').removeClass('hidden');
          $('.row #linha-2').removeClass('hidden');
          $('.row #linha-3').addClass('hidden');
          $('.row #linha-4').addClass('hidden');
          
          // removendo classe erro caso ela exista
          $('.row #linha-1 #data-inicial-1').removeClass('erro');
          $('.row #linha-2 #data-inicial-2').removeClass('erro');

          // setando data mínima e máxima de acorodo com o exercício
          $('#data-inicial-1').prop('min', exercicio.final).prop('max', exercicio.vencimento);
          $('#data-final-1').prop('min', exercicio.final).prop('max', exercicio.vencimento);

          $('#data-inicial-2').prop('min', exercicio.final).prop('max', exercicio.vencimento);
          $('#data-final-2').prop('min', exercicio.final).prop('max', exercicio.vencimento);
        break;

        case '5':
          // liberando data inicial para preenchimento
          $('#data-inicial-1').prop('readonly', false);
          $('#data-inicial-2').prop('readonly', false);

          // removendo e adicionando classe hidden
          $('.row #linha-1').removeClass('hidden');
          $('.row #linha-2').removeClass('hidden');
          $('.row #linha-3').addClass('hidden');
          $('.row #linha-4').addClass('hidden');

          // removendo classe erro caso ela exista
          $('.row #linha-1 #data-inicial-1').removeClass('erro');
          $('.row #linha-2 #data-inicial-2').removeClass('erro');

          // setando data mínima e máxima de acorodo com o exercício
          $('#data-inicial-1').prop('min', exercicio.final).prop('max', exercicio.vencimento);
          $('#data-final-1').prop('min', exercicio.final).prop('max', exercicio.vencimento);

          $('#data-inicial-2').prop('min', exercicio.final).prop('max', exercicio.vencimento);
          $('#data-final-2').prop('min', exercicio.final).prop('max', exercicio.vencimento);
        break;
      }
    // verificando se o regime do colaborador é estágio
    } else if (exercicio.regime == '2') {
      // verificando se o contrato do colaborador é semestral
      if (exercicio.contrato == '1') {
        switch (exercicio.periodo) {
          case '6':
            // liberando data inicial para preenchimento
            $('#data-inicial-4').prop('readonly', false);

            // removendo e adicionando classe hidden
            $('.row #linha-1').addClass('hidden');
            $('.row #linha-2').addClass('hidden');
            $('.row #linha-3').addClass('hidden');
            $('.row #linha-4').removeClass('hidden');

            // removendo classe erro caso ela exista
            $('.row #linha-4 #data-inicial-4').removeClass('erro');

            // setando data mínima e máxima de acorodo com o exercício
            $('#data-inicial-4').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);
            $('#data-final-4').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);
          break;
        }
      // verificando se o contrato do colaborador é anual
      } else if (exercicio.contrato == '2') {
        // verificando qual foi o período de dias selecionado pelo usuário
        switch (exercicio.periodo) {
          case '1':
            // liberando data inicial para preenchimento
            $('#data-inicial-1').prop('readonly', false);

            // removendo e adicionando classe hidden
            $('.row #linha-1').removeClass('hidden');
            $('.row #linha-2').addClass('hidden');
            $('.row #linha-3').addClass('hidden');
            $('.row #linha-4').addClass('hidden');

            // removendo classe erro caso ela exista
            $('.row #linha-1 #data-inicial-1').removeClass('erro');

            // setando data mínima e máxima de acorodo com o exercício
            $('#data-inicial-1').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);
            $('#data-final-1').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);
          break;

          case '2':
            // liberando data inicial para preenchimento
            $('#data-inicial-1').prop('readonly', false);
            $('#data-inicial-2').prop('readonly', false);

            // removendo e adicionando classe hidden
            $('.row #linha-1').removeClass('hidden');
            $('.row #linha-2').removeClass('hidden');
            $('.row #linha-3').addClass('hidden');
            $('.row #linha-4').addClass('hidden');

            // removendo classe erro caso ela exista
            $('.row #linha-1 #data-inicial-1').removeClass('erro');
            $('.row #linha-2 #data-inicial-2').removeClass('erro');

            // setando data mínima e máxima de acorodo com o exercício
            $('#data-inicial-1').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);
            $('#data-final-1').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);

            $('#data-inicial-2').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);
            $('#data-final-2').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);
          break;

          case '3':
            // liberando data inicial para preenchimento
            $('#data-inicial-1').prop('readonly', false);
            $('#data-inicial-2').prop('readonly', false);
            $('#data-inicial-3').prop('readonly', false);

            // removendo classe hidden
            $('.row #linha-1').removeClass('hidden');
            $('.row #linha-2').removeClass('hidden');
            $('.row #linha-3').removeClass('hidden');

            // removendo classe erro caso ela exista
            $('.row #linha-1 #data-inicial-1').removeClass('erro');
            $('.row #linha-2 #data-inicial-2').removeClass('erro');
            $('.row #linha-3 #data-inicial-3').removeClass('erro');

            // setando data mínima e máxima de acorodo com o exercício
            $('#data-inicial-1').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);
            $('#data-final-1').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);

            $('#data-inicial-2').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);
            $('#data-final-2').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);

            $('#data-inicial-3').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);
            $('#data-final-3').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);
          break;
          
          case '4':        
            // liberando data inicial para preenchimento
            $('#data-inicial-1').prop('readonly', false);
            $('#data-inicial-2').prop('readonly', false);

            // removendo e adicionando classe hidden
            $('.row #linha-1').removeClass('hidden');
            $('.row #linha-2').removeClass('hidden');
            $('.row #linha-3').addClass('hidden');
            $('.row #linha-4').addClass('hidden');

            // removendo classe erro caso ela exista
            $('.row #linha-1 #data-inicial-1').removeClass('erro');
            $('.row #linha-2 #data-inicial-2').removeClass('erro');

            // setando data mínima e máxima de acorodo com o exercício
            $('#data-inicial-1').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);
            $('#data-final-1').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);

            $('#data-inicial-2').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);
            $('#data-final-2').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);
          break;

          case '5':
            // liberando data inicial para preenchimento
            $('#data-inicial-1').prop('readonly', false);
            $('#data-inicial-2').prop('readonly', false);

            // removendo e adicionando classe hidden
            $('.row #linha-1').removeClass('hidden');
            $('.row #linha-2').removeClass('hidden');
            $('.row #linha-3').addClass('hidden');
            $('.row #linha-4').addClass('hidden');

            // removendo classe erro caso ela exista
            $('.row #linha-1 #data-inicial-1').removeClass('erro');
            $('.row #linha-2 #data-inicial-2').removeClass('erro');

            // setando data mínima e máxima de acorodo com o exercício
            $('#data-inicial-1').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);
            $('#data-final-1').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);

            $('#data-inicial-2').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);
            $('#data-final-2').prop('min', exercicio.inicial).prop('max', exercicio.vencimento);
          break;
        }
      }
    }
  });
});