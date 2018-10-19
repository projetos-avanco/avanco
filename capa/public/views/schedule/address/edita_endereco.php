<?php require '../../../../init.php'; ?>

<?php if (verificaUsuarioLogado('edita_endereco.php')) : ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Edição de Endereço</title>

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
            <h2>Edição de Endereço</h2>

            <hr>
          </div>
        </div><!-- linha -->

        <br>

        <form action="<?php echo BASE_URL; ?>app/requests/post/schedule/address/recebe_endereco_edicao.php" method="post">

          <div class="row">
            <div class="col-sm-7"><!-- coluna 1 -->
              <div class="form-group">

                <div class="panel panel-info">
                  <div class="panel-heading">
                    <div class="text-left">
                      <strong>Endereço</strong>
                    </div>
                  </div>

                  <div class="panel-body">

                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label class="sr-only" for="logradouro">Logradouro</label>
                          <input class="form-control" id="logradouro" type="text" name="endereco[logradouro]" maxlength="100" placeholder="Avenida">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-4">
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

                      <div class="col-sm-4">
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
                    </div>

                    <div class="row">
                      <div class="col-sm-3">
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

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label class="sr-only" for="cep">Código Postal</label>
                          <input class="form-control" id="cep" type="text" name="endereco[cep]" maxlength="9" placeholder="Código Postal" onblur="pesquisaCEP(this.value);">
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
                    </div>

                    <input type="hidden" id="id-endereco" name="endereco[id-endereco]">
                  </div>
                </div>

              </div>
            </div><!-- coluna 1 -->

            <div class="col-sm-5"><!-- coluna 2 -->
              <div class="form-group">

                <div class="panel panel-info">
                  <div class="panel-heading">
                    <div class="text-left">
                      <strong>Complementar</strong>
                    </div>
                  </div>

                  <div class="panel-body">

                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label class="sr-only" for="referencia">Referência</label>
                          <input class="form-control" id="referencia" type="text" name="endereco[referencia]" maxlength="100" placeholder="Referência">
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-4 col-sm-offset-4">
                    <button class="btn btn-block btn-default btn-sm"type="reset">
                      <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                      Resetar
                    </button>
                  </div>

                  <div class="col-sm-4">
                    <button class="btn btn-block btn-success btn-sm" type="submit" name="submit">
                      <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
                      Gravar
                    </button>
                  </div>
                </div>

              </div>
            </div><!-- coluna 2 -->
          </div>

          <input id="id-cnpj" type="hidden" name="endereco[id-cnpj]">

        </form>

        <?php if (! empty($_SESSION['atividades']['mensagens']) AND $_SESSION['atividades']['exibe'] == true) : ?>

          <?php for ($i = 0; $i < count($_SESSION['atividades']['mensagens']); $i++) : ?>
            <div class="row">
              <div class="col-sm-12">
                <div class="text-center">
                  <div class="alert alert-<?php echo $_SESSION['atividades']['tipo']; ?>" role="alert">
                      <?php if ($_SESSION['atividades']['tipo'] == 'danger') : ?>
                        <strong>Ops!</strong>
                      <?php else : ?>
                        <strong>Tudo Certo!</strong>
                      <?php endif; ?>

                      <?php echo $_SESSION['atividades']['mensagens'][$i]; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endfor; ?>

        <?php endif; ?>

        <?php unset($_SESSION['atividades']['mensagens'], $_SESSION['atividades']['tipo']); ?>
      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/address/recupera_id_cnpj_edicao.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/address/mascaras.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/address/pesquisa_cep.js"></script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
