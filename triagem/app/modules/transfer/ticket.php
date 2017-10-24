<?php

/**
 * responsável por verificar se o colaborador está online e redirecionar o cliente para ele
 * @param - array com o número do ticket
 */
function redirecionaParaColaboradorResponsavel($cliente, $colaboradores)
{
  require DIRETORIO_FUNCTIONS . 'tickets/funcoes_tickets.php';

  $db = abre_conexao();

  $cliente = consultaDadosDoTicket($cliente, $db);

  $colaboradores[0]['id'] = $cliente['colaborador'];

  unset($cliente['colaborador']);

  criaSessaoDeCliente($cliente);

  $colaboradores = verificaColaboradorAgendadoOnlineNoChat($colaboradores, $db);

  redirecionaClienteParaDepartamento($colaboradores, $cliente);

  $db->close();
}
