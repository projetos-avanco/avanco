<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('atendimentos_remotos.php')) : ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Cadastro de Atendimento Remoto</title>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap_3.3.7.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>

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

    table thead tr th {
      font-size: 0.85em;
      text-align: left;
    }

    table tbody tr td {
      font-size: 0.75em;
      height: 1.5em;
    }


    .table tbody tr td {
      vertical-align: middle;
    }

    .contatos {
      font-size: 12px;
    }
  </style>
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <h2>Cadastro de Atendimento Remoto</h2>
              <hr>
            </div>
          </div>
        </div><!-- linha -->

        <form action="<?php echo BASE_URL; ?>app/requests/post/processa_atendimento_remoto.php" method="post">

          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <div class="form-group">
                <div class="input-group h2">
                  <span class="input-group-btn">
                    <button class="btn btn-primary" type="button">
                      <span class="glyphicon glyphicon-search"></span>
                    </button>
                  </span>
                  <input class="form-control" id="pesquisa" type="text" placeholder="Pesquise por CNPJ ou Razão Social">
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <div id="bloco">

                </div>

                <div class="hidden text-center" id="loader">
                  <img src="<?php echo BASE_URL; ?>public/img/others/loader.gif" alt="loader" width="10%" height="10%">
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <h5>Dados da Empresa</h5>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label class="sr-only" for="razao-social">Razão Social</label>
                <input class="form-control required" id="razao-social" type="text" placeholder="Razão Social" readonly="true">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="sr-only" for="cnpj">CNPJ</label>
                <input class="form-control required" id="cnpj" type="text" placeholder="CNPJ" readonly="true">
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label class="sr-only" for="conta-contrato">Conta Contrato</label>
                <input class="form-control required" id="conta-contrato" type="text" placeholder="Conta Contrato" readonly="true">
              </div>
            </div>
          </div>

          <input class="form-control required" id="id" type="hidden" name="remoto[id-cnpj]" value="">

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <h5>Dados do Contato</h5>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default">
                <div class="panel-body" id="contatos">

                </div>
              </div>
            </div>
          </div><!-- linha -->

          <div class="row">
            <div class="col-sm-6">

              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <h5>Dados do Atendimento</h5>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="sr-only" for="colaborador">Colaborador</label>
                    <select class="form-control required" id="colaborador" name="remoto[colaborador]">
                      <option value="0">Colaborador</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="sr-only" for="produto">Produto</label>

                    <select class="form-control required" id="produto" name="remoto[produto]">
                      <option value="0">Produto</option>
                      <option value="1">Integral</option>
                      <option value="2">Frente de Loja</option>
                      <option value="3">Gestor</option>
                      <option value="4">Novo ERP</option>
                    </select>
                  </div>
                </div>
              </div><!-- linha -->

              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="sr-only" for="modulo">Módulo</label>
                    <select class="form-control required" id="modulo" name="remoto[modulo]">
                      <option value="0">Módulo</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="sr-only" for="data">Data</label>
                    <input class="form-control required" id="data" type="text" name="remoto[data]" placeholder="Data">
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
                      <label class="sr-only" for="horario">Horário</label>
                      <input class="form-control required" id="horario" type="text" name="remoto[horario]" placeholder="Horário">
                    </div>
                  </div>
                </div>
              </div><!-- linha -->

            </div><!-- coluna 1 -->

            <div class="col-sm-6">

              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <h5>Dados Financeiros</h5>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="sr-only" for="tipo">Tipo</label>

                    <select class="form-control" id="tipo" name="remoto[tipo]">
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
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="sr-only" for="faturado">Faturado</label>
                    <select class="form-control" id="faturado" name="remoto[faturado]">
                      <option value="0" selected>Pedido Faturado?</option>
                      <option value="1">Sim</option>
                      <option value="2">Não</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="sr-only" for="cobranca">Cobrança</label>

                    <select class="form-control" id="cobranca" name="remoto[cobranca]">
                      <option value="0" selected>Tipo de Cobrança</option>
                      <option value="1">Hora</option>
                      <option value="2">Pacote</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                          <span class="glyphicon glyphicon-usd"></span>
                        </button>
                      </span>
                      <label class="sr-only" for="valor">Valor</label>
                      <input class="form-control" id="valor" type="text" name="remoto[valor]" placeholder="0.00">
                    </div>
                  </div>
                </div>
              </div>

            </div><!-- coluna 2 -->
          </div><!-- linha -->

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label class="sr-only" for="observacao">Observação</label>
                <textarea class="form-control required" id="observacao" name="remoto[assunto]" rows="2" cols="30" placeholder="Observações..."></textarea>
              </div>
            </div>
          </div>

          <input type="hidden" name="remoto[supervisor]" value="<?php echo $_SESSION['usuario']['id']; ?>">

          <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
              <div class="form-group">
                <div class="panel panel-primary">
                  <div class="panel-heading text-center"><strong>Registro</strong></div>
                  <div class="panel-body text-center">
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
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-2 col-sm-offset-8">
              <a class="btn btn-block btn-default" href="<?php echo BASE_URL; ?>public/views/screen/novo_ticket.php">
                Limpar
              </a>
            </div>

            <div class="col-sm-2">
              <button class="btn btn-block btn-primary" type="submit">
                Gravar
              </button>
            </div>
          </div>

        </form>
      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/pesquisa.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/seleciona.js"></script>
  <script src="<?php echo BASE_URL; ?>../tickets/public/js/screen/colaboradores.js"></script>
  <script src="<?php echo BASE_URL; ?>../tickets/public/js/screen/modulos.js"></script>

  <script>
    $(document).ready(function() {
      $('#id').change(function() {
        alert('mudou!');
      });

      $('#faturado').change(function() {
        var option = $('#faturado').val();

        if (option == '2') {
          $('#valor').attr('readonly', 'true');
          $('#cobranca').attr('disabled', 'true');
          $('#valor').val('0.00');
        } else {
          $('#cobranca').removeAttr('disabled');
          $('#valor').val('');
        }
      });

      $('#data').mask('00/00/0000');
      $('#horario').mask('00:00');
      $('#valor').mask('#0.00', {reverse: true});
    })
  </script>

  <script>
    $(function() {
      $(document).on('click', '#contatos .btn-xs', function(e) {
        e.preventDefault;

        $('#contatos .btn-xs.btn-success').removeClass('btn-success').addClass('btn-default');
        $(this).removeClass('btn-default').addClass('btn-success');

        var id = $(this).closest('tr').find('td[data-id]').data('id');
        var nome = $(this).closest('tr').find('td[data-nome]').data('nome');
        var fixo = $(this).
      });
    });
  </script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
