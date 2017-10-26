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
