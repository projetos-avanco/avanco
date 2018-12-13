<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('edita_atrasos.php')) : ?>

<?php
  # verificando se houve uma requisição via método get
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {    
    require_once DIRETORIO_MODULES . 'schedule/modulo_registros.php';

    # verificando se o id do registro foi enviado e não está vazio
    if (isset($_GET['id']) && (!empty($_GET['id']))) {
      # verificando se o id é uma string numérica
      if (is_numeric($_GET['id'])) {
        $id = (int) $_GET['id'];
      }
    }

    # verificando se a variável id existe
    if (isset($id)) {
      # chamando função que retorna os dados do registro
      $atraso = retornaDadosDoRegistroDeAtraso($id);      
    }    
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Edição de Atrasos</title>

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
              <h2>Edição de Atrasos</h2>
              <hr>
            </div>
          </div>
        </div>

        <form action="<?php echo BASE_URL; ?>app/requests/post/schedule/records/recebe_edicao_atraso.php" method="post">

          <div class="row"><!-- linha principal -->
            <div class="col-sm-6 col-sm-offset-3"><!-- primeira coluna principal -->

              <div class="row"><!-- painel atendimentos -->
                <div class="col-sm-12">

                  <div class="panel panel-info"><!-- panel -->
                    <div class="panel-heading">
                      <div class="text-left">
                        <strong>Atrasos</strong>
                      </div>
                    </div>

                    <div class="panel-body"><!-- panel-body -->
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="sr-only" for="novo-colaborador">Colaborador</label>
                            <select class="form-control required" id="novo-colaborador" name="atrasos[colaborador]" readonly>
                              <option value="<?php echo $atraso['id_colaborador']; ?>"><?php echo $atraso['nome_colaborador']; ?></option>
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="sr-only" for="colaborador">Colaborador</label>
                            <select class="form-control required" id="colaborador">

                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label class="sr-only" for="motivo">Motivo</label>
                            <select class="form-control required" id="motivo" name="atrasos[motivo]">
                              <option value="1" <?php echo ($atraso['motivo'] == '1') ? 'selected' : '' ?>>Saiu Mais Cedo</option>
                              <option value="2" <?php echo ($atraso['motivo'] == '2') ? 'selected' : '' ?>>Chegou Mais Tarde</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="sr-only" for="data">Data</label>
                            <input class="form-control required" id="data" type="date" name="atrasos[data]" value="<?php echo $atraso['data']; ?>" placeholder="Data">
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                  <span class="glyphicon glyphicon-time"></span>
                                </button>
                              </span>
                              <label class="sr-only" for="tempo">Tempo Atraso</label>
                              <input class="form-control required" id="tempo" type="text" name="atrasos[tempo]" value="<?php echo $atraso['tempo_atraso']; ?>" placeholder="Horas Defasadas">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label class="sr-only" for="observacao">Observação</label>
                            <textarea class="form-control required" id="observacao" name="atrasos[observacao]" rows="4" cols="30" placeholder="Observações..."><?php echo $atraso['observacao']; ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div><!-- panel-body -->
                  </div><!-- panel -->

                  <input type="hidden" name="atrasos[supervisor]" value="<?php echo $_SESSION['usuario']['id']; ?>">

                  <input type="hidden" name="atrasos[id]" value="<?php echo $atraso['id']; ?>">
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
                            <?php echo $atraso['registro']; ?>
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
                    <button class="btn btn-block btn-default btn-sm" id="btn-voltar" type="button">
                      <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
                      Voltar
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

        <?php if ((!empty($_SESSION['atividades']['mensagens'])) && $_SESSION['atividades']['exibe'] == true) : ?>

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
      $(document).ready(function() {      
        $('#tempo').mask('00:00');
      });

      // editando colaborador
      $(document).on('change', '#colaborador', function(e) {
        e.preventDefault;

        var id = $(this).val();
        var nome = $('#colaborador :selected').text();

        $('#novo-colaborador').html('<option value="' + id + '" selected>' + nome + '</option>');
      });

      // voltando para página de relatório de atrasos
      $(document).on('click', '#btn-voltar', function(e) {
        e.preventDefault;

        var url = window.location.href;
        var tmp = url.split('/');

        url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/public/views/schedule/relatorio_atrasos.php';
        
        window.open(url, '_self');
      });
    });
  </script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
