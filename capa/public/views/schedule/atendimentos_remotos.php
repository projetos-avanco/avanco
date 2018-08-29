<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('atendimentos_remotos.php')) : ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Cadastro de Atendimento Remoto</title>

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
            <h2>Cadastro de Atendimento Remoto</h2>

            <hr>
          </div>
        </div><!-- linha -->

        <br>

        <form action="#" method="post">

          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <div class="input-group h2">
                <input class="form-control" id="pesquisa" type="text" placeholder="Pesquise por CNPJ ou Razão Social">
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button">
                    <span class="glyphicon glyphicon-search"></span>
                  </button>
                </span>
              </div>
            </div>
          </div>

          <br>

          <div class="row">
            <div class="col-sm-12">
              <div id="bloco">

              </div>

              <div class="hidden text-center" id="loader">
                <img src="<?php echo BASE_URL; ?>public/img/others/loader.gif" alt="loader" width="10%" height="10%">
              </div>
            </div>
          </div>

          <br>

          <div class="row">
            <div class="col-sm-5">
              <div class="form-group">
                <label for="razao-social">Razão Social</label>
                <input class="form-control required" id="razao-social" type="text" name="form[razao-social]" value="" placeholder="Razão Social" readonly="true">
              </div>
            </div>

            
          </div>

          <br>

          <div class="row">
            <div class="col-sm-3">
              <label for="cliente">Contato</label>
              <input class="form-control required" id="cliente" type="text" name="form[contato]" placeholder="Nome do Contato">
            </div>

            <div class="col-sm-3">
              <label for="telefone">Telefone</label>
              <input class="form-control required" id="telefone" type="tel" name="form[telefone]" placeholder="Telefone do Contato" maxlength="15" onkeyup="mascara(this, mtel);">
            </div>

            <div class="col-sm-3">
              <label for="data">Data</label>
              <input class="form-control required" id="data" type="date" name="form[data]">
            </div>

            <div class="col-sm-3">
              <label for="horario">Horário</label>
              <input class="form-control required" id="horario" type="time" name="form[horario]">
            </div>
          </div>

          <br>

          <div class="row">
            <div class="col-sm-4">
              <label for="colaborador">Colaborador</label>
              <select class="form-control required" id="colaborador" name="form[colaborador]">
                <option value="0">Selecione um Colaborador</option>
              </select>
            </div>

            <div class="col-sm-4">
              <label for="produto">Produto</label>
              <select class="form-control required" id="produto" name="form[produto]">
                <option value="0">Selecione um Produto</option>
                <option value="1">Integral</option>
                <option value="2">Frente de Loja</option>
                <option value="3">Gestor</option>
                <option value="4">Novo ERP</option>
              </select>
            </div>

            <div class="col-sm-4">
              <label for="modulo">Módulo</label>
              <select class="form-control required" id="modulo" name="form[modulo]">
                <option value="0">Selecione um Módulo</option>
              </select>
            </div>
          </div>

          <br>

          <div class="row">
            <div class="col-sm-12">
              <label for="assunto">Assunto</label>
              <textarea class="form-control required" id="assunto" name="form[assunto]" rows="2" cols="30" placeholder="Descreva o assunto..."></textarea>
            </div>
          </div>

          <br>

          <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
              <div class="panel panel-primary">
                <div class="panel-heading text-center"><strong>Número do Ticket</strong></div>
                <div class="panel-body text-center">
                  <h1>
                    <strong id="ticket">
                      <?php if (isset($_SESSION['ticket'])) : ?>
                        <?php echo $_SESSION['ticket']; ?>
                      <?php else : ?>
                        0
                      <?php endif; ?>
                    </strong>
                  </h1>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12 text-right">
              <a class="btn btn-default" href="<?php echo BASE_URL; ?>public/views/screen/novo_ticket.php">
                Limpar Tela
              </a>
              <button class="btn btn-primary" type="submit">
                Gerar Ticket
              </button>
            </div>
          </div>

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
      $('#fixo').mask('(00) 0000-0000');
      $('#movel').mask('(00) 00000-0000');
    })
  </script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
