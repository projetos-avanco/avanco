<?php require '../../../init.php'; ?>
<?php require DIRETORIO_HELPERS . 'datas.php'; ?>

<?php if (verificaUsuarioLogado('relatorio_atrasos.php')) : ?>

<?php $data = date('Y-m-d'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Consulta Gerencial - Relatório de Atrasos</title>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap_3.3.7.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/fontes.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/home.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/sidebar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbar.css">

  <style>
    .erro {
    border: 2px solid red;
    }

    table thead tr th {
      font-size: 0.95em;
      text-align: left;
    }

    table tbody tr td {
      height: 2.5em;
    }

    .table tbody tr td {
      font-size: 0.90em;
      vertical-align: middle;
    }

    .table {
      font-family: 'Lato Regular', sans-serif;
    }
  </style>

  <!-- dispositivos com largura máxima de 769px (por exemplo tablets) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbartablet.css" type="text/css" media="screen and (max-width: 769px)" />
  <!-- dispositivos com largura máxima de 450px (por exemplo smartphones) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbarsmart.css" type="text/css" media="screen and (max-width:450px)" />
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <h2>Consulta Gerencial - Relatório de Atrasos</h2>
              <hr>
            </div>
          </div>
        </div>

        <div class="row"><!-- painel registro -->
          <div class="col-sm-12">

            <div class="panel panel-info hidden" id="panel"><!-- panel -->
              <div class="panel-heading">
                <div class="text-left">
                  <strong>Relatório</strong>
                </div>
              </div>

              <div class="panel-body" id="tabela-relatorio"><!-- panel-body -->
                
              </div><!-- panel-body -->

              <form class="form-horizontal" id="form-total-atraso">
                <div class="form-group">
                  <label class="col-sm-1 control-label" for="total-atraso">Tempo Total:</label>
                  <div class="col-sm-1">
                    <input class="form-control" id="total-atraso" type="text" name="total-atraso" value="0" readonly>
                  </div>                  
                </div>
              </form>
            </div><!-- panel -->

          </div>
        </div><!-- painel registro -->
        
        <?php if ($_SESSION['usuario']['nivel'] == '2') : ?>
          <form>
            <div class="row"><!-- linha principal -->        
              <div class="col-sm-6 col-sm-offset-6"><!-- primeira coluna principal -->

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
                          <label for="data-inicial">Data Inicial</label>
                          <input class="form-control" id="data-inicial" type="date" name="data-inicial" value="<?php echo $data; ?>">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="data-final">Data Final</label>
                          <input class="form-control" id="data-final" type="date" name="data-final" value="<?php echo $data; ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="colaborador">Colaborador</label>
                          <select class="form-control" id="colaborador" name="colaborador">

                          </select>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="motivo">Motivo</label>
                          <select class="form-control" id="motivo" name="motivo">
                            <option value="0" selected>Selecione o Motivo</option>
                            <option value="1">Saiu Mais Cedo</option>
                            <option value="2">Chegou Mais Tarde</option>
                          </select>
                        </div>
                      </div>
                    </div>                  
                  </div><!-- panel-body -->
                </div><!-- panel -->

                <input id="id-chat" type="hidden" name="id-chat" value="<?php echo $_SESSION['usuario']['id']; ?>">
                
                <input id="nivel" type="hidden" name="nivel" value="<?php echo $_SESSION['usuario']['nivel']; ?>">

                <div class="row">
                  <div class="col-sm-3 col-sm-offset-6">
                    <div class="form-group">
                      <button class="btn btn-block btn-default btn-sm" id="btn-atualizar" type="button">
                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                        Resetar
                      </button>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <button class="btn btn-block btn-info btn-sm" id="btn-consultar" type="button">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        Consultar
                      </button>
                    </div>
                  </div>
                </div>
                
              </div><!-- primeira coluna principal -->
            </div><!-- linha principal -->
          
          </form>
        <?php elseif ($_SESSION['usuario']['nivel'] != '2') : ?>
          <form>
            <div class="row"><!-- linha principal -->        
              <div class="col-sm-6 col-sm-offset-6"><!-- primeira coluna principal -->

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
                          <label for="data-inicial">Data Inicial</label>
                          <input class="form-control" id="data-inicial" type="date" name="data-inicial" value="<?php echo $data; ?>">
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="data-final">Data Final</label>
                          <input class="form-control" id="data-final" type="date" name="data-final" value="<?php echo $data; ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">                  
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="motivo">Motivo</label>
                          <select class="form-control" id="motivo" name="motivo">
                            <option value="0" selected>Selecione o Motivo</option>
                            <option value="1">Saiu Mais Cedo</option>
                            <option value="2">Chegou Mais Tarde</option>
                          </select>
                        </div>
                      </div>
                    </div>                  
                  </div><!-- panel-body -->
                </div><!-- panel -->

                <input id="id-chat" type="hidden" name="id-chat" value="<?php echo $_SESSION['usuario']['id']; ?>">
                
                <input id="nivel" type="hidden" name="nivel" value="<?php echo $_SESSION['usuario']['nivel']; ?>">

                <div class="row">
                  <div class="col-sm-3 col-sm-offset-6">
                    <div class="form-group">
                      <button class="btn btn-block btn-default btn-sm" id="btn-atualizar" type="button">
                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                        Resetar
                      </button>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <button class="btn btn-block btn-info btn-sm" id="btn-consultar" type="button">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        Consultar
                      </button>
                    </div>
                  </div>
                </div>
                
              </div><!-- primeira coluna principal -->
            </div><!-- linha principal -->
          
          </form>
        <?php endif; ?>

      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->

  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>  

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/avancoins/colaboradores.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/records/gera_relatorio_atrasos.js"></script>

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
