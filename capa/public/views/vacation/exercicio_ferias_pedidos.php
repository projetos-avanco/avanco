<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('exercicio_ferias_pedidos.php')) : ?>

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
      height: 47px;
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
              <h2>Registro de Pedidos</h2>
              <hr>
            </div>
          </div>
        </div>

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
                      <th class="text-center">Vencimento</th>
                      <th class="text-center">Registrado</th>
                      <th class="text-center" width="192"></th>
                    </tr>
                  </thead>
                  <tbody id="tbody">
                  </tbody>
                </table>
              </div><!-- panel-body -->
            </div><!-- panel -->

            <input type="hidden" id="id" name="id" value="<?php echo $_SESSION['usuario']['id']; ?>">
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">

            <div class="panel panel-info"><!-- panel -->
              <div class="panel-heading">
                <div class="text-left">
                  <strong>Pedido</strong>
                </div>
              </div>

              <div class="panel-body"><!-- panel-body -->
                <form>
                  <div class="row">
                    <div class="col-sm-5">
                      <div class="form-group">
                        <label for="data-inicial">Data Inicial</label>
                        <input class="form-control required" id="data-inicial" type="date" name="data-inicial" readonly>
                      </div>
                    </div>

                    <div class="col-sm-5">
                      <div class="form-group">
                        <label for="data-final">Data Final</label>
                        <input class="form-control required" id="data-final" type="date" name="data-final" readonly>
                      </div>
                    </div>

                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="dias">Dias</label>
                        <input class="form-control" id="dias" type="text" name="dias" placeholder="0" readonly>
                      </div>
                    </div>
                  </div>

                  <input class="form-control" id="id-exercicio" type="hidden" name="id-exercicio">

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
                        <button class="btn btn-block btn-success btn-sm" type="submit" name="submit" value="submit">
                          <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
                          Gravar
                        </button>
                      </div>
                    </div>
                  </div>

                </form>
              </div><!-- panel-body -->
            </div><!-- panel -->

          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">

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
                      <?php if (isset($_SESSION['ticket'])) : ?>
                        <?php echo $_SESSION['ticket']; ?>
                      <?php else : ?>
                        0
                      <?php endif; ?>
                    </strong>
                  </h1>
                </div>
              </div><!-- panel-body -->
            </div><!-- panel -->

          </div>
        </div>

      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/avancoins/colaboradores.js"></script> 
  <script src="<?php echo BASE_URL; ?>libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script> 

  <script>
    $(function() {
      $(document).ready(function(e) {
        e.preventDefault;
        var id = $('#id').val();

        if (id != 0) {
          $.ajax({
            type: 'post',
            url: '../../../app/requests/post/vacation/recebe_pedido_exercicio.php',
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

      $(document).on('click', '#agendar', function(e) {
        e.preventDefault;

        var exercicio = {};        

        $('#tbody .btn-sm').removeClass('btn-success');
        $('#tbody .btn-sm').addClass('btn-default');
        $(this).removeClass('btn-default');
        $(this).addClass('btn-success');

        exercicio.final = $(this).closest('tr').find('td[data-final]').data('final');
        exercicio.vencimento = $(this).closest('tr').find('td[data-vencimento]').data('vencimento');
        exercicio.id = $(this).val();

        var tmp = '';
        
        tmp = exercicio.final.split('/');        
        exercicio.final = tmp[2] + '-' + tmp[1] + '-' + tmp[0];

        tmp = exercicio.vencimento.split('/');

        if (tmp[1] == '01') {
          tmp[1] = '12';
          tmp[2] = parseInt(tmp[2]) - 1;
        } else {
          tmp[1] = parseInt(tmp[1]) - 1;
        }        

        if (tmp[1] <= 9) {
          tmp[1] = '0' + tmp[1];
        }

        exercicio.vencimento = tmp[2] + '-' + tmp[1] + '-' + tmp[0];
        console.log(exercicio.vencimento);
        $('#data-inicial').prop('readonly', false).prop('min', exercicio.final);
        $('#data-final').prop('readonly', false).prop('max', exercicio.vencimento);

        $('#id-exercicio').val(exercicio.id);
        $('#data-inicial').val(exercicio.final);
      });
    });
  </script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
