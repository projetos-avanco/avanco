<?php

/**
 * altera os dados de um ticket
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do ticket
 */
function alteraDadosDoTicket($db, $ticket)
{  
  $query = 
    "UPDATE av_tickets 
      SET colaborador =  {$ticket['colaborador']}, 
          agendado    = '{$ticket['agendado']}', 
          produto     =  {$ticket['produto']}, 
          modulo      =  {$ticket['modulo']}, 
          assunto     = '{$ticket['assunto']}', 
          contato     = '{$ticket['contato']}', 
          telefone    = '{$ticket['telefone']}' 
    WHERE (ticket = {$ticket['ticket']});";

  # executando a consulta
  $resultado = $db->query($query);

  return $resultado;

}