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
            'anoAtual': data.getFullYear()
          };

          exercicio.tmp = admissao.split('-');
          exercicio.anoAdmissao = parseInt(exercicio.tmp[0]);

          if (exercicio.anoAdmissao == exercicio.anoAtual) {
            exercicio.inicial = admissao;
                          
            exercicio.tmp = admissao.split('-');
            exercicio.tmp[0] = parseInt(exercicio.tmp[0]) + 1;
            exercicio.final = formataData(exercicio.tmp);
            
            exercicio.tmp = admissao.split('-');
            exercicio.tmp[0] = parseInt(exercicio.tmp[0]) + 2;

            if (exercicio.tmp[1] == '01') {
              exercicio.tmp[1] = '12';
            }

            exercicio.tmp[1] = parseInt(exercicio.tmp[1]) - 1;

            if (exercicio.tmp[1] <= 9) {
              exercicio.tmp[1] = '0' + exercicio.tmp[1];
            }

            exercicio.vencimento = formataData(exercicio.tmp);
          } else if (exercicio.anoAdmissao < exercicio.anoAtual) {
            exercicio.tmp[0] = exercicio.anoAtual;
            exercicio.inicial = formataData(exercicio.tmp);

            exercicio.tmp = admissao.split('-');
            exercicio.tmp[0] = exercicio.anoAtual + 1;
            exercicio.final = formataData(exercicio.tmp);

            exercicio.tmp = admissao.split('-');
            exercicio.tmp[0] = exercicio.anoAtual + 2;

            if (exercicio.tmp[1] == '01') {
              exercicio.tmp[1] = '12';
            }

            exercicio.tmp[1] = parseInt(exercicio.tmp[1]) - 1;

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