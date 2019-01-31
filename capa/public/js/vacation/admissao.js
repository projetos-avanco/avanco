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
      success: function(admissao) {
        if (admissao !== null) {
          var data = new Date();

          var exercicio = {
            'inicial': '',
            'final': '',
            'vencimento': '',
            'tmp': '',
            'anoAdmissao': '',              
            'anoAtual': data.getFullYear() - 1
          };
          
          // dividindo data em array para recuperar o exercício inicial
          exercicio.tmp = admissao.split('-');
          exercicio.anoAdmissao = parseInt(exercicio.tmp[0]);

          // verificando se o ano de admissão é igual ao ano atual
          if (exercicio.anoAdmissao == exercicio.anoAtual) {
            exercicio.inicial = admissao;
            
            // dividindo a data de admissão em array para recuperar o exercício final
            exercicio.tmp = admissao.split('-');
            exercicio.tmp[0] = parseInt(exercicio.tmp[0]) + 1;
            exercicio.final = formataData(exercicio.tmp);
            
            // dividindo data de admissão em array para recuperar o vencimento
            exercicio.tmp = admissao.split('-');
            exercicio.tmp[0] = parseInt(exercicio.tmp[0]) + 2;

            // verificando se o mês é janeiro
            if (exercicio.tmp[1] == '01') {
              exercicio.tmp[1] = '12';
              exercicio.tmp[0] = exercicio.tmp[0] - 1;
            } else {
              exercicio.tmp[1] = parseInt(exercicio.tmp[1]) - 1;
            }
            
            // verificando se o mês está entre janeiro e setembro
            if (exercicio.tmp[1] <= 9) {
              exercicio.tmp[1] = '0' + exercicio.tmp[1];
            }

            exercicio.vencimento = formataData(exercicio.tmp);

            // verificando se o ano de admissão é menor do que o ano atual
          } else if (exercicio.anoAdmissao < exercicio.anoAtual) {
            exercicio.tmp[0] = exercicio.anoAtual;
            exercicio.inicial = formataData(exercicio.tmp);

            // dividindo a data de admissão em array para recuperar o exercício final
            exercicio.tmp = admissao.split('-');
            exercicio.tmp[0] = exercicio.anoAtual + 1;
            exercicio.final = formataData(exercicio.tmp);

            // dividindo data de admissão em array para recuperar o vencimento
            exercicio.tmp = admissao.split('-');
            exercicio.tmp[0] = exercicio.anoAtual + 2;

            // verificando se o mês é janeiro
            if (exercicio.tmp[1] == '01') {
              exercicio.tmp[1] = '12';
              exercicio.tmp[0] = exercicio.tmp[0] - 1;
            } else {
              exercicio.tmp[1] = parseInt(exercicio.tmp[1]) - 1;
            }

            // verificando se o mês está entre janeiro e setembro
            if (exercicio.tmp[1] <= 9) {
              exercicio.tmp[1] = '0' + exercicio.tmp[1];
            }

            exercicio.vencimento = formataData(exercicio.tmp);

            // verificando se o ano de admissão é maior do que o ano atual
          } else if (exercicio.anoAdmissao > exercicio.anoAtual) {
            exercicio.tmp[0] = exercicio.anoAdmissao;
            exercicio.inicial = formataData(exercicio.tmp);

            // dividindo a data de admissão em array para recuperar o exercício final
            exercicio.tmp = admissao.split('-');
            exercicio.tmp[0] = parseInt(exercicio.tmp[0]) + 1;
            exercicio.final = formataData(exercicio.tmp);
            
            // dividindo data de admissão em array para recuperar o vencimento
            exercicio.tmp = admissao.split('-');
            exercicio.tmp[0] = parseInt(exercicio.tmp[0]) + 2;

            // verificando se o mês é janeiro
            if (exercicio.tmp[1] == '01') {
              exercicio.tmp[1] = '12';
              exercicio.tmp[0] = exercicio.tmp[0] - 1;
            } else {
              exercicio.tmp[1] = parseInt(exercicio.tmp[1]) - 1;
            }
            
            // verificando se o mês está entre janeiro e setembro
            if (exercicio.tmp[1] <= 9) {
              exercicio.tmp[1] = '0' + exercicio.tmp[1];
            }

            exercicio.vencimento = formataData(exercicio.tmp);
          }

          $('#inicial').val(exercicio.inicial);
          $('#final').val(exercicio.final);
          $('#vencimento').val(exercicio.vencimento);
        } else {
          $('#inicial').val('');
          $('#final').val('');
          $('#vencimento').val('');              
        }          
      },
      error: function(admissao) {
        console.log(admissao);
      }
    });
  });
});