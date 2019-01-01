$(function() {
  // validando período 1
  $(document).on('change', '#data-inicial-1', function(e) {
    e.preventDefault;
        
    var exercicio = {};

    exercicio.inicial = $('#data-inicial-1').val();    
    exercicio.periodo = $('#periodos').val();

    // verificando qual foi o período de férias selecionado pelo usuário
    switch (exercicio.periodo) {
      case '1':
        exercicio.dias = 30;
      break;

      case '2':
        exercicio.dias = 15;
      break;

      case '3':
        exercicio.dias = 10;
      break;
    }

    // separando data inicial pelo -
    var tmp = exercicio.inicial.split('-');

    // chamando função que retorna o dia do mês sem o 0
    tmp = retornaDiaSemZero(tmp);

    // setando data inicial no objeto
    exercicio.inicial = tmp[0] + '-' + tmp[1] + '-' + tmp[2];
    
    // criando objeto Date
    var date = new Date(exercicio.inicial);

    exercicio.diaDoMes = date.getDate();

    date.setDate(exercicio.diaDoMes + exercicio.dias);
    tmp = date.toISOString();
    tmp = tmp.split('T');

    exercicio.final = tmp[0];
    exercicio.vencimento = $('#data-final-1').prop('max');

    // verificando se a data final é menor que a data de vencimento com um mês a menos    
    if (exercicio.final <= exercicio.vencimento) {
      // setando a data final no campo input date
      $('#data-final-1').val(tmp[0]);

      // calculando quantidade de dias agendados pela diferença da data final e data inicial
      exercicio.inicial = $('#data-inicial-1').val();
      exercicio.final = $('#data-final-1').val();

      tmp = exercicio.inicial.split('-');
      tmp = retornaDiaSemZero(tmp);
      exercicio.inicial = tmp[0] + '-' + tmp[1] + '-' + tmp[2];

      dataObjetoInicial = new Date(exercicio.inicial);

      tmp = exercicio.final.split('-');
      tmp = retornaDiaSemZero(tmp);
      exercicio.final = tmp[0] + '-' + tmp[1] + '-' + tmp[2];

      dataObjetoFinal = new Date(exercicio.final);
      
      // calculando a quantidade de dias agendados
      exercicio.dia = 1000 * 60 * 60 * 24;
      exercicio.inicialMilisegundos = dataObjetoInicial.getTime();
      exercicio.finalMilisegundos = dataObjetoFinal.getTime();
      exercicio.quantidadeDias = exercicio.finalMilisegundos - exercicio.inicialMilisegundos;
      
      exercicio.quantidadeDias = Math.round(exercicio.quantidadeDias / exercicio.dia);

      // setando quantidade de dias no input text
      $('#total-dias-1').val(exercicio.quantidadeDias + ' Dias');
    } else {
      // setando valor default
      $('#data-inicial-1').val('');
      $('#data-final-1').val('');
      $('#total-dias-1').val('0 Dias');

      swal({
        title: 'Aviso',
        text: 'A data final do período não pode ultrapassar 30 dias antes da data limite!',
        icon: 'warning'
      });
    }
  });

  // validando período 2
  $(document).on('change', '#data-inicial-2', function(e) {
    e.preventDefault;

    var exercicio = {};

    exercicio.inicial = $('#data-inicial-2').val();    
    exercicio.periodo = $('#periodos').val();

    // verificando qual foi o período de férias selecionado pelo usuário
    switch (exercicio.periodo) {
      case '1':
        exercicio.dias = 30;
      break;

      case '2':
        exercicio.dias = 15;
      break;

      case '3':
        exercicio.dias = 10;
      break;
    }

    // separando data inicial pelo -
    var tmp = exercicio.inicial.split('-');

    // chamando função que retorna o dia do mês sem o 0
    tmp = retornaDiaSemZero(tmp);

    // setando data inicial no objeto
    exercicio.inicial = tmp[0] + '-' + tmp[1] + '-' + tmp[2];
    
    // criando objeto Date
    var date = new Date(exercicio.inicial);

    exercicio.diaDoMes = date.getDate();

    date.setDate(exercicio.diaDoMes + exercicio.dias);
    tmp = date.toISOString();
    tmp = tmp.split('T');

    exercicio.final = tmp[0];
    exercicio.vencimento = $('#data-final-2').prop('max');

    // verificando se a data final é menor que a data de vencimento com um mês a menos    
    if (exercicio.final <= exercicio.vencimento) {
      // setando a data final no campo input date
      $('#data-final-2').val(tmp[0]);

      // calculando quantidade de dias agendados pela diferença da data final e data inicial
      exercicio.inicial = $('#data-inicial-2').val();
      exercicio.final = $('#data-final-2').val();

      tmp = exercicio.inicial.split('-');
      tmp = retornaDiaSemZero(tmp);
      exercicio.inicial = tmp[0] + '-' + tmp[1] + '-' + tmp[2];

      dataObjetoInicial = new Date(exercicio.inicial);

      tmp = exercicio.final.split('-');
      tmp = retornaDiaSemZero(tmp);
      exercicio.final = tmp[0] + '-' + tmp[1] + '-' + tmp[2];

      dataObjetoFinal = new Date(exercicio.final);
      
      // calculando a quantidade de dias agendados
      exercicio.dia = 1000 * 60 * 60 * 24;
      exercicio.inicialMilisegundos = dataObjetoInicial.getTime();
      exercicio.finalMilisegundos = dataObjetoFinal.getTime();
      exercicio.quantidadeDias = exercicio.finalMilisegundos - exercicio.inicialMilisegundos;
      
      exercicio.quantidadeDias = Math.round(exercicio.quantidadeDias / exercicio.dia);

      // setando quantidade de dias no input text
      $('#total-dias-2').val(exercicio.quantidadeDias + ' Dias');
    } else {
      // setando valor default
      $('#data-inicial-2').val('');
      $('#data-final-2').val('');
      $('#total-dias-2').val('0 Dias');

      swal({
        title: 'Aviso',
        text: 'A data final do período não pode ultrapassar 30 dias antes da data limite!',
        icon: 'warning'
      });
    }
  });

  // validando período 3
  $(document).on('change', '#data-inicial-3', function(e) {
    e.preventDefault;

    var exercicio = {};

    exercicio.inicial = $('#data-inicial-3').val();    
    exercicio.periodo = $('#periodos').val();

    // verificando qual foi o período de férias selecionado pelo usuário
    switch (exercicio.periodo) {
      case '1':
        exercicio.dias = 30;
      break;

      case '2':
        exercicio.dias = 15;
      break;

      case '3':
        exercicio.dias = 10;
      break;
    }

    // separando data inicial pelo -
    var tmp = exercicio.inicial.split('-');

    // chamando função que retorna o dia do mês sem o 0
    tmp = retornaDiaSemZero(tmp);

    // setando data inicial no objeto
    exercicio.inicial = tmp[0] + '-' + tmp[1] + '-' + tmp[2];
    
    // criando objeto Date
    var date = new Date(exercicio.inicial);

    exercicio.diaDoMes = date.getDate();

    date.setDate(exercicio.diaDoMes + exercicio.dias);
    tmp = date.toISOString();
    tmp = tmp.split('T');

    exercicio.final = tmp[0];
    exercicio.vencimento = $('#data-final-3').prop('max');

    // verificando se a data final é menor que a data de vencimento com um mês a menos    
    if (exercicio.final <= exercicio.vencimento) {
      // setando a data final no campo input date
      $('#data-final-3').val(tmp[0]);

      // calculando quantidade de dias agendados pela diferença da data final e data inicial
      exercicio.inicial = $('#data-inicial-3').val();
      exercicio.final = $('#data-final-3').val();

      tmp = exercicio.inicial.split('-');
      tmp = retornaDiaSemZero(tmp);
      exercicio.inicial = tmp[0] + '-' + tmp[1] + '-' + tmp[2];

      dataObjetoInicial = new Date(exercicio.inicial);

      tmp = exercicio.final.split('-');
      tmp = retornaDiaSemZero(tmp);
      exercicio.final = tmp[0] + '-' + tmp[1] + '-' + tmp[2];

      dataObjetoFinal = new Date(exercicio.final);
      
      // calculando a quantidade de dias agendados
      exercicio.dia = 1000 * 60 * 60 * 24;
      exercicio.inicialMilisegundos = dataObjetoInicial.getTime();
      exercicio.finalMilisegundos = dataObjetoFinal.getTime();
      exercicio.quantidadeDias = exercicio.finalMilisegundos - exercicio.inicialMilisegundos;
      
      exercicio.quantidadeDias = Math.round(exercicio.quantidadeDias / exercicio.dia);

      // setando quantidade de dias no input text
      $('#total-dias-3').val(exercicio.quantidadeDias + ' Dias');
    } else {
      // setando valor default
      $('#data-inicial-3').val('');
      $('#data-final-3').val('');
      $('#total-dias-3').val('0 Dias');

      swal({
        title: 'Aviso',
        text: 'A data final do período não pode ultrapassar 30 dias antes da data limite!',
        icon: 'warning'
      });
    }
  });
});