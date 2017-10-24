$('document').ready(function() {

  $('#produto').change(function() {

    var valor = $('#produto').val();

    switch (valor) {
      case '0':

        $('#modulo').html('<option value="0">Selecione um Módulo</option>');

          break;

      case '1':

        var opcoes =
          '<option value="1">Materiais</option>'  +
          '<option value="2">Fiscal</option>'     +
          '<option value="3">Financeiro</option>' +
          '<option value="4">Contábil</option>'   +
          '<option value="5">Cotação</option>'    +
          '<option value="6">TNFE</option>'       +
          '<option value="7">WMS</option>';

        $('#modulo').html(opcoes);

          break;

      case '2':

        var opcoes =
          '<option value="8">Frente Windows</option>' +
          '<option value="9">Frente Linux</option>'   +
          '<option value="10">Supervisor</option>'    +
          '<option value="11">Scanntech</option>'     +
          '<option value="12">Sitef</option>'         +
          '<option value="13">Comandas</option>';

        $('#modulo').html(opcoes);

          break;

      case '3':

        var opcoes =
          '<option value="14">Instalação</option>' +
          '<option value="15">Cadastro</option>'   +
          '<option value="16">Movimento</option>'  +
          '<option value="17">Contábil</option>'   +
          '<option value="18">Fiscal</option>';

        $('#modulo').html(opcoes);

          break;

      case '4':

        var opcoes =
          '<option value="19">Pessoas</option>'                    +
          '<option value="20">Produtos</option>'                   +
          '<option value="21">Fiscal</option>'                     +
          '<option value="22">Financeiro</option>'                 +
          '<option value="23">Relatórios e Gráficos</option>'      +
          '<option value="24">Lançamentos</option>'                +
          '<option value="25">Importação e Exportações</option>'   +
          '<option value="26">Configurações PDV</option>'          +
          '<option value="27">Poynt</option>';

        $('#modulo').html(opcoes);

          break;
    }

  });

});
