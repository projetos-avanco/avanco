$(function () {
  $(document).on('change', '#colaborador', function (e) {
    e.preventDefault;

    var idChat = $(this).val();

    // percorrendo todos os checkboxers da lista de eventos
    $('input:checkbox').each(function () {
      // desmarcando todos os checkboxers 
      $(this).prop('checked', false)
    });

    $.ajax({
      type: 'get',
      url: '../../../app/requests/get/users/recebe_id_chat.php',
      dataType: 'json',
      data: {
        id: idChat
      },
      success: function (dados) {
        $('#id-portal').val(dados.portal.id);
        $('#nome').val(dados.portal.nome);
        $('#sobrenome').val(dados.portal.sobrenome);
        $('#senha').prop('disabled', false);
        $('#repita-senha').prop('disabled', false);

        $('#nivel').prop('disabled', false).val(dados.portal.nivel);
        $('#data-admissao').prop('disabled', false).val(dados.portal.admissao);
        $('#ramal').prop('disabled', false).val(dados.portal.ramal);

        // verificando se o nível de usuário é suporte
        if (dados.portal.nivel === '1') {
          $('#time').val(dados.time);

          // percorrendo todas as posições do array
          for (var i = 0; i < dados.especialidades.length; i++) {
            // marcando os conhecimentos do usuário
            $('#' + dados.especialidades[i]).prop('checked', true);
          }

          // removendo a classe disabled dos checkboxes
          $('.checkbox').removeClass('disabled');

          // removendo atributo disabled dos inputs checkboxes
          $('input:checkbox').prop('disabled', false);

          // removendo atributo disabled do select de times
          $('#time').prop('disabled', false);

          // removendo atributo disabled do input file
          $('#foto').prop('disabled', false);

          // ocultando bloco de contrato de estagiário
          $('#bloco-contrato').addClass('hidden');
          $('#contrato').prop('disabled', true);
        } else if (dados.portal.nivel === '2') {
          // adicionando classe disabled nos checkboxes
          $('.checkbox').addClass('disabled');

          // adicionando atributo disabled nos inputs checkboxes
          $('input:checkbox').prop('disabled', 'disabled');

          // percorrendo e desmarcando todos os checkboxes que estiverem marcados
          $('input:checkbox').each(function () {
            $(this).prop('checked', false);
          });

          // adicionando atributo disabled no select de times
          $('#time').prop('disabled', 'disabled');

          // percorrendo options do select de times
          $('#time option').each(function () {
            // adicionando o atributo selected no option de valor 1, nos outros, retirando o selected
            if ($(this).val() == 1) {
              $(this).prop('selected', true);
            } else {
              $(this).prop('selected', false);
            }
          });

          // adicionando o atributo disabled do input file
          $('#foto').prop('disabled', true);
          $('#foto').val('');

          // ocultando bloco de contrato de estagiário
          $('#bloco-contrato').addClass('hidden');
          $('#bloco-contrato').prop('disabled', true);
        } else if (dados.portal.nivel === '3') {
          $('#time').val(dados.time);
          $('#bloco-contrato').removeClass('hidden');
          $('#contrato').prop('disabled', false).val(dados.portal.contrato);

          // percorrendo todas as posições do array
          for (var i = 0; i < dados.especialidades.length; i++) {
            // marcando os conhecimentos do usuário
            $('#' + dados.especialidades[i]).prop('checked', true);
          }

          // removendo a classe disabled dos checkboxes
          $('.checkbox').removeClass('disabled');

          // removendo atributo disabled dos inputs checkboxes
          $('input:checkbox').prop('disabled', false);

          // removendo atributo disabled do select de times
          $('#time').prop('disabled', false);

          // removendo atributo disabled do input file
          $('#foto').prop('disabled', false);

          // exibindo bloco de contrato de estagiário
          $('#bloco-contrato').removeClass('hidden');
          $('#contrato').prop('disabled', false);
        }
      },
      error: function (dados) {
        console.log(dados);
      }
    });
  });
});