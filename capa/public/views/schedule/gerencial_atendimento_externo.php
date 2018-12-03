<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('gerencial_atendimento_externo.php')) : ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Consulta Gerencial Atendimento Externo</title>

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
            <div class="form-group">
              <h2>Consulta Gerencial Atendimento Externo</h2>
              <hr>
            </div>
          </div>
        </div>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="row">
            <div class="col-sm-4 col-sm-offset-8">
              <div class="form-group">
                <div class="input-group">                  
                  <input class="form-control" id="pesquisa" type="text" placeholder="Digite a Razão Social ou CNPJ da Empresa">
                  <span class="input-group-btn">
                    <button class="btn btn-info" type="button">
                      <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Pesquisa
                    </button>
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="row"><!-- linha principal -->
            <div class="col-sm-6"><!-- primeira coluna principal -->

              <div class="panel panel-info"><!-- panel -->
                <div class="panel-heading">
                  <strong>Empresa</strong>
                </div>

                <div class="panel-body"><!-- panel-body -->
                  <div class="row">
                    <div class="col-sm-3 col-sm-offset-9">
                      <div class="form-group">
                        <button class="btn btn-info btn-sm btn-block" id="nova-empresa" type="button">
                          <i class="fa fa-building" aria-hidden="true"></i> Nova Empresa
                        </button>
                      </div>
                    </div>
                  </div>

                  <div class="text-center" id="empresas"><!-- tabela de empresas -->
                                        
                  </div><!-- tabela de empresas -->

                  <div class="hidden text-center" id="loader">
                    <img src="<?php echo BASE_URL; ?>public/img/others/loader.gif" alt="loader" width="30%" height="30%">
                  </div>
                </div><!-- panel-body -->
              </div><!-- panel -->
            </div><!-- primeira coluna principal -->

            <div class="col-sm-6"><!-- segunda coluna principal -->

              <div class="panel panel-info"><!-- panel -->
                <div class="panel-heading">
                  <div class="text-left">
                    <strong>Filtros</strong>
                  </div>
                </div>

                <div class="panel-body"><!-- panel-body -->
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="sr-only" for="data-inicial">Data Inicial</label>
                        <input class="form-control" id="data-inicial" type="text" name="data-inicial" placeholder="Data Inicial">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="sr-only" for="data-final">Data Final</label>
                        <input class="form-control" id="data-final" type="text" name="data-final" placeholder="Data Final">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label class="sr-only" for="colaborador">Colaborador</label>
                        <select class="form-control required" id="colaborador" name="colaborador">

                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="sr-only" for="tipo-atendimento">Tipo</label>
                        <select class="form-control required" id="tipo-atendimento" name="tipo-atendimento">
                          <option value="0" selected>Tipo de Atendimento</option>
                          <option value="1">Suporte ao Cliente</option>
                          <option value="2">Projeto Mais Gestão</option>
                          <option value="3">Implantação</option>
                          <option value="4">Treinamento Avanço</option>
                          <option value="5">Instalação</option>
                          <option value="6">Atualização</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="sr-only" for="produto">Produto</label>
                        <select class="form-control required" id="produto" name="externo[produto]">
                          <option value="0">Produto</option>
                          <option value="1">Integral</option>
                          <option value="2">Frente de Loja</option>
                          <option value="3">Gestor</option>
                          <option value="4">Novo ERP</option>
                        </select>
                      </div>
                    </div>
                  </div>                  
                </div><!-- panel-body -->
              </div><!-- panel -->

              <input type="hidden" name="extras[supervisor]" value="<?php echo $_SESSION['usuario']['id']; ?>">
            </div><!-- segunda coluna principal -->

          </div><!-- linha principal -->

          <div class="row"><!-- painel registro -->
            <div class="col-sm-12">

              <div class="panel panel-info"><!-- panel -->
                <div class="panel-heading">
                  <div class="text-center">
                    <strong>Registro</strong>
                  </div>
                </div>

                <div class="panel-body"><!-- panel-body -->
                  <div class="text-center">
                    <h1>
                      <strong id="ticket">
                        <?php if (isset($_SESSION['registro'])) : ?>
                          <?php echo $_SESSION['registro']; ?>
                        <?php else : ?>
                          0
                        <?php endif; ?>
                      </strong>
                    </h1>
                  </div>
                </div><!-- panel-body -->
              </div><!-- panel -->

            </div>
          </div><!-- painel registro -->

          <div class="row">
            <div class="col-sm-3 col-sm-offset-6">
              <div class="form-group">
                <button class="btn btn-block btn-default btn-sm" type="reset">
                  <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                  Resetar
                </button>
              </div>
            </div>

            <div class="col-sm-3">
              <div class="form-group">
                <button class="btn btn-block btn-success btn-sm" type="submit">
                  <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
                  Gravar
                </button>
              </div>
            </div>
          </div>

        </form>

        <?php if ((!empty($erros['mensagens'])) && $erros['exibe'] == true) : ?>

          <?php for ($i = 0; $i < count($erros['mensagens']); $i++) : ?>
            <div class="row">
              <div class="col-sm-12">
                <div class="text-center">
                  <div class="alert alert-<?php echo $erros['tipo']; ?>" role="alert">
                      <?php if ($erros['tipo'] == 'danger') : ?>
                        <strong>Ops!</strong>
                      <?php else : ?>
                        <strong>Tudo Certo!</strong>
                      <?php endif; ?>

                      <?php echo $erros['mensagens'][$i]; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endfor; ?>

      <?php endif; ?>

      <?php if ((!empty($_SESSION['atividades']['mensagens'])) && $_SESSION['atividades']['exibe'] == true) : ?>

        <div class="row">
          <div class="col-sm-12">
            <div class="text-center">
              <div class="alert alert-<?php echo $_SESSION['atividades']['tipo']; ?>" role="alert">
                  <?php if ($_SESSION['atividades']['tipo'] == 'danger') : ?>
                    <strong>Ops!</strong>
                  <?php else : ?>
                    <strong>Tudo Certo!</strong>
                  <?php endif; ?>

                  <?php echo $_SESSION['atividades']['mensagens']; ?>
              </div>
            </div>
          </div>
        </div>

      <?php endif; ?>

      <?php unset($_SESSION['atividades'], $_SESSION['registro']); ?>

      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/avancoins/colaboradores.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/pesquisa.js"></script>

  <script>
    $(document).ready(function() {
      $('#data-inicial').mask('00/00/0000');
      $('#data-final').mask('00/00/0000');
    });
  </script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
