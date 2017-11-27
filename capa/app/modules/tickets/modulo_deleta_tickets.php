<?php

# verificando se houve requisição via método GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  # recuperando o número do ticket que será deletado
  $ticket = isset($_GET['ticket']) ? $_GET['ticket'] : '';

  # verificando se o número do ticket foi enviado
  if (! empty($ticket)) {

    require '../../../init.php';
    require DIRETORIO_FUNCTIONS . 'tickets/instrucoes_tickets.php';

    # abrindo conexão com a base de dados
    $db = abre_conexao();

    # chamando função que deleta um ticket
    deletaTicket($db, $ticket);

  }

  fecha_conexao($db);

  # redirecionando para a página de consulta de tickets
  header('Location: ' . BASE_URL . 'public/views/tickets/consulta_tickets.php');

}
