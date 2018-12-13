<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('faltas.php')) : ?>

<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {    
    require_once DIRETORIO_HELPERS . 'diversas.php';
    require_once DIRETORIO_MODULES . 'schedule/modulo_registros.php';

    $db = abre_conexao();

    $faltas = array(
      'id' => 0,
      'registro' => null,
      'supervisor' => null,
      'colaborador' => null,
      'motivo' => null,
      'atestado' => null,
      'data_inicial' => null,
      'data_final' => null,
      'observacao' => null,
      'registrado' => null
    );

    $flag = false;

    $erros = array(
      'exibe' => false,
      'tipo' => 'success',
      'mensagens' => array()
    );

    $faltas['registro'] = geraRegistro($db, 'av_agenda_faltas');

    if (!empty($_POST['faltas']['supervisor'])) {
      if (is_numeric($_POST['faltas']['supervisor'])) {
        $faltas['supervisor'] = (int)$_POST['faltas']['supervisor'];
      } else {
        $flag = true;
        $erros['mensagens'][] = 'O tipo de dados do código do supervisor está incorreto.';
      }
    } else {
      $flag = true;
      $erros['mensagens'][] = 'O código do supervisor não foi enviado. Informe ao Wellington Felix.';
    }

    if (!empty($_POST['faltas']['colaborador'])) {
      if (is_numeric($_POST['faltas']['colaborador'])) {
        $faltas['colaborador'] = (int)$_POST['faltas']['colaborador'];
      } else {
        $flag = true;
        $erros['mensagens'][] = 'O tipo de dados do código do colaborador está incorreto.';
      }
    } else {
      $flag = true;
      $erros['mensagens'][] = 'Nenhum colaborador foi selecionado.';
    }

    if (!empty($_POST['faltas']['motivo'])) {
      if (is_string($_POST['faltas']['motivo'])) {
        $faltas['motivo'] = $_POST['faltas']['motivo'];
      } else {
        $flag = true;
        $erros['mensagens'][] = 'O tipo de dados do motivo está incorreto.';
      }
    } else {
      $flag = true;
      $erros['mensagens'][] = 'Nenhum motivo foi selecionado.';
    }

    # verificando se foi selecionado algum motivo que obriga o envio de algum arquivo em anexo
    if ($_POST['faltas']['motivo'] == '2' || $_POST['faltas']['motivo'] == '3' || $_POST['faltas']['motivo'] == '4') {
      # criando path do arquivo
      $target = ABS_PATH . 'public/files/attestation/reg-' . $faltas['registro'] . '-' . strtolower($_FILES['atestado']['name']);
            
      # verificando se o arquivo em anexo é de extensão .png, .jpeg ou .pdf
      if ($_FILES['atestado']['type'] == 'image/jpeg' || $_FILES['atestado']['type'] == 'image/png' || $_FILES['atestado']['type'] == 'application/pdf') {
        # verificando se o tamanho do arquivo em anexo é menor ou igual a 1MB
        if ($_FILES['atestado']['size'] <= 1048576) {
          # verificando se o arquivo em anexo foi movido para o diretório files
          if (move_uploaded_file($_FILES['atestado']['tmp_name'], $target)) {
            $faltas['atestado'] = 'reg-' . $faltas['registro'] . '-' . strtolower($_FILES['atestado']['name']);
          } else {
            $flag = true;
            $erros['mensagens'][] = 'Erro ao mover o arquivo em anexo para o diretório files/. Informe ao Wellington Felix';
          }
        } else {
          $flag = true;
          $erros['mensagens'][] = 'O arquivo em anexo deve ter o tamanho máximo de 1MB.';
        }
      } else {
        $flag = true;
        $erros['mensagens'][] = 'O arquivo em anexo não foi enviado ou tipo do arquivo é incorreto. O arquivo deve ser do tipo .png, .jpeg ou .pdf.';
      }
    }

    if (!empty($_POST['faltas']['data-inicial'])) {
      if (is_string($_POST['faltas']['data-inicial'])) {
        $faltas['data_inicial'] = $_POST['faltas']['data-inicial'];
      } else {
        $flag = true;
        $erros['mensagens'][] = 'O tipo de dados da data inicial está incorreto.';
      }
    } else {
      $flag = true;
      $erros['mensagens'][] = 'Nenhuma data inicial foi informada.';
    }

    if (!empty($_POST['faltas']['data-final'])) {
      if (is_string($_POST['faltas']['data-final'])) {
        $faltas['data_final'] = $_POST['faltas']['data-final'];
      } else {
        $flag = true;
        $erros['mensagens'][] = 'O tipo de dados da data final está incorreto.';
      }
    } else {
      $flag = true;
      $erros['mensagens'][] = 'Nenhuma data final foi informada.';
    }

    if (!empty($_POST['faltas']['observacao'])) {
      if (is_string($_POST['faltas']['observacao'])) {
        $faltas['observacao'] = addslashes(mb_strtolower($_POST['faltas']['observacao'], 'utf-8'));
        $faltas['observacao'] = trim(str_replace("\r\n", ' ', $faltas['observacao']));
      } else {
        $flag = true;
        $erros['mensagens'][] = 'O tipo de dados da observação está incorreto.';
      }
    } else {
      $faltas['observacao'] = '';
    }

    $faltas['registrado'] = date('Y-m-d H:i:s');

    if ($flag) {
      $erros['exibe'] = true;
      $erros['tipo'] = 'danger';
    } else {
      recebeRegistroDeFaltas($faltas);
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

  <title>Portal Avanção - Registro de Faltas</title>

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

    .btn-file {
      position: relative;
      overflow: hidden;
    }

    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
  </style>
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <h2>Registro de Faltas</h2>
              <hr>
            </div>
          </div>
        </div>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

          <div class="row"><!-- linha principal -->
            <div class="col-sm-6 col-sm-offset-3"><!-- primeira coluna principal -->

              <div class="row"><!-- painel atendimentos -->
                <div class="col-sm-12">

                  <div class="panel panel-info"><!-- panel -->
                    <div class="panel-heading">
                      <div class="text-left">
                        <strong>Faltas</strong>
                      </div>
                    </div>

                    <div class="panel-body"><!-- panel-body -->
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="colaborador">Lista Colaboradores</label>
                            <select class="form-control required" id="colaborador" name="faltas[colaborador]">

                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="motivo">Motivo</label>
                            <select class="form-control required" id="motivo" name="faltas[motivo]">
                              <optgroup label="Pessoal">
                                <option value="1" selected>Descontar o Dia</option>
                              </optgroup>

                              <optgroup label="Atestado">
                                <option value="2">Atestado Médico</option>
                                <option value="3">Atestado Óbito</option>
                                <option value="4">Atestado Acompanhamento</option>
                              </optgroup>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="data-inicial">Data Inicial</label>
                            <input class="form-control required" id="data-inicial" type="date" name="faltas[data-inicial]" value="<?php echo $data; ?>">
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="data-final">Data Final</label>
                            <input class="form-control required" id="data-final" type="date" name="faltas[data-final]" value="<?php echo $data; ?>">
                          </div>
                        </div>
                      </div>

                      <div class="row" id="bloco-atestado">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label class="sr-only" for="atestado">Atestado</label>
                            <span class="btn btn-danger btn-block btn-file">
                              Anexar Atestado <input id="atestado" type="file" name="atestado">
                            </span>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="observacao">Observação</label>
                            <textarea class="form-control required" id="observacao" name="faltas[observacao]" rows="4" cols="30" placeholder="Observações..."></textarea>
                          </div>
                        </div>
                      </div>
                    </div><!-- panel-body -->
                  </div><!-- panel -->

                  <input type="hidden" name="faltas[supervisor]" value="<?php echo $_SESSION['usuario']['id']; ?>">
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
  <script src="<?php echo BASE_URL; ?>public/js/schedule/records/motivos.js"></script>

  <script>
    $(function() {
      // aterando data final caso a data inicial seja alterada
      $(document).on('change', '#data-inicial', function(e) {
        e.preventDefault;

        var dataInicial = $('#data-inicial').val();

        $('#data-final').val(dataInicial);
      });
    });  
  </script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
