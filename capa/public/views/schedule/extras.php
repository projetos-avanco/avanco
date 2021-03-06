<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('extras.php')) : ?>

<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {    
    require_once DIRETORIO_HELPERS . 'diversas.php';
    require_once DIRETORIO_MODULES . 'schedule/modulo_registros.php';

    $db = abre_conexao();

    $extras = array(
      'id' => 0,
      'registro' => null,
      'supervisor' => null,
      'colaborador' => null,
      'motivo' => null,
      'data' => null,
      'tempo_extra' => null,
      'observacao' => null,
      'registrado' => null
    );

    $flag = false;

    $erros = array(
      'exibe' => false,
      'tipo' => 'success',
      'mensagens' => array()
    );

    $extras['registro'] = geraRegistro($db, 'av_agenda_extras');

    if (!empty($_POST['extras']['supervisor'])) {
      if (is_numeric($_POST['extras']['supervisor'])) {
        $extras['supervisor'] = (int)$_POST['extras']['supervisor'];
      } else {
        $flag = true;
        $erros['mensagens'][] = 'O tipo de dados do código do supervisor está incorreto.';
      }
    } else {
      $flag = true;
      $erros['mensagens'][] = 'O código do supervisor não foi enviado. Informe ao Wellington Felix.';
    }

    if (!empty($_POST['extras']['colaborador'])) {
      if (is_numeric($_POST['extras']['colaborador'])) {
        $extras['colaborador'] = (int)$_POST['extras']['colaborador'];
      } else {
        $flag = true;
        $erros['mensagens'][] = 'O tipo de dados do código do colaborador está incorreto.';
      }
    } else {
      $flag = true;
      $erros['mensagens'][] = 'Nenhum colaborador foi selecionado.';
    }

    if (!empty($_POST['extras']['motivo'])) {
      if (is_string($_POST['extras']['motivo'])) {
        $extras['motivo'] = $_POST['extras']['motivo'];
      } else {
        $flag = true;
        $erros['mensagens'][] = 'O tipo de dados do motivo está incorreto.';
      }
    } else {
      $flag = true;
      $erros['mensagens'][] = 'Nenhum motivo foi selecionado.';
    }

    if (!empty($_POST['extras']['data'])) {
      if (is_string($_POST['extras']['data'])) {
        $extras['data'] = $_POST['extras']['data'];
      } else {
        $flag = true;
        $erros['mensagens'][] = 'O tipo de dados da data está incorreto.';
      }
    } else {
      $flag = true;
      $erros['mensagens'][] = 'Nenhuma data foi informada.';
    }

    if (!empty($_POST['extras']['tempo'])) {
      if (is_string($_POST['extras']['tempo'])) {
        $extras['tempo_extra'] = $_POST['extras']['tempo'] . ':00';
      } else {
        $flag = true;
        $erros['mensagens'][] = 'O tipo de dados das horas extras está incorreto.';
      }
    } else {
      $flag = true;
      $erros['mensagens'][] = 'Nenhuma hora extra foi informada.';
    }

    if (!empty($_POST['extras']['observacao'])) {
      if (is_string($_POST['extras']['observacao'])) {
        $extras['observacao'] = addslashes(mb_strtolower($_POST['extras']['observacao'], 'utf-8'));
        $extras['observacao'] = trim(str_replace("\r\n", ' ', $extras['observacao']));
      } else {
        $flag = true;
        $erros['mensagens'][] = 'O tipo de dados da observação está incorreto.';
      }
    } else {
      $extras['observacao'] = '';
    }

    $extras['registrado'] = date('Y-m-d H:i:s');

    if ($flag) {
      $erros['exibe'] = true;
      $erros['tipo'] = 'danger';
    } else {
      recebeRegistroDeExtras($extras);
    }
  }
?>

<?php $data = date('Y-m-d'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Registro de Extras</title>

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
              <h2>Registro de Extras</h2>
              <hr>
            </div>
          </div>
        </div>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

          <div class="row"><!-- linha principal -->
            <div class="col-sm-6 col-sm-offset-3"><!-- primeira coluna principal -->

              <div class="row"><!-- painel atendimentos -->
                <div class="col-sm-12">

                  <div class="panel panel-info"><!-- panel -->
                    <div class="panel-heading">
                      <div class="text-left">
                        <strong>Extras</strong>
                      </div>
                    </div>

                    <div class="panel-body"><!-- panel-body -->
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="colaborador">Lista Colaboradores</label>
                            <select class="form-control required" id="colaborador" name="extras[colaborador]">

                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="motivo">Motivo</label>
                            <select class="form-control required" id="motivo" name="extras[motivo]">
                              <option value="1" selected>Saiu Mais Tarde</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="data">Data</label>
                            <input class="form-control required" id="data" type="date" name="extras[data]" value="<?php echo $data; ?>">
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="tempo">Tempo Extra</label>
                            <div class="input-group">
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                  <span class="glyphicon glyphicon-time"></span>
                                </button>
                              </span>                              
                              <input class="form-control required" id="tempo" type="text" name="extras[tempo]" placeholder="Horas Extras">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="observacao">Observação</label>
                            <textarea class="form-control required" id="observacao" name="extras[observacao]" rows="4" cols="30" placeholder="Observações..."></textarea>
                          </div>
                        </div>
                      </div>
                    </div><!-- panel-body -->
                  </div><!-- panel -->

                  <input type="hidden" name="extras[supervisor]" value="<?php echo $_SESSION['usuario']['id']; ?>">
                </div>
              </div><!-- painel atendimentos -->

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

            </div><!-- primeira coluna principal -->
          </div><!-- linha principal -->

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

  <script>
    $(function() {
      $(document).ready(function(e) {
        e.preventDefault;

        $('#tempo').mask('00:00');
      });
    });
  </script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
