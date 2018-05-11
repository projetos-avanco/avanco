<?php

/**
 * deleta um ticket
 * @param - objeto com uma conexão aberta
 * @param - string com o número do ticket que será deletado
 */
function deletaTicketNoBancoDeDados($db, $ticket)
{
  $query = "DELETE FROM av_tickets WHERE ticket = $ticket";

  $db->query($query);

}

/**
 * invalida um ticket
 * @param - objeto com uma conexão aberta
 * @param - string com o número do ticket que será invalidado
 */
function invalidaTicketNoBancoDeDados($db, $ticket)
{
  $query = "UPDATE av_tickets SET validade = 0 WHERE ticket = $ticket";

  $db->query($query);

}
