<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('edita_faltas.php')) : ?>

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
      $falta = retornaDadosDoRegistroDeFalta($id);
    }    
  }
?>

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

        <form action="<?php echo BASE_URL; ?>app/requests/post/schedule/records/recebe_edicao_falta.php" method="post" enctype="multipart/form-data">

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
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="novo-colaborador">Colaborador</label>
                            <select class="form-control required" id="novo-colaborador" name="faltas[colaborador]" readonly>
                              <option value="<?php echo $falta['id_colaborador']; ?>"><?php echo $falta['nome_colaborador']; ?></option>
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="colaborador">Lista Colaboradores</label>
                            <select class="form-control required" id="colaborador">

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
                                <option value="1" <?php echo ($falta['motivo'] == '1') ? 'selected' : '' ?>>Descontar o Dia</option>
                              </optgroup>

                              <optgroup label="Atestado">
                                <option value="2" <?php echo ($falta['motivo'] == '2') ? 'selected' : '' ?>>Atestado Médico</option>
                                <option value="3" <?php echo ($falta['motivo'] == '3') ? 'selected' : '' ?>>Atestado Óbito</option>
                                <option value="4" <?php echo ($falta['motivo'] == '4') ? 'selected' : '' ?>>Atestado Acompanhamento</option>
                              </optgroup>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="data-inicial">Data Inicial</label>
                            <input class="form-control required" id="data-inicial" type="date" name="faltas[data-inicial]" value="<?php echo $falta['data_inicial']; ?>" placeholder="Data Inicial">
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="data-final">Data Final</label>
                            <input class="form-control required" id="data-final" type="date" name="faltas[data-final]" value="<?php echo $falta['data_final']; ?>">
                          </div>
                        </div>
                      </div>

                      <?php if (isset($falta['atestado']) && (!empty($falta['atestado']))) : ?>
                        <div class="row" id="bloco-alterar-atestado">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label for="alterar-atestado">Alterar Atestado?</label>
                              <select class="form-control required" id="alterar-atestado" name="faltas[alterar-atestado]">
                                <option value="0" checked>Não</option>
                                <option value="1">Sim</option>
                              </select>                              
                            </div>
                          </div>
                        </div>
                      <?php endif; ?>

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

                      <?php if (isset($falta['atestado']) && (!empty($falta['atestado']))) : ?>
                        <div class="row" id="bloco-alerta-atestado">
                          <div class="col-sm-12">
                            <div class="text-center">
                              <div class="alert alert-warning" role="alert">
                                <strong>Atenção!</strong> Já está gravado o atestado <strong><?php echo $falta['atestado']; ?></strong>.
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php endif; ?>

                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="observacao">Observação</label>
                            <textarea class="form-control required" id="observacao" name="faltas[observacao]" rows="4" cols="30" placeholder="Observações..."><?php echo $falta['observacao']; ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div><!-- panel-body -->
                  </div><!-- panel -->

                  <input type="hidden" name="faltas[supervisor]" value="<?php echo $_SESSION['usuario']['id']; ?>">

                  <input type="hidden" name="faltas[id]" value="<?php echo $falta['id']; ?>">

                  <input type="hidden" name="faltas[registro]" value="<?php echo $falta['registro']; ?>">
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
                            <?php echo $falta['registro']; ?>
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
  <script src="<?php echo BASE_URL; ?>public/js/schedule/records/datas.js"></script>

  <script>
    $(function() {
      $(document).ready(function() {
        $('#tempo').mask('00:00');
        $('#bloco-atestado').addClass('hidden');

        var motivo = $('#motivo').val();
        var atestado = $('#atestado').val();

        if (motivo == '1') {
          $('#bloco-atestado').addClass('hidden');
          $('#bloco-alterar-atestado').addClass('hidden');

          if (atestado != '') {
            $('#atestado').val('');
          }              
        } else if (motivo == '2' || motivo == '3' || motivo == '4') {
          $('#bloco-atestado').removeClass('hidden');
          $('#bloco-alterar-atestado').removeClass('hidden');
        }  
      });

      // aterando data final caso a data inicial seja alterada
      $(document).on('change', '#data-inicial', function(e) {
        e.preventDefault;

        var dataInicial = $('#data-inicial').val();

        $('#data-final').val(dataInicial);
      });

      // alterando motivo
      $(document).on('change', '#motivo', function(e) {
        e.preventDefault;

        var motivo = $('#motivo').val();
        var atestado = $('#atestado').val();

        if (motivo == '1') {
          $('#bloco-atestado').addClass('hidden');
          $('#bloco-alterar-atestado').addClass('hidden');
          $('#bloco-alerta-atestado').addClass('hidden');

          if (atestado != '') {
            $('#atestado').val('');
          }              
        } else if (motivo == '2' || motivo == '3' || motivo == '4') {
          $('#bloco-atestado').removeClass('hidden');
          $('#bloco-alterar-atestado').removeClass('hidden');
          $('#bloco-alerta-atestado').removeClass('hidden');
        }      
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

        url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/public/views/schedule/relatorio_faltas.php';
        
        window.open(url, '_self');
      });
    });
  </script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
