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

    // verificando se o botão percorrido é o botão clicado pelo usuário
    exercicio.id         = $('.table tbody').find('tr[data-id]').data('id');
    exercicio.final      = $('.table tbody tr').find('td[data-final]').data('final');
    exercicio.vencimento = $('.table tbody tr').find('td[data-vencimento]').data('vencimento');

    // recuperando o período de férias selecionado
    exercicio.periodo = $(this).val();

    // separando a data do exercício final pela /
    tmp = exercicio.final.split('/');

    // alterando formato da data para aaaa-mm-dd
    exercicio.final = tmp[2] + '-' + tmp[1] + '-' + tmp[0];

    // separando a data de vencimento pela /
    tmp = exercicio.vencimento.split('/');

    // verificando se o mês é janeiro
    if (tmp[1] == '01') {
      // reduzindo um mês e um ano
      tmp[1] = '12';
      tmp[2] = parseInt(tmp[2]) - 1;
    } else {
      // reduzindo um mês
      tmp[1] = parseInt(tmp[1]) - 1;
    }
    
    // verificando se o mês está entre janeiro e setembro
    if (tmp[1] <= 9) {tmp[1] = '0' + tmp[1];}

    // alterando formato da data de vencimento para aaaa-mm-dd
    exercicio.vencimento = tmp[2] + '-' + tmp[1] + '-' + tmp[0];

    // setando id do exercício no input hidden da página
    $('#id-exercicio').val(exercicio.id);

    // verificando qual foi o período de dias selecionado pelo usuário
    switch (exercicio.periodo) {
      case '1':
        // liberando data inicial para preenchimento
        $('#data-inicial-1').prop('readonly', false);

        // removendo e adicionando classe hidden
        $('.row #linha-1').removeClass('hidden');
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
    }    
  });
});