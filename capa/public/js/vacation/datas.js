$(function() {
  // validando período 1
  $(document).on('change', '#data-inicial-1', function(e) {
    e.preventDefault;

    var exercicio = {};

    // recuperando o regime de trabalho do colaborador
    exercicio.regime = $('#regime').val();

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

      case '4':
        exercicio.dias = 10;        
      break;

      case '5':
        exercicio.dias = 20;        
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

    date.setDate(exercicio.diaDoMes + exercicio.dias - 1);
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
      $('#total-dias-1').val(exercicio.quantidadeDias + 1);
    } else {
      // setando valor default
      $('#data-inicial-1').val('');
      $('#data-final-1').val('');
      $('#total-dias-1').val('0');

      // verificando se o regime do colaborador é clt
      if (exercicio.regime == '1') {
        swal({
          title: 'Aviso',
          text: 'A data final do período não pode ultrapassar 30 dias da data limite!',
          icon: 'warning'
        });
      // verificando se o regime do colaborador é estágio
      } else if (exercicio.regime == '2') {
        swal({
          title: 'Aviso',
          text: 'A data final do período não pode ultrapassar 30 dias da data limite!',
          icon: 'warning'
        });
      }
    }
  });

  // alterando o valor mínimo da data inicial do período 2 de acordo com a data final do período 1
  $(document).on('click', '#data-inicial-2', function(e) {
    e.preventDefault;

    var linha1 = {};

    linha1.dataInicial = $('.row #linha-1 #data-inicial-1').val();
    linha1.dataFinal   = $('.row #linha-1 #data-final-1').val();

    // verificando se o período 1 foi preenchido
    if (linha1.dataInicial != '' && linha1.dataFinal != '') {
      linha1.data = new Date(linha1.dataFinal);
      
      linha1.dia = linha1.data.getDate();
      linha1.data.setDate(linha1.dia + 1);

      linha1.tmp = linha1.data.toISOString();
      linha1.tmp = linha1.tmp.split('T');

      // setando data mínima de acorodo com a data final do período 1
      $('#data-inicial-2').prop('min', linha1.tmp[0]);
    }
  });

  // validando período 2
  $(document).on('change', '#data-inicial-2', function(e) {
    e.preventDefault;

    var linha1 = {};

    linha1.dataInicial = $('.row #linha-1 #data-inicial-1').val();
    linha1.dataFinal   = $('.row #linha-1 #data-final-1').val();
    
    // verificando se as datas do período 1 foram preenchidas
    if (linha1.dataInicial == '' || linha1.dataFinal == '') {
      // adicionando classe erro
      $('.row #linha-1 #data-inicial-1').addClass('erro');

      // setando valor default
      $('#data-inicial-2').val('');

      swal({
        title: 'Aviso',
        text: 'Preencha a data inicial do período 1 antes de continuar!',
        icon: 'warning'
      });
    } else {
      // removendo classe erro
      $('.row #linha-1 #data-inicial-1').removeClass('erro');

      var exercicio = {};

      // recuperando o regime de trabalho do colaborador
      exercicio.regime = $('#regime').val();

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

        case '4':
          exercicio.dias = 20;        
        break;

        case '5':
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

      date.setDate(exercicio.diaDoMes + exercicio.dias - 1);
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
        $('#total-dias-2').val(exercicio.quantidadeDias + 1);
      } else {
        // setando valor default
        $('#data-inicial-2').val('');
        $('#data-final-2').val('');
        $('#total-dias-2').val('0');

        // verificando se o regime do colaborador é clt
        if (exercicio.regime == '1') {
          swal({
            title: 'Aviso',
            text: 'A data final do período não pode ultrapassar 30 dias da data limite!',
            icon: 'warning'
          });
        // verificando se o regime do colaborador é estágio
        } else if (exercicio.regime == '2') {
          swal({
            title: 'Aviso',
            text: 'A data final do período não pode ultrapassar 30 dias da data limite!',
            icon: 'warning'
          });
        }
      }
    }    
  });

  // alterando o valor mínimo da data inicial do período 3 de acordo com a data final do período 2
  $(document).on('click', '#data-inicial-3', function(e) {
    e.preventDefault;

    var linha2 = {};

    linha2.dataInicial = $('.row #linha-2 #data-inicial-2').val();
    linha2.dataFinal   = $('.row #linha-2 #data-final-2').val();

    linha2.data = new Date(linha2.dataFinal);
      
    linha2.dia = linha2.data.getDate();
    linha2.data.setDate(linha2.dia + 1);

    linha2.tmp = linha2.data.toISOString();
    linha2.tmp = linha2.tmp.split('T');

    // setando data mínima de acorodo com a data final do período 2
    $('#data-inicial-3').prop('min', linha2.tmp[0]);
  });

  // validando período 3
  $(document).on('change', '#data-inicial-3', function(e) {
    e.preventDefault;

    var linha1 = {};
    var linha2 = {};

    linha1.dataInicial = $('.row #linha-1 #data-inicial-1').val();
    linha1.dataFinal   = $('.row #linha-1 #data-final-1').val();

    linha2.dataInicial = $('.row #linha-2 #data-inicial-2').val();
    linha2.dataFinal   = $('.row #linha-2 #data-final-2').val();
    
    // verificando se as datas do período 1 foram preenchidas
    if (linha1.dataInicial == '' || linha1.dataFinal == '') {
      // adicionando classe erro
      $('.row #linha-1 #data-inicial-1').addClass('erro');

      // setando valor default
      $('#data-inicial-3').val('');

      swal({
        title: 'Aviso',
        text: 'Preencha a data inicial do período 1 antes de continuar!',
        icon: 'warning'
      });
    } else if (linha2.dataInicial == '' || linha2.dataFinal == '') {
      // adicionando classe erro
      $('.row #linha-2 #data-inicial-2').addClass('erro');

      // setando valor default
      $('#data-inicial-3').val('');

      swal({
        title: 'Aviso',
        text: 'Preencha a data inicial do período 2 antes de continuar!',
        icon: 'warning'
      });
    } else {
      // removendo classe erro
      $('.row #linha-1 #data-inicial-1').removeClass('erro');
      $('.row #linha-2 #data-inicial-2').removeClass('erro');

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

      date.setDate(exercicio.diaDoMes + exercicio.dias - 1);
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
        $('#total-dias-3').val(exercicio.quantidadeDias + 1);
      } else {
        // setando valor default
        $('#data-inicial-3').val('');
        $('#data-final-3').val('');
        $('#total-dias-3').val('0');

        swal({
          title: 'Aviso',
          text: 'A data final do período não pode ultrapassar 30 dias da data limite!',
          icon: 'warning'
        });
      }
    }    
  });

  // validando período 4
  $(document).on('change', '#data-inicial-4', function(e) {
    e.preventDefault;

    var exercicio = {};

    // recuperando o regime de trabalho do colaborador
    exercicio.regime = $('#regime').val();

    exercicio.inicial = $('#data-inicial-4').val();    
    exercicio.periodo = $('#periodos').val();

    // verificando qual foi o período de férias selecionado pelo usuário
    switch (exercicio.periodo) {
      case '6':
        exercicio.dias = 15;
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

    date.setDate(exercicio.diaDoMes + exercicio.dias - 1);
    tmp = date.toISOString();
    tmp = tmp.split('T');

    exercicio.final = tmp[0];
    exercicio.vencimento = $('#data-final-4').prop('max');

    // verificando se a data final é menor que a data de vencimento com um mês a menos    
    if (exercicio.final <= exercicio.vencimento) {
      // setando a data final no campo input date
      $('#data-final-4').val(tmp[0]);

      // calculando quantidade de dias agendados pela diferença da data final e data inicial
      exercicio.inicial = $('#data-inicial-4').val();
      exercicio.final = $('#data-final-4').val();

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
      $('#total-dias-4').val(exercicio.quantidadeDias + 1);
    } else {
      // setando valor default
      $('#data-inicial-4').val('');
      $('#data-final-4').val('');
      $('#total-dias-4').val('0');

      // verificando se o regime do colaborador é clt
      if (exercicio.regime == '1') {
        swal({
          title: 'Aviso',
          text: 'A data final do período não pode ultrapassar 30 dias da data limite!',
          icon: 'warning'
        });
      // verificando se o regime do colaborador é estágio
      } else if (exercicio.regime == '2') {
        swal({
          title: 'Aviso',
          text: 'A data final do período não pode ultrapassar 30 dias da data limite!',
          icon: 'warning'
        });
      }
    }
  });
});