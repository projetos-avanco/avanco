<?php require '../../../init.php'; ?>
<?php require DIRETORIO_HELPERS . 'datas.php'; ?>

<?php if (verificaUsuarioLogado('relatorio_atrasos.php')) : ?>

<?php 
  $dataInicial = date('Y-m-d');
  $dataFinal = date('Y-m-d');
?>

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
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/schedule/gerencial_atendimento_externo.css">

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
                        <input class="form-control" id="data-inicial" type="date" name="data-inicial" value="<?php echo $dataInicial; ?>" placeholder="Data Inicial">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="data-final">Data Final</label>
                        <input class="form-control" id="data-final" type="date" name="data-final" value="<?php echo $dataFinal; ?>" placeholder="Data Final">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="colaborador">Colaborador</label>
                        <select class="form-control" id="colaborador" name="colaborador">

                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="tipo-atendimento">Tipo de Atendimento</label>
                        <select class="form-control" id="tipo-atendimento" name="tipo-atendimento">
                          <option value="" selected>Selecione um Tipo</option>
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
                        <label for="produto">Produto</label>
                        <select class="form-control" id="produto" name="produto">
                          <option value="" selected>Selecione um Produto</option>
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
                    <button class="btn btn-block btn-success btn-sm" id="btn-consultar" type="button">
                      <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                      Consultar
                    </button>
                  </div>
                </div>
              </div>
              
            </div><!-- segunda coluna principal -->
          </div><!-- linha principal -->
        
        </form>

        <div class="row"><!-- painel registro -->
          <div class="col-sm-12">

            <div class="panel panel-info"><!-- panel -->
              <div class="panel-heading">
                <div class="text-left">
                  <strong>Relatório</strong>
                </div>
              </div>

              <div class="panel-body" id="tabela-relatorio"><!-- panel-body -->
                
              </div><!-- panel-body -->
            </div><!-- panel -->

          </div>
        </div><!-- painel registro -->

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
  <script src="<?php echo BASE_URL; ?>public/js/avancoins/colaboradores.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/pesquisa.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/seleciona_empresa.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/direciona_usuario.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/remote/atualiza_pagina.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/remote/gera_relatorio_gerencial.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/remote/visualizar_atendimento_remoto.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/remote/cancelar_atendimento_remoto.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/remote/visualizar_relatorio_horas.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/remote/editar_relatorio_horas.js"></script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
