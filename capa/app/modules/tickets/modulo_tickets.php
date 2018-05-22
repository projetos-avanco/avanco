<?php

/*
 * responsável por consultar e recuperar os dados da página de consulta 
 */
function recuperaDadosDaPaginaDeConsultaDeTickets()
{
  require DIRETORIO_MODELS    . 'tickets/modelo_tickets.php';
  require DIRETORIO_FUNCTIONS . 'tickets/consultas_tickets.php';

  # chamando função que cria o modelo de dados de tickets
  $tickets = criaModeloDeTickets();

  # abrindo conexão com a base de dados
  $db = abre_conexao();

  $tickets = consultaDadosBasicosDosTickets($db, $tickets);

  fecha_conexao($db);

  return $tickets;
}

/**
 * reponsável por consultar e recuperar todos os dados de um ticket
 * @param - array modelo que irá receber os dados do ticket
 * @param - string com o número do ticket
 */
function recuperaDadosDaPaginaDeVisualizacaoDeTickets($dados, $ticket)
{
  require DIRETORIO_MODELS    . 'tickets/modelo_tickets.php';
  require DIRETORIO_FUNCTIONS . 'tickets/consultas_tickets.php';
  
  # abrindo conexão com a base de dados
  $db = abre_conexao();

  # chamando função que consulta todos os tickets gerados
  $dados = consultaDadosDaPaginaDeVisualizaoDeTickets($db, $dados, $ticket);

  fecha_conexao($db);

  return $dados;

}

/**
 * responsável por alterar um ticket
 * @param - array com os dados do ticket que será alterado
 */
function alteraTicket($ticket)
{
  require DIRETORIO_FUNCTIONS . 'tickets/altera_tickets.php';

  $db = abre_conexao();

  # chamando função que altera os dados de um ticket
  $resultado = alteraDadosDoTicket($db, $ticket);

  # verificando se os dados foram alterados
  if ($resultado) {

    gravaMensagemNaSessao('success', true, 'Certo', 'Os dados do ticket foram alterados com sucesso');

    redirecionaUsuarioParaEdicaoDeTickets($db, $_POST['ticket']['ticket']);

  } else {

    gravaMensagemNaSessao('danger', true, 'Ops', 'Os dados do ticket não foram alterados, houve erro durante a alteração dos dados');

    redirecionaUsuarioParaEdicaoDeTickets($db, $_POST['ticket']['ticket']);

  }

}

/**
 * responsável por deletar um ticket
 * @param - string com o número do ticket que será deletado
 */
function deletaTicket($ticket)
{
  require DIRETORIO_FUNCTIONS . 'tickets/instrucoes_tickets.php';

  # abrindo conexão com a base de dados
  $db = abre_conexao();

  # chamando função que deleta um ticket no banco de dados
  deletaTicketNoBancoDeDados($db, $ticket);

  fecha_conexao($db);

  # redirecionando usuário para a página de consulta de tickets
  header('Location: ' . BASE_URL . 'public/views/tickets/consulta_tickets_adm.php');

  exit;

}

/**
 * responsável por invalidar um ticket
 * @param - string com o número do ticket que será invalidado
 */
function invalidaTicket($ticket)
{
  require DIRETORIO_FUNCTIONS . 'tickets/instrucoes_tickets.php';

  # abrindo conexão com a base de dados
  $db = abre_conexao();

  # chamando função que invalida um ticket no banco de dados
  invalidaTicketNoBancoDeDados($db, $ticket);

  fecha_conexao($db);

  # redirecionando usuário para a página de consulta de tickets
  header('Location: ' . BASE_URL . 'public/views/tickets/consulta_tickets_adm.php');

  exit;

}
