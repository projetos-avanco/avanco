$(function() {
  $(document).on('change', '#colaborador', function(e) {
    e.preventDefault;

    var id = $('#colaborador').val();

    $.ajax({
      type: 'post',
      url: '../../../app/requests/post/vacation/recebe_exercicio.php',
      dataType: 'json',
      data: {
        id: id
      },
      success: function(dados) {
        var data = new Date();

        var exercicio = {
          'inicial': '',
          'final': '',
          'vencimento': '',
          'dia': 0,
          'tmp': '',
          'anoAdmissao': '',              
          'anoAtual': data.getFullYear() - 1
        };

        // setando valor default
        $('#inicial').val('');
        $('#final').val('');
        $('#vencimento').val('');

        // setando regime no html
        $('#regime').val(dados.regime);

        // verificando se o regime do colaborador é clt
        if (dados.regime === '1') {
          $('#contrato div').remove();

          // dividindo data em array para recuperar o exercício inicial
          exercicio.tmp = dados.admissao.split('-');
          exercicio.anoAdmissao = parseInt(exercicio.tmp[0]);

          // verificando se o ano de admissão é igual ao ano atual
          if (exercicio.anoAdmissao == exercicio.anoAtual) {
            exercicio.inicial = dados.admissao;
            
            // dividindo a data de admissão em array para recuperar o exercício final
            exercicio.tmp = dados.admissao.split('-');
            exercicio.tmp[0] = parseInt(exercicio.tmp[0]) + 1;
            exercicio.final = formataData(exercicio.tmp);
            
            // dividindo data de admissão em array para recuperar o vencimento
            exercicio.tmp = dados.admissao.split('-');
            exercicio.tmp[0] = parseInt(exercicio.tmp[0]) + 2;

            exercicio.vencimento = formataData(exercicio.tmp);

            // verificando se o ano de admissão é menor do que o ano atual
          } else if (exercicio.anoAdmissao < exercicio.anoAtual) {
            exercicio.tmp[0] = exercicio.anoAtual;
            exercicio.inicial = formataData(exercicio.tmp);

            // dividindo a data de admissão em array para recuperar o exercício final
            exercicio.tmp = dados.admissao.split('-');
            exercicio.tmp[0] = exercicio.anoAtual + 1;
            exercicio.final = formataData(exercicio.tmp);

            // dividindo data de admissão em array para recuperar o vencimento
            exercicio.tmp = dados.admissao.split('-');
            exercicio.tmp[0] = exercicio.anoAtual + 2;

            exercicio.vencimento = formataData(exercicio.tmp);

            // verificando se o ano de admissão é maior do que o ano atual
          } else if (exercicio.anoAdmissao > exercicio.anoAtual) {
            exercicio.tmp[0] = exercicio.anoAdmissao;
            exercicio.inicial = formataData(exercicio.tmp);

            // dividindo a data de admissão em array para recuperar o exercício final
            exercicio.tmp = dados.admissao.split('-');
            exercicio.tmp[0] = parseInt(exercicio.tmp[0]) + 1;
            exercicio.final = formataData(exercicio.tmp);
            
            // dividindo data de admissão em array para recuperar o vencimento
            exercicio.tmp = dados.admissao.split('-');
            exercicio.tmp[0] = parseInt(exercicio.tmp[0]) + 2;

            exercicio.vencimento = formataData(exercicio.tmp);
          }

          $('#inicial').val(exercicio.inicial);
          $('#final').val(exercicio.final);
          $('#vencimento').val(exercicio.vencimento);
        // verificando se o regime do colaborador é estágio
        } else if (dados.regime === '2') {
          var alerta = '';

          // verificando se o tipo de contrato é semestral
          if (dados.contrato === '1') {
            // dividindo data em array para recuperar o exercício inicial
            exercicio.tmp = dados.admissao.split('-');
            exercicio.anoAdmissao = parseInt(exercicio.tmp[0]);

            exercicio.inicial = dados.admissao;

            data = new Date(exercicio.inicial);

            exercicio.dia = data.getDate();

            // adicionando 182 dias a partir da data inicial (6 meses)
            data.setDate(exercicio.dia + 182);

            // dividindo a data de admissão em array para recuperar o exercício final
            exercicio.tmp = data.toISOString();
            exercicio.tmp = exercicio.tmp.split('T');
            exercicio.final = exercicio.tmp[0];

            // vencimento é a mesmo valor que a data final
            exercicio.vencimento = exercicio.tmp[0];

            $('#inicial').val(exercicio.inicial);
            $('#final').val(exercicio.final);
            $('#vencimento').val(exercicio.vencimento);

            alerta +=
              '<div class="alert alert-warning" role="alert" style="margin-bottom: 0px">' +
                '<strong>Aviso!</strong> O tipo de contrato do estagiário(a) é <strong>semestral</strong>.' +
              '</div>';

            $('#contrato').html(alerta);
          // verificando se o tipo de contrato é anual
          } else {
            
            // dividindo data em array para recuperar o exercício inicial
            exercicio.tmp = dados.admissao.split('-');
            exercicio.anoAdmissao = parseInt(exercicio.tmp[0]);

            // verificando se o ano de admissão é igual ao ano atual
            if (exercicio.anoAdmissao == exercicio.anoAtual) {
              exercicio.inicial = dados.admissao;

              data = new Date(exercicio.inicial);

              exercicio.dia = data.getDate();

              // adicionando 182 dias a partir da data inicial (6 meses)
              data.setDate(exercicio.dia + 365);

              // dividindo a data de admissão em array para recuperar o exercício final
              exercicio.tmp = data.toISOString();
              exercicio.tmp = exercicio.tmp.split('T');
              exercicio.final = exercicio.tmp[0];

              // vencimento é o mesmo valor que a data final
              exercicio.vencimento = exercicio.final;

              // verificando se o ano de admissão é menor do que o ano atual
            } else if (exercicio.anoAdmissao < exercicio.anoAtual) {
              exercicio.tmp[0] = exercicio.anoAtual;
              exercicio.inicial = formataData(exercicio.tmp);

              data = new Date(exercicio.inicial);

              exercicio.dia = data.getDate();

              // adicionando 182 dias a partir da data inicial (6 meses)
              data.setDate(exercicio.dia + 365);

              // dividindo a data de admissão em array para recuperar o exercício final
              exercicio.tmp = data.toISOString();
              exercicio.tmp = exercicio.tmp.split('T');
              exercicio.final = exercicio.tmp[0];

              data = new Date(exercicio.final);

              exercicio.dia = data.getDate();

              // retirando 30 dias a partir da data final (1 meses)
              data.setDate(exercicio.dia - 30);
              
              // dividindo data de admissão em array para recuperar o vencimento
              exercicio.tmp = data.toISOString();
              exercicio.tmp = exercicio.tmp.split('T');
              exercicio.vencimento = exercicio.tmp[0];

              // verificando se o ano de admissão é maior do que o ano atual
            } else if (exercicio.anoAdmissao > exercicio.anoAtual) {
              exercicio.tmp[0] = exercicio.anoAdmissao;
              exercicio.inicial = formataData(exercicio.tmp);

              data = new Date(exercicio.inicial);

              exercicio.dia = data.getDate();

              // adicionando 182 dias a partir da data inicial (6 meses)
              data.setDate(exercicio.dia + 365);

              // dividindo a data de admissão em array para recuperar o exercício final
              exercicio.tmp = data.toISOString();
              exercicio.tmp = exercicio.tmp.split('T');
              exercicio.final = exercicio.tmp[0];

              data = new Date(exercicio.final);

              exercicio.dia = data.getDate();

              // retirando 30 dias a partir da data final (1 meses)
              //data.setDate(exercicio.dia - 30);
              
              // dividindo data de admissão em array para recuperar o vencimento
              exercicio.tmp = data.toISOString();
              exercicio.tmp = exercicio.tmp.split('T');
              exercicio.vencimento = exercicio.tmp[0];
            }

            $('#inicial').val(exercicio.inicial);
            $('#final').val(exercicio.final);
            $('#vencimento').val(exercicio.vencimento);

            alerta +=
              '<div class="alert alert-warning" role="alert" style="margin-bottom: 0px">' +
                '<strong>Aviso!</strong> O tipo de contrato do estagiário(a) é <strong>anual</strong>.' +
              '</div>';

            $('#contrato').html(alerta);
          }
        }
      },
      error: function(admissao) {
        console.log(admissao);
      }
    });
  });
});