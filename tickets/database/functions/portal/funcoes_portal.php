<?php

header('Content-Type: text/html; charset=utf-8');

/**
 * consulta os tickets válidos referentes a uma conta contrato
 * @param - string com o código de conta contrato
 * @param - objeto com uma conexão aberta
 */
function consultaTicketsValidos($conta_contrato, $db)
{
  $query =
    "SELECT
      a.ticket,
      a.assunto,
      a.agendado,
      a.tecnico,
      CASE
        WHEN ((a.validade = true OR a.validade = false) AND a.chat_id > 0)
          THEN ('Atendido')
        WHEN (a.validade = true AND a.chat_id = 0)	
          THEN ('Em Aberto')
        WHEN (a.validade = false AND a.chat_id = 0)
          THEN ('Finalizado')
      END AS status,
      a.chat_id
    FROM
      (SELECT	
        t.conta_contrato,
        t.ticket,	
        assunto,
        t.agendado,
        CONCAT(u.name, ' ', u.surname) AS tecnico,	
        CASE
          WHEN (t.chat_id IS NULL)
            THEN (0)
          ELSE (t.chat_id)
        END AS chat_id,
        t.validade
      FROM av_tickets AS t
      INNER JOIN lh_users AS u
      ON u.id = t.colaborador) AS a
    WHERE (conta_contrato = $conta_contrato)
    ORDER BY a.agendado DESC, a.ticket DESC;";

  # verificando se é possível executar a consulta
  if ($resultado = $db->query($query)) {

    $arr = array();

    # verificando se existem tickets válidos para o código de contra contrato recebido
    if ($resultado->num_rows > 0) {

      # recuperando dados dos tickets válidos (data, ticket, colaborador e assunto)
      while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

        $arr[] = array(

          'ticket'      => $registro['ticket'],
          'assunto'     => $registro['assunto'],
          'agendado'    => $registro['agendado'],
          'tecnico'     => $registro['tecnico'],
          'status'      => $registro['status'],
          'chat_id'     => $registro['chat_id'],
                    
        );

      }

    }

    $contador = count($arr);

    # verificando a quantidade de tickets gerados para o código de conta contrato recebido
    if ($contador > 0) {

      # enviando array com os dados para o portal avanço
      echo json_encode($arr, JSON_UNESCAPED_UNICODE);
          
    } else {

      # enviando null para o portal avanço
      echo json_encode(NULL);

    }

    exit;

  } else {

    $msg = 'Erro ao executar a consulta de tickets válidos!';

    # retornando mensagem para o portal avanço
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);

    exit;

  }

  $db->close();

}
