<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('exercicio_ferias_lancados.php')) : ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Exercício de Férias Lançados</title>

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
    
    .table {
      margin-bottom: 0;
    }

    table thead tr th {
      font-size: 0.90em;
      text-align: left;
    }

    table tbody tr td {
      height: 0.75em;
    }

    .table tbody tr td {
      font-size: 12px;
      vertical-align: middle;
    }

    .table {
      font-family: 'Lato Regular', sans-serif;
    }
  </style>
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <h2>Relatório de Exercícios Lançados</h2>
              <hr>
            </div>
          </div>
        </div>

        <form>

          <div class="row"><!-- linha principal -->
            <div class="col-sm-6 col-sm-offset-3"><!-- primeira coluna principal -->

              <div class="row"><!-- painel atendimentos -->
                <div class="col-sm-12">

                  <div class="panel panel-info"><!-- panel -->
                    <div class="panel-heading">
                      <div class="text-left">
                        <strong>Filtros</strong>
                      </div>
                    </div>

                    <div class="panel-body"><!-- panel-body -->
                      <div class="row">
                        <div class="col-sm-7">
                          <div class="form-group">
                            <label class="sr-only" for="colaborador">Lista Colaboradores</label>
                            <select class="form-control required" id="colaborador">

                            </select>
                          </div>
                        </div>

                        <div class="col-sm-5">
                          <div class="form-group">
                            <label class="sr-only" for="status">Status</label>
                            <select class="form-control" id="status">
                              <option value="" selected>Situação</option>
                              <option value="0">Férias Não Agendadas</option>
                              <option value="1">Férias Agendadas</option>
                            </select>
                          </div>
                        </div>
                      </div>                  
                    </div><!-- panel-body -->                    
                  </div><!-- panel -->

                </div>
              </div><!-- painel atendimentos -->

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
                    <button class="btn btn-block btn-info btn-sm" id="btn-consultar" type="button">
                      <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                      Consultar
                    </button>
                  </div>
                </div>
              </div>

            </div><!-- primeira coluna principal -->
          </div><!-- linha principal -->

          <div class="row">
            <div class="col-sm-12"><!-- segunda coluna principal -->

              <div class="row">
                <div class="col-sm-12">

                  <div class="panel panel-info"><!-- panel -->
                    <div class="panel-heading">
                      <div class="text-left">
                        <strong>Exercícios</strong>
                      </div>
                    </div>

                    <div class="panel-body"><!-- panel-body -->
                      <table class="table table-condesend">
                        <thead>
                          <tr>                            
                            <th class="text-center">Supervisor</th>
                            <th class="text-center">Colaborador</th>
                            <th class="text-center">Situação</th>
                            <th class="text-center">Exercício Inicial</th>
                            <th class="text-center">Exercício Final</th>
                            <th class="text-center">Data Limite</th>
                            <th class="text-center">Registrado</th>
                            <th class="text-center" width="192"></th>
                          </tr>
                        </thead>
                        <tbody id="tbody">
                        </tbody>
                      </table>
                    </div><!-- panel-body -->
                  </div><!-- panel -->

                </div>
              </div>

            </div>
          </div><!-- segunda coluna principal -->

        </form>

      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/vacation/colaboradores.js"></script>  

  <script>
    $(function() {
      $(document).ready(function(e) {
        e.preventDefault;
        
        var id = -1;

        $.ajax({
          type: 'post',
          url: '../../../app/requests/post/vacation/recebe_pedido_exercicio.php',
          dataType: 'html',
          data: {
            id: id              
          },
          success: function(tr) {
            $('#tbody').html(tr);
          },
          error: function(resposta) {
            console.log(resposta);
          }
        });
      });

      // consultando exercícios de férias
      $(document).on('click', '#btn-consultar', function(e) {
        e.preventDefault;

        var id = $('#colaborador').val();
        var status = $('#status').val();

        if (id != 0) {
          $.ajax({
            type: 'post',
            url: '../../../app/requests/post/vacation/recebe_consulta_exercicio.php',
            dataType: 'html',
            data: {
              id: id,
              status: status
            },
            success: function(tr) {
              $('#tbody').html(tr);
            },
            error: function(resposta) {
              console.log(resposta);
            }
          });
        } else {
          alert('Selecione um Colaborador!');
        }
      });

      // deletando um exercício de férias e seus pedidos de férias
      $(document).on('click', '#btn-deletar', function(e) {
        e.preventDefault;

        var id = $(this).val();
        
        var confirmacao = confirm('Confirma a deleção do exercício de férias?');

        if (confirmacao) {
          $.ajax({
            type: 'post',
            url: '../../../app/requests/post/vacation/recebe_delecao_pedido_exercicio.php',
            dataType: 'json',
            data: {
              id: id
            },
            success: function(resposta) {
              if (resposta) {
                location.reload();
              } else {
                alert(resposta);
              }
            },
            error: function(resposta) {
              console.log(resposta);
            }
          });
        }
      });
    });
  </script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
