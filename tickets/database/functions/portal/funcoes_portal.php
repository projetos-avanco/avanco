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
      DATE_FORMAT(t.data_hora, '%d/%m/%Y') AS data,
      DATE_FORMAT(t.agendado, '%d/%m/%Y %T') AS agendado,
      t.ticket,
      CONCAT(u.name, ' ', u.surname) AS colaborador,
      assunto
    FROM av_tickets AS t
    INNER JOIN lh_users AS u
      ON u.id = t.colaborador
    WHERE (conta_contrato = $conta_contrato)
      AND (validade = 1);";

  # verificando se é possível executar a consulta
  if ($resultado = $db->query($query)) {

    $arr = array();

    # verificando se existem tickets válidos para o código de contra contrato recebido
    if ($resultado->num_rows > 0) {

      # recuperando dados dos tickets válidos (data, ticket, colaborador e assunto)
      while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

        $arr[] = array(
          'data'        => $registro['data'],
          'agendado'    => $registro['agendado'],
          'ticket'      => $registro['ticket'],
          'colaborador' => $registro['colaborador'],
          'assunto'     => $registro['assunto']
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
