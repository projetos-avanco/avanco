<?php 

require '../init.php';

$db = abre_conexao();

# verificando se a conexão com a base de dados foi realizada com sucesso
if ($db) {

  $query =
  "SELECT
    ticket
  FROM av_tickets
  WHERE (validade = true)
    AND (DATE_FORMAT(agendado, '%Y-%m-%d') < CURRENT_DATE());"; 
  
  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $tickets = array();

    # recuperando tickets que já passaram do prazo de agendamento
    while ($registro = $resultado->fetch_assoc()) {

      $tickets[] = $registro['ticket'];

    }

  }

  # invalidando tickets 
  foreach ($tickets as $ticket) {
    
    $query = '';
    $query = "UPDATE av_tickets SET validade = false WHERE (ticket = $ticket);";

    $db->query($query);

  }

  $db->close();

}