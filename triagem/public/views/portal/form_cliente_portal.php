<?php require '../../../init.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Formulário de Teste</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <style media="screen">
    body {
      margin: 20px 0 0 0;
    }
  </style>
</head>

<body>

  <div class="container">
    <form class="form-inline" action="<?php echo BASE_URL; ?>app/requests/post/recebe_cliente_portal.php" method="post">
      <div class="row">
        <div class="col-sm-2">
          <div class="form-group">
            <label class="sr-only" for="nome">Nome: </label>
            <input type="text" id="nome" name="cliente[nome]" value="Marlene">
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label class="sr-only" for="nome_usuario">Nome de Usuário: </label>
            <input type="text" id="nome_usuario" name="cliente[nome_usuario]" value="MarleneAdmin">
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label class="sr-only" for="cnpj">CNPJ: </label>
            <input type="text" id="cnpj" name="cliente[cnpj]" value="71385637000191">
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label class="sr-only" for="conta_contrato">Conta Contrato: </label>
            <input type="text" id="conta_contrato" name="cliente[conta_contrato]" value="0000109">
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label class="sr-only" for="razao_social">Razão Social: </label>
            <input type="text" id="razao_social" name="cliente[razao_social]" value="SUPERMERCADO SUPER LUNA	
">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-2">
          <div class="form-group">
            <label class="form-control" for="telefone">Telefone: </label>
            <input type="text" id="telefone" name="cliente[telefone]" value="(31) 3322-8563">
          </div>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="col-sm-12">
          <select class="form-control" id="produto" name="cliente[produto]">
            <option value="0" selected>Selecione um Produto</option>
            <option value="1">Integral</option>
            <option value="2">Frente de Loja</option>
            <option value="3">Gestor</option>
            <option value="4">Novo ERP</option>
            <option value="5">Tecnologia</option>
          </select>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="col-sm-12">
          <select class="form-control" id="modulo" name="cliente[modulo]">
            <option value="0" selected>Selecione um Módulo</option>
          </select>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label class="sr-only" for="duvida">Dúvida: </label>
            <input type="text" id="duvida" name="cliente[duvida]" placeholder="Dúvida" required>
          </div>
        </div>
      </div>

      <br>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default" id="enviar">Enviar</button>
        </div>
      </div>
    </form>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <script type="text/javascript">
    $('document').ready(function() {

      $('#nome').hide();
      $('#nome_usuario').hide();
      $('#cnpj').hide();
      $('#conta_contrato').hide();
      $('#razao_social').hide();

      $('#produto').change(function() {

        var produto = $('#produto').val();

        if (produto == '5') {

          $('#modulo').hide();

        } else {

          if ($('#modulo').hide()) {

            $('#modulo').show();

          }

        }

        switch (produto) {

          case '0':

            $('#modulo').html('<option value="0">Selecione um Módulo</option>');

            break;

          case '1':

            var integral =
              '<option value="1">Materiais</option>'  +
              '<option value="2">Fiscal</option>'     +
              '<option value="3">Financeiro</option>' +
              '<option value="4">Contábil</option>'   +
              '<option value="5">Cotação</option>'    +
              '<option value="6">TNFE</option>'       +
              '<option value="7">WMS</option>';

            $('#modulo').html(integral);

            break;

          case '2':

            var frente =
              '<option value="8">Frente Windows</option>' +
              '<option value="9">Frente Linux</option>'   +
              '<option value="10">Supervisor</option>'    +
              '<option value="11">Scanntech</option>'     +
              '<option value="12">Sitef</option>'         +
              '<option value="13">Comandas</option>';

            $('#modulo').html(frente);

            break;

          case '3':

            var gestor =
              '<option value="14">Instalação</option>' +
              '<option value="15">Cadastro</option>'   +
              '<option value="16">Movimento</option>'  +
              '<option value="17">Contábil</option>'   +
              '<option value="18">Fiscal</option>';

            $('#modulo').html(gestor);

            break;

            case '4':

              var erp =
                '<option value="19">Pessoas</option>'                    +
                '<option value="20">Produtos</option>'                   +
                '<option value="21">Fiscal</option>'                     +
                '<option value="22">Financeiro</option>'                 +
                '<option value="23">Relatórios e Gráficos</option>'      +
                '<option value="24">Lançamentos</option>'                +
                '<option value="25">Importação e Exportações</option>'   +
                '<option value="26">Configurações PDV</option>'          +
                '<option value="27">Poynt</option>';

              $('#modulo').html(erp);

              break;

        }

      });

      $('#novo_erp').change(function() {

        var checkbox = $('#novo_erp').val();

        if (checkbox == 'on') {

          $('#produto').val('4');

          var erp =
            '<option value="19">Pessoas</option>'                    +
            '<option value="20">Produtos</option>'                   +
            '<option value="21">Fiscal</option>'                     +
            '<option value="22">Financeiro</option>'                 +
            '<option value="23">Relatórios e Gráficos</option>'      +
            '<option value="24">Lançamentos</option>'                +
            '<option value="25">Importação e Exportações</option>'   +
            '<option value="26">Configurações PDV</option>'          +
            '<option value="27">Poynt</option>';

          $('#modulo').html(erp);

        } else {

          $('#produto').val('0');

        }

      });

      $('#enviar').click(function() {

        if ($('#duvida').val() == '') {

          alert('O campo dúvida deve ser preenchido!');

        }

      });

    });
  </script>

</body>
</html>
