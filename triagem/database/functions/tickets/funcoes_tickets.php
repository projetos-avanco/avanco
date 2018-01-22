<?php

/**
 * consulta os dados de agendamento do ticket
 * @param - array com os dados do cliente
 * @param - objeto com uma conexão aberta
 */
function consultaDadosDoTicket($cliente, $db)
{
  $query =
    "SELECT
      cnpj,
      conta_contrato,
      razao_social,
      telefone,
      contato,
      colaborador,
      produto,
      modulo,
      assunto
    FROM av_tickets
    WHERE (ticket = {$cliente['ticket']})
      AND (validade = 1)";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    # recuperando dados do agendamento
    while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

      $cliente['cnpj']           = $registro['cnpj'];
      $cliente['conta_contrato'] = $registro['conta_contrato'];
      $cliente['razao_social']   = $registro['razao_social'];
      $cliente['telefone']       = $registro['telefone'];
      $cliente['nome']           = $registro['contato'];
      $cliente['colaborador']    = $registro['colaborador'];
      $cliente['produto']        = $registro['produto'];
      $cliente['modulo']         = $registro['modulo'];
      $cliente['duvida']         = $registro['assunto'];

    }

  } else {

    $msg = 'Erro ao executar a consulta de dados do ticket!';

    #retornando mensagem para o portal avanço
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);

    exit;

  }

  return $cliente;

}

/**
 * consulta o prazo de agendamento do ticket
 * @param - string com o número do ticket
 * @param - objeto com uma conexão aberta
 */
function consultaPrazoDoAgendamentoDoTicket($ticket, $db)
{
  $query =
    "SELECT 
      DATE_FORMAT(agendado, '%Y-%m-%d') AS data,
      DATE_FORMAT(agendado, '%T') AS hora,
      CASE
        WHEN (CURRENT_TIME() > DATE_FORMAT(agendado, '%T'))
          THEN TIMEDIFF(CURRENT_TIME(), DATE_FORMAT(agendado, '%T'))
        ELSE '0'
      END AS diferenca
    FROM av_tickets
    WHERE (ticket = $ticket);";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $agendado = array(

      'data_atual'    => date('Y-m-d'),
      'data_agendada' => '', 
      'hora_atual'    => date('H:i:s'),      
      'hora_agendata' => '',
      'diferenca'     => ''

    );

    # recuperando data e hora do agendamento
    while ($registro = $resultado->fetch_assoc()) {

      $agendado['data_agendada'] = $registro['data'];
      $agendado['hora_agendada'] = $registro['hora'];
      $agendado['diferenca']     = $registro['diferenca'];

    }

    return $agendado;

  }

}

/**
 * invalida um ticket
 * @param - string com o número do ticket
 * @param - objeto com uma conexão aberta
 */
function invalidaTicketForaDoPrazo($ticket, $db)
{
  $query = "UPDATE av_tickets SET validade = false WHERE (ticket = $ticket);";

  $db->query($query);

}