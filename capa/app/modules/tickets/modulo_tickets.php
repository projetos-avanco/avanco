<?php

/*
 * consulta e recupera todos os tickets gerados
 */
function recuperaTodosOsTicketsGerados()
{
  require DIRETORIO_MODELS    . 'tickets/modelo_tickets.php';
  require DIRETORIO_FUNCTIONS . 'tickets/instrucoes_tickets.php';

  # chamando função que cria o modelo de dados de tickets
  $tickets = criaModeloDeTickets();

  # abrindo conexão com a base de dados
  $db = abre_conexao();

  # chamando função que consulta todos os tickets gerados
  $tickets = consultaTodosOsTicketsGerados($db, $tickets);

  fecha_conexao($db);

  return $tickets;

}
