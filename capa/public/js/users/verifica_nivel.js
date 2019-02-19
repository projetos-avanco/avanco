$(function () {
  $(document).on('change', '#nivel', function (e) {
    e.preventDefault;

    var id = $('#nivel').val();

    // verificando se o usuário selecionou a opção administrador
    if (id == '2') {
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
    } else if (id == '3') {
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
      $('#bloco-contrato').prop('disabled', false);
    } else if (id == '1') {
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
      $('#bloco-contrato').prop('disabled', true);
    }
  });
});