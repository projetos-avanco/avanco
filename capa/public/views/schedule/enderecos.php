<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('enderecos.php')) : ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Cadastro de Endereços</title>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap_3.3.7.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/fontes.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/home.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/sidebar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbar.css">

  <!-- dispositivos com largura máxima de 769px (por exemplo tablets) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbartablet.css" type="text/css" media="screen and (max-width: 769px)" />
  <!-- dispositivos com largura máxima de 450px (por exemplo smartphones) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbarsmart.css" type="text/css" media="screen and (max-width:450px)" />

  <style>
    .erro {
      border: 2px solid red;
    }
  </style>
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <h2>Cadastro de Endereços</h2>

            <hr>
          </div>
        </div><!-- linha -->

        <br>

        <form action="<?php echo BASE_URL; ?>app/requests/post/recebe_endereco.php" method="post">

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label class="sr-only" for="logradouro">Logradouro</label>
                <input class="form-control" id="logradouro" type="text" name="endereco[logradouro]" maxlength="100" placeholder="Avenida">
              </div>
            </div>
          </div><!-- linha -->

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="sr-only" for="distrito">Bairro</label>
                <input class="form-control" id="distrito" type="text" name="endereco[distrito]" maxlength="100" placeholder="Bairro">
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label class="sr-only" for="localidade">Cidade</label>
                <input class="form-control" id="localidade" type="text" name="endereco[localidade]" maxlength="100" placeholder="Cidade">
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                <label class="sr-only" for="uf">Estado</label>

                <select class="form-control" id="uf" name="endereco[uf]">
                  <option value="0" selected>Estado</option>

                  <optgroup label="Região Norte">
                    <option value="1">Acre (AC)</option>
                    <option value="2">Amapá (AP)</option>
                    <option value="3">Amazonas (AM)</option>
                    <option value="4">Pará (PA)</option>
                    <option value="5">Rondônia (RO)</option>
                    <option value="6">Roraima (RR)</option>
                    <option value="7">Tocantins (TO)</option>
                  </optgroup>

                  <optgroup label="Região Nordeste">
                    <option value="8">Alagoas (AL)</option>
                    <option value="9">Bahia (BA)</option>
                    <option value="10">Ceará (CE)</option>
                    <option value="11">Maranhão (MA)</option>
                    <option value="12">Paraíba (PB)</option>
                    <option value="13">Pernambuco (PE)</option>
                    <option value="14">Piauí (PI)</option>
                    <option value="15">Rio Grande do Norte (RN)</option>
                    <option value="16">Sergipe (SE)</option>
                  </optgroup>

                  <optgroup label="Região Centro-Oeste">
                    <option value="17">Brasília (DF)</option>
                    <option value="18">Goiás (GO)</option>
                    <option value="19">Mato Grosso (MT)</option>
                    <option value="20">Mato Grosso do Sul (MS)</option>
                  </optgroup>

                  <optgroup label="Região Sudeste">
                    <option value="21">Espiríto Santo (ES)</option>
                    <option value="22">Minas Gerais (MG)</option>
                    <option value="23">Rio de Janeiro (RJ)</option>
                    <option value="24">São Paulo (SP)</option>
                  </optgroup>

                  <optgroup label="Região Sul">
                    <option value="25">Paraná (PR)</option>
                    <option value="26">Rio Grande do Sul (RS)</option>
                    <option value="27">Santa Catarina (SC)</option>
                  </optgroup>
                </select>
              </div>
            </div>
          </div><!-- linha -->

          <div class="row">
            <div class="col-sm-2">
              <div class="form-group">
                <label class="sr-only" for="tipo">Tipo</label>

                <select class="form-control" id="tipo" name="endereco[tipo]">
                  <option value="0">Tipo do Endereço</option>
                  <option value="1">Apartamento</option>
                  <option value="2">Casa</option>
                  <option value="3">Comercial</option>
                  <option value="4">Outros</option>
                </select>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label class="sr-only" for="cep">Código Postal</label>
                <input class="form-control" id="cep" type="text" name="endereco[cep]" maxlength="9" placeholder="CEP" onblur="pesquisaCEP(this.value);">
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                <label class="sr-only" for="numero">Número</label>
                <input class="form-control" id="numero" type="text" name="endereco[numero]" maxlength="10" placeholder="Número">
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label class="sr-only" for="complemento">Complemento</label>
                <input class="form-control" id="complemento" type="text" name="endereco[complemento]" maxlength="30" placeholder="Complemento">
              </div>
            </div>
          </div><!-- linha -->

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label class="sr-only" for="referencia">Referência</label>
                <input class="form-control" id="referencia" type="text" name="endereco[referencia]" maxlength="100" placeholder="Referência">
              </div>
            </div>
          </div><!-- linha -->

          <input id="id-cnpj" type="hidden" name="endereco[id-cnpj]">

          <div class="row">
            <div class="col-sm-2 col-sm-offset-8">
              <div class="form-group">
                <button class="btn btn-block btn-default" type="reset">Limpar</button>
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                <button class="btn btn-block btn-success"type="submit">Gravar</button>
              </div>
            </div>
          </div><!-- linha -->

        </form>
      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>

  <script>
    $('document').ready(function() {
      $('#cep').mask('00000-000');

      var url = window.location.href;
      var arr = url.split('=');

      document.getElementById('id-cnpj').value = arr[1];
    })
  </script>

  <script>
    function limpaEndereco() {
      document.getElementById('logradouro').value = '';
      document.getElementById('distrito').value = '';
      document.getElementById('localidade').value = '';
    }

    function recebeJSON(json) {
      if (! ('erro' in json)) {
        document.getElementById('logradouro').value = json.logradouro;
        document.getElementById('distrito').value = json.bairro;
        document.getElementById('localidade').value = json.localidade;
        document.getElementById('complemento').value = json.complemento;

        switch (json.uf) {
          // região norte
          case 'AC':
            document.getElementById('uf').value = '1';
              break;

          case 'AP':
            document.getElementById('uf').value = '2';
              break;

          case 'AM':
            document.getElementById('uf').value = '3';
              break;

          case 'PA':
            document.getElementById('uf').value = '4';
              break;

          case 'RO':
            document.getElementById('uf').value = '5';
              break;

          case 'RR':
            document.getElementById('uf').value = '6';
              break;

          case 'TO':
            document.getElementById('uf').value = '7';
              break;
          // região norte

          // região nordeste
          case 'AL':
            document.getElementById('uf').value = '8';
              break;

          case 'BA':
            document.getElementById('uf').value = '9';
              break;

          case 'CE':
            document.getElementById('uf').value = '10';
              break;

          case 'MA':
            document.getElementById('uf').value = '11';
              break;

          case 'PB':
            document.getElementById('uf').value = '12';
              break;

          case 'PE':
            document.getElementById('uf').value = '13';
              break;

          case 'PI':
            document.getElementById('uf').value = '14';
              break;

          case 'RN':
            document.getElementById('uf').value = '15';
              break;

          case 'SE':
            document.getElementById('uf').value = '16';
              break;
          // região nordeste

          // região centro-oeste
          case 'DF':
            document.getElementById('uf').value = '17';
              break;

          case 'GO':
            document.getElementById('uf').value = '18';
              break;

          case 'MT':
            document.getElementById('uf').value = '19';
              break;

          case 'MS':
            document.getElementById('uf').value = '20';
              break;
          // região centro-oeste

          // região sudeste
          case 'ES':
            document.getElementById('uf').value = '21';
              break;

          case 'MG':
            document.getElementById('uf').value = '22';
              break;

          case 'RJ':
            document.getElementById('uf').value = '23';
              break;

          case 'SP':
            document.getElementById('uf').value = '24';
              break;
          // região sudeste

          // região sul
          case 'PR':
            document.getElementById('uf').value = '25';
              break;

          case 'RS':
            document.getElementById('uf').value = '26';
              break;

          case 'SC':
            document.getElementById('uf').value = '27';
              break;
          // região sul
        }
      } else {
        limpaEndereco();

        alert('CEP não encontrado na base de dados dos Correios!');
      }
    }

    function pesquisaCEP(valor) {
      var cep = valor.replace(/\D/g, '');

      if (cep != '') {
        var validaCep = /^[0-9]{8}$/;

        if (validaCep.test(cep)) {
          document.getElementById('logradouro').value = '...';
          document.getElementById('distrito').value = '...';
          document.getElementById('localidade').value = '...';
          document.getElementById('complemento').value = '...';

          var script = document.createElement('script');

          script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=recebeJSON';

          document.body.appendChild(script);
        } else {
          alert('Formato de CEP inválido!');
        }
      } else {
        limpaEndereco();
      }
    }
  </script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
