$('document').ready(function() {

  $('form').submit(function() {

    var contador = 0;

    $('input.required').each(function() {

      if ($(this).val() == '') {

        $(this).addClass('erro');

        contador = 1;

      } else {

        $(this).removeClass('erro');

      }

    });

    $('select.required').each(function() {

      if ($(this).val() == '0') {

        $(this).addClass('erro');

        contador = 1;

      } else {

        $(this).removeClass('erro');

      }

    });

    $('textarea.required').each(function() {

      if ($(this).val() == '') {

        $(this).addClass('erro');

        contador = 1;

      } else {

        $(this).removeClass('erro');

      }

    });

    // verificando se foi selecionado uma empresa
    if ($('#id').val() == '') {

      contador = 1;

      alert('Por favor, Selecione uma Empresa!');

    }

    // verificando se foi selecionado um contato
    if ($('#id-contato').val() == '') {

      contador = 1;

      alert('Por favor, Selecione um Contato!');

    }

    // verificando se foi selecionado a resposta para a pergunta, pedido faturado?
    if ($('#faturado').val() == '0') {

      contador = 1;

    } else if ($('#faturado').val() == '1') {

      // verificando se foi selecionado o tipo de cobrança
      if ($('#cobranca').val() == '0') {

        contador = 1;

        alert('Por favor, informe se o tipo de cobrança do pedido é por hora ou pacote!');

      } else if ($('#cobranca').val() == '1' || $('#cobranca').val() == '2') {

          // verificando se o valor da cobrança é 0 ou menor que 0
          if ($('#valor').val() <= '0.00') {

          $('#valor').addClass('erro');

          contador = 1;

          alert('Por favor, informe o valor a ser cobrado!');

        }

      }

    } else if ($('#faturado').val() == '2') {

      $('#cobranca').removeClass('required erro');

      $('#valor').removeClass('required erro');
      
    }

    if (contador > 0) {

      alert('Por favor, Preencha os campos em destaque!')

      return false;
    }

  });

});
