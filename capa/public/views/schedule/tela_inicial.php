<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('tela_inicial.php')) : ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Consulta de Tickets</title>

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
            <h2>Seleção de Atividades</h2>

            <hr>
          </div>
        </div><!-- linha -->

        <br>

        <form action="<?php echo BASE_URL; ?>app/requests/post/recebe_atividade.php" method="post">

          <div class="row">
            <div class="col-sm-3 col-sm-offset-5">
              <div class="form-group">
                <label for="colaborador">Colaborador</label>

                <select class="form-control required" id="colaborador" name="colaborador">
                  <option value="0" selected>Selecione um Colaborador</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3 col-sm-offset-5">
              <div class="form-group">
                <label for="atividade">Atividade</label>

                <select class="form-control required" id="atividade" name="atividade">
                  <option value="0">Selecione uma Atividade</option>
                  <option value="1">Atendimento Externo</option>
                  <option value="2">Atendimento Remoto</option>
                  <option value="3">Registro de Folgas</option>
                  <option value="4">Registro de Faltas</option>
                  <option value="5">Registro de Atrasos</option>
                  <option value="6">Registro de Extras</option>
                  <option value="7">Registro de Férias</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3 col-sm-offset-5">
              <div class="form-group">
                <div class="text-right">
                  <button class="btn btn-success btn-block" type="submit">Abrir</button>
                </div>
              </div>
            </div>
          </div>

          <?php if (isset($_SESSION['mensagens']['mensagem']) && $_SESSION['mensagens']['exibe'] == true) : ?>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <div class="text-center">
                    <p class="alert alert-<?php echo $_SESSION['mensagens']['tipo']; ?>" role="alert">
                      <?php echo $_SESSION['mensagens']['mensagem']; ?>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>

        </form>
      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/avancoins/colaboradores.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/shedule/validacao.js"></script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
