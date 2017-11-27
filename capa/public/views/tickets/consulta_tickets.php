<?php require '../../../init.php'; ?>
<?php require DIRETORIO_MODULES . 'tickets/modulo_tickets.php'; ?>

<?php  
  $tickets = array();

  # chamando função que consulta e recupera todos os tickets gerados
  $tickets = recuperaTodosOsTicketsGerados();

?>

<?php if (verificaUsuarioLogado('consulta_tickets.php')) : ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>CAPA - Consulta de Tickets</title>

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

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/home.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/sidebar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/tickets/tabela_tickets.css">
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <h2>Consulta de Tickets</h2>

            <hr>
          </div>
        </div><!-- linha -->

        <br>

        <div class="row">
          <div class="col-sm-12">
            <table class="table"><!-- painel do suporte -->
              <thead>
                <tr>
                  <th class="text-center">Data</th>
                  <th class="text-center">Ticket</th>
                  <th class="text-center">Chat</th>
                  <th class="text-center">Válido</th>
                  <th class="text-center">Contato</th>
                  <th class="text-center">CNPJ</th>
                  <th class="text-center" width="15%">Razão Social</th>
                  <th class="text-center">Gerado</th>
                  <th class="text-center">Agendado</th>
                  <th class="text-center">Produto</th>
                  <th class="text-center">Módulo</th>
                  <th class="text-center" width="15%">Assunto</th>
                <?php if ($_SESSION['usuario']['nivel'] == 2) : ?>
                  <th class="text-center"></th>
                <?php endif; ?>
                </tr>
              </thead>
              <tbody>
              <?php foreach($tickets as $ticket) : ?>
                <tr>
                  <td class="text-left"><?php echo $ticket['data']; ?></td>
                  <td class="text-center"><?php echo $ticket['ticket']; ?></td>
                  <td class="text-center"><?php echo $ticket['chat_id']; ?></td>
                  <td class="text-center"><?php echo $ticket['validade']; ?></td>
                  <td class="text-center"><?php echo $ticket['contato']; ?></td>
                  <td class="text-left"><?php echo $ticket['cnpj']; ?></td>
                  <td class="text-left"><?php echo $ticket['razao_social']; ?></td>
                  <td class="text-center"><?php echo $ticket['supervisor']; ?></td>
                  <td class="text-center"><?php echo $ticket['colaborador']; ?></td>
                  <td class="text-center"><?php echo $ticket['produto']; ?></td>
                  <td class="text-center"><?php echo $ticket['modulo']; ?></td>
                  <td class="text-left"><?php echo $ticket['assunto']; ?></td>
                <?php if ($_SESSION['usuario']['nivel'] == 2) : ?>
                  <td>
                    <a class="btn btn-sm btn-danger" href="<?php echo BASE_URL; ?>/app/modules/tickets/modulo_deleta_tickets.php?ticket=<?php echo $ticket['ticket']; ?>">
                      <i class="fa fa-trash-o" aria-hidden="true"></i> Deletar
                    </a>
                  </td>
                <?php endif; ?>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table><!-- painel do suporte -->
          </div>
        </div>
      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->
  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery_3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/panels/atualizacao_automatica.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/tickets/paginacao_tabela.js"></script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
