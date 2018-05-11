<?php

# verificando se houve requisição via método GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  # recuperando o número do ticket  e função que será executada
  $ticket = isset($_GET['ticket']) ? $_GET['ticket'] : '';
  $funcao = isset($_GET['funcao']) ? $_GET['funcao'] : '';

  # verificando se o número do ticket e o nome da função foram enviados
  if (! empty($ticket) AND ! empty($funcao)) {

    # verificando se será executada a função visualiza
    if ($funcao == 'visualiza') {

      require DIRETORIO_MODULES . 'tickets/modulo_tickets.php';

      $dados = array();

      $dados = recuperaDadosDaPaginaDeVisualizacaoDeTickets($dados, $ticket);
      
    # verificando se será executada a função edita
    } elseif ($funcao == 'edita') {
      
      require DIRETORIO_MODULES . 'tickets/modulo_tickets.php';

      $dados = array();

      $dados = recuperaDadosDaPaginaDeVisualizacaoDeTickets($dados, $ticket);
      
    # verificando se será executada a função deleta
    } elseif ($funcao == 'deleta') {

      require '../../../init.php';
      require DIRETORIO_MODULES . 'tickets/modulo_tickets.php';

      # chamando função que deleta um ticket
      deletaTicket($ticket);

    # verificando se será executada a função invalida
    } elseif ($funcao == 'invalida') {

      require '../../../init.php';
      require DIRETORIO_MODULES . 'tickets/modulo_tickets.php';

      # chamando função que invalida um ticket
      invalidaTicket($ticket);

    }

  }

}
