<?php

header('Content-Type: text/html; charset=UTF-8');

/**
 * responsável por verificar se o colaborador está online e redirecionar o cliente para ele
 * @param - array com o número do ticket
 */
function redirecionaParaColaboradorResponsavel($cliente, $colaboradores)
{
  require DIRETORIO_FUNCTIONS . 'tickets/funcoes_tickets.php';

  # chamando função que retorna uma conexão com a base de dados
  $db = abre_conexao();

  # chamando função que consulta os dados de agendamento do cliente
  $cliente = consultaDadosDoTicket($cliente, $db);

  # recuperando id do colaborador responsável pelo agendamento
  $colaboradores[0]['id'] = $cliente['colaborador'];

  unset($cliente['colaborador']);

  # criando sessão com o código do ticket enviado pelo portal avanço
  $_SESSION['agendamento']['ticket'] = $cliente['ticket'];

  # chamando função que verifica se o colaborador responsável pelo agendamento está online
  $colaboradores = verificaColaboradorAgendadoOnlineNoChat($colaboradores, $db);

  # chamando função que redireciona o cliente para o colaborador responsável pelo agendamento
  redirecionaClienteParaDepartamento($colaboradores, $cliente);

  $db->close();
}
