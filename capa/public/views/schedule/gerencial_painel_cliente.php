<?php require '../../../init.php'; ?>
<?php require DIRETORIO_HELPERS . 'datas.php'; ?>

<?php if (verificaUsuarioLogado('gerencial_painel_cliente.php')) : ?>

<?php $data = date('Y-m-d'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Consulta Gerencial Painel do Cliente</title>

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
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/schedule/gerencial_atendimento_externo.css">

  <!-- dispositivos com largura máxima de 769px (por exemplo tablets) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbartablet.css" type="text/css" media="screen and (max-width: 769px)" />
  <!-- dispositivos com largura máxima de 450px (por exemplo smartphones) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbarsmart.css" type="text/css" media="screen and (max-width:450px)" />

  <style>
    .swal-text {
      font-size: 15px;
      padding: 12px;
      display: block;
      margin: 22px;
      text-align: left;
      color: #61534e;
    }
  </style>
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <h2>Consulta Gerencial Painel do Cliente</h2>
              <hr>
            </div>
          </div>
        </div>

        <div class="row"><!-- indicadores de atendimento -->
          <div class="col-sm-4">
            <div class="panel panel-info"><!-- panel -->
              <div class="panel-heading">
                <div class="text-left">
                  <strong>Localização</strong>
                </div>
              </div>

              <div class="panel-body"><!-- panel-body -->
                <div class="row">
                  <div class="col-sm-12">
                    <label for="regiao-cliente">Região Cliente</label>
                    <input class="form-control" id="regiao-clinte" type="text" placeholder="" readonly>
                  </div>
                </div>
              </div><!-- panel-body -->
            </div><!-- panel -->
          </div>

          <div class="col-sm-8">
            <div class="panel panel-info"><!-- panel -->
              <div class="panel-heading">
                <div class="text-left">
                  <strong>Indicadores Atendimento</strong>
                </div>
              </div>

              <div class="panel-body"><!-- panel-body -->
                <div class="row">
                  <div class="col-sm-3">
                    <label for="atendimentos-realizados">Atendimentos Realizados</label>
                    <input class="form-control" id="atendimentos-realizados" type="text" value="0" readonly>
                  </div>

                  <div class="col-sm-3">
                    <label for="percentual-perda">Percentual Perda</label>
                    <input class="form-control" id="percentual-perda" type="text" value="0%" readonly>
                  </div>

                  <div class="col-sm-3">
                    <label for="percentual-avancino">Percentual Avancino</label>
                    <input class="form-control" id="percentual-avancino" type="text" value="0%" readonly>
                  </div>

                  <div class="col-sm-3">
                    <label for="percentual-fila">Percentual Fila 15 Min</label>
                    <input class="form-control" id="percentual-fila" type="text" value="0%" readonly>
                  </div>
                </div>
              </div><!-- panel-body -->
            </div><!-- panel -->
          </div>
        </div><!-- indicadores de atendimento -->

        <div class="row"><!-- painel atendimento externo - últimos 6 meses -->
          <div class="col-sm-12">
            <div class="panel panel-info"><!-- panel -->
              <div class="panel-heading">
                <div class="text-left">
                  <strong>Atendimento Externo - Últimos 6 Meses</strong>
                </div>
              </div>

              <div class="panel-body" id="tabela-relatorio-externo-ulti"><!-- panel-body -->
                
              </div><!-- panel-body -->
            </div><!-- panel -->
          </div>
        </div><!-- painel atendimento externo - últimos 6 meses -->

        <div class="row"><!-- painel gestão clientes - últimos 6 meses -->
          <div class="col-sm-12">
            <div class="panel panel-info"><!-- panel -->
              <div class="panel-heading">
                <div class="text-left">
                  <strong>Gestão Clientes - Últimos 6 Meses</strong>
                </div>
              </div>

              <div class="panel-body" id="tabela-relatorio-gestao-ulti"><!-- panel-body -->
                
              </div><!-- panel-body -->
            </div><!-- panel -->
          </div>
        </div><!-- painel gestão clientes - últimos 6 meses -->

        <div class="row"><!-- painel atendimento externo - próximos 6 meses -->
          <div class="col-sm-12">
            <div class="panel panel-info"><!-- panel -->
              <div class="panel-heading">
                <div class="text-left">
                  <strong>Atendimento Externo - Próximos 6 Meses</strong>
                </div>
              </div>

              <div class="panel-body" id="tabela-relatorio-externo-prox"><!-- panel-body -->
                
              </div><!-- panel-body -->
            </div><!-- panel -->
          </div>
        </div><!-- painel atendimento externo - próximos 6 meses -->

        <div class="row"><!-- painel gestão clientes - próximos 6 meses -->
          <div class="col-sm-12">
            <div class="panel panel-info"><!-- panel -->
              <div class="panel-heading">
                <div class="text-left">
                  <strong>Gestão Clientes - Próximos 6 Meses</strong>
                </div>
              </div>

              <div class="panel-body" id="tabela-relatorio-gestao-prox"><!-- panel-body -->
                
              </div><!-- panel-body -->
            </div><!-- panel -->
          </div>
        </div><!-- painel gestão clientes - próximos 6 meses -->
        
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

              <input type="hidden" id="id" name="id-cnpj">
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
                </div><!-- panel-body -->
              </div><!-- panel -->

              <input id="supervisor" type="hidden" name="supervisor" value="<?php echo $_SESSION['usuario']['id']; ?>">

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
            </div><!-- segunda coluna principal -->
          </div><!-- linha principal -->
        
        </form>

      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->

  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/pesquisa.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/seleciona_empresa.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/direciona_usuario.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/customers/atualiza_pagina.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/customers/reports/gera_indicadores_atendimento.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/customers/reports/gera_relatorio_externo_ulti.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/customers/reports/gera_relatorio_gestao_ulti.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/customers/reports/gera_relatorio_externo_prox.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/customers/reports/gera_relatorio_gestao_prox.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/customers/views/visualizar_atendimento_gestao_ulti.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/customers/views/visualizar_atendimento_externo_ulti.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/customers/views/visualizar_pesquisa_externa_ulti.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/customers/views/visualizar_relatorio_horas_ulti.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/customers/views/visualizar_atendimento_gestao_prox.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/customers/views/visualizar_atendimento_externo_prox.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/customers/views/visualizar_pesquisa_externa_prox.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/customers/views/visualizar_relatorio_horas_prox.js"></script>
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
