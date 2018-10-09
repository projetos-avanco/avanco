<?php require '../../../../init.php'; ?>

<?php if (verificaUsuarioLogado('empresa.php')) : ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Cadastro de Empresa</title>

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
            <h2>Cadastro de Empresa</h2>

            <hr>
          </div>
        </div><!-- linha -->

        <br>

        <form action="#" method="post">

          <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
              <div class="form-group">

                <div class="panel panel-info">
                  <div class="panel-heading">
                    <strong>Nova Empresa</strong>
                  </div>

                  <div class="panel-body">

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="sr-only" for="cnpj">CNPJ</label>
                          <input class="form-control" id="cnpj" type="text" name="empresa[cnpj]" maxlength="18" placeholder="CNPJ">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label class="sr-only" for="contrato">Contrato</label>
                          <input class="form-control" id="contrato" type="text" name="empresa[contrato]" maxlength="8" placeholder="Conta Contrato">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label class="sr-only" for="razao-social">Razão Social</label>
                          <input class="form-control" id="razao-social" type="text" name="empresa[razao-social]" maxlength="100" placeholder="Razão Social">
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-2 col-sm-offset-8">
                    <div class="form-group">
                      <button class="btn btn-block btn-default" type="reset">
                        <span class="glyphicon glyphicon-erase" aria-hidden="true"></span>
                        Limpar
                      </button>
                    </div>
                  </div>

                  <div class="col-sm-2">
                    <div class="form-group">
                      <button class="btn btn-block btn-success" type="submit">
                        <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
                        Gravar
                      </button>
                    </div>
                  </div>
                </div>

              </div>
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
      $('#cnpj').mask('00.000.000/0000-00');
      $('#contrato').mask('0000-000')
    })
  </script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
