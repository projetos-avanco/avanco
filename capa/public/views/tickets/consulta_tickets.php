<?php require '../../../init.php'; ?>

<?php require DIRETORIO_MODULES . 'tickets/modulo_tickets.php'; ?>

<?php

  $tickets = array();

  # chamando função que consulta e recupera os dados da página de consulta de tickets
  $tickets = recuperaDadosDaPaginaDeConsultaDeTickets();

?>

<?php if (verificaUsuarioLogado('consulta_tickets.php')) : ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Consulta de Tickets</title>

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
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/tickets/tabela_tickets.css">

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
                  <th class="text-center">Colaborador</th>
                  <th class="text-center" width="10%">Agendamento</th>                  
                  <th class="text-center">Chat</th>                  
                  <th class="text-center" width="20%">Razão Social</th>                  
                  <th class="text-center">Validade</th>

                <?php if ($_SESSION['usuario']['nivel'] == 1) : ?>
                  <th class="text-center" width="20%"></th>
                <?php elseif ($_SESSION['usuario']['nivel'] == 2) : ?>                    
                  <th class="text-center" width="40%"></th>                
                <?php endif; ?>

                </tr>
              </thead>
              <tbody>
              <?php foreach($tickets as $ticket) : ?>
                <tr>
                  <td class="text-center"><?php echo $ticket['data']; ?></td>
                  <td class="text-center"><?php echo $ticket['ticket']; ?></td>
                  <td class="text-center"><?php echo $ticket['colaborador']; ?></td>
                  <td class="text-center"><?php echo $ticket['data_agendada'] . ' ' . $ticket['hora_agendada']; ?></td>                  

                <?php if ($ticket['chat_id'] != 0) : ?>
                  <td class="text-center">
                    <a href="<?php echo BASE_URL; ?>app/requests/get/recebe_chat_id.php?chat=<?php echo $ticket['chat_id']; ?>" target="_blank">
                      <?php echo $ticket['chat_id']; ?>
                    </a>
                  </td>
                <?php else : ?>
                  <td class="text-center"><?php echo $ticket['chat_id']; ?></td>
                <?php endif; ?>
                  
                  <td class="text-left"><?php echo $ticket['razao_social']; ?></td>
                  <td class="text-center"><?php echo $ticket['validade']; ?></td>
                
                <?php if ($_SESSION['usuario']['nivel'] == 1) : ?>
                  <td class="text-right">
                    <a class="btn btn-sm btn-success" href="<?php echo BASE_URL; ?>public/views/tickets/visualiza_tickets.php?ticket=<?php echo $ticket['ticket']; ?>&funcao=visualiza">
                      <i class="fa fa-eye" aria-hidden="true"></i> Visualizar
                    </a>
                  </td>
                <?php elseif ($_SESSION['usuario']['nivel'] == 2) : ?>
                  <td class="text-right">
                    <a class="btn btn-sm btn-info" href="<?php echo BASE_URL; ?>app/requests/get/processa_ticket.php?ticket=<?php echo $ticket['ticket']; ?>&funcao=invalida">
                      <i class="fa fa-times-circle" aria-hidden="true"></i> Invalidar
                    </a>

                    <a class="btn btn-sm btn-success" href="<?php echo BASE_URL; ?>public/views/tickets/visualiza_tickets.php?ticket=<?php echo $ticket['ticket']; ?>&funcao=visualiza">
                      <i class="fa fa-eye" aria-hidden="true"></i> Visualizar
                    </a>

                    <a class="btn btn-sm btn-warning" href="<?php echo BASE_URL; ?>public/views/tickets/edita_tickets.php?ticket=<?php echo $ticket['ticket']; ?>&funcao=edita">
                      <i class="fa fa-pencil" aria-hidden="true"></i> Editar
                    </a>
                
                    <a class="btn btn-sm btn-danger" onclick="confirmaExclusaoTicket();">
                      <i class="fa fa-trash" aria-hidden="true"></i> Deletar
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/locale/pt-br.js"></script>
  <script src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/tickets/paginacao_tabela.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/tickets/exclusao_ticket.js"></script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
