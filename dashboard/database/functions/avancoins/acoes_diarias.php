<?php

/**
 * insere as ações diárias na tabela de logs de ações diárias
 * @param - objeto com uma conexão aberta
 * @param - array com as ações diárias do colaborador no período atual
 */
function insereAcoesDiarias($db, $acoes)
{
  $colunas = null;
  $valores = null;

  $queries = array();

  # montando consultas para inserção das ações diárias na tabela de logs de ações diárias
  foreach ($acoes as $acao) {

    foreach ($acao as $chave => $valor) {

      $colunas .= trim($chave, "'") . ', ';
      $valores .= "'$valor', ";

    }

    $colunas = rtrim($colunas, ', ');
    $valores = rtrim($valores, ', ');

    $queries[] = "INSERT INTO av_avancoins_acoes_diarias_logs " . "($colunas)" . " VALUES " . "($valores);";

    $colunas = null;
    $valores = null;

  }

  # inserindo ações diárias na tabela de logs de ações diárias
  foreach ($queries as $chave => $valor) {

    $db->query($valor);

  }

}

/**
 * retorna os logs de acões diárias existentes no período atual
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 */
function retornaLogsDeAcoesDiarias($db, $carteira)
{
  $query =
    "SELECT
    	id_chat
    FROM av_avancoins_acoes_diarias_logs
    WHERE (id_colaborador = {$carteira['id_colaborador']})
    	AND (data_acao BETWEEN '{$carteira['periodo_atual']['data_inicial']}' AND '{$carteira['periodo_atual']['data_final']}')
    ORDER BY id_chat, data_acao, horario_acao;";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $logs = array();

    # recuperando logs de ações diárias existentes no período atual
    while ($registro = $resultado->fetch_assoc()) {

      $logs[] = 'c.id = ' . $registro['id_chat'] . ' OR ';

    }

  }

  return $logs;

}

/**
 * remove as ações existentes na tabela de logs do array de ações diárias do colaborador no período atual
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 * @param - array com logs de ações diárias existentes no período atual
 */
 function removeAcoesDiariasRepetidas($db, $carteira, $logs)
 {
  $valores = null;

  # transformando os valores do array de ações diárias em uma string para consulta
  foreach ($logs as $chave => $valor) {

    $valores .= $valor;

  }

  $valores = rtrim($valores, ' OR ');

  $data = date('Y-m-d');
   
  # verificando se a data atual está no período da campanha da base de conhecimento
  if ($data >= '2018-04-02' AND $data <= '2018-04-06') {

    $query =    
      "SELECT
        c.user_id AS id_colaborador,
        CASE
          WHEN (i.equipe <> 4 AND i.equipe <> 5 AND i.utilizou_base_conhecimento = 'Nao')
            THEN 1
          WHEN (i.equipe = 4)
            THEN 2
          WHEN (i.equipe = 5)
            THEN 3
          WHEN (i.equipe <> 4 AND i.equipe <> 5 AND i.utilizou_base_conhecimento = 'Sim')
            THEN 4
        END AS id_acao_diaria,
        c.id AS id_chat,	
        FROM_UNIXTIME(c.time, '%Y-%m-%d') AS data_acao,
        FROM_UNIXTIME(c.last_user_msg_time, '%H:%i:%s') AS horario_acao
      FROM lh_chat AS c
      INNER JOIN av_questionario_interno AS i
        ON i.id_chat = c.id
      WHERE (c.user_id = {$carteira['id_colaborador']})
        AND (c.status = 2)
        AND NOT ($valores)
        AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$carteira['periodo_atual']['data_inicial']}' AND '{$carteira['periodo_atual']['data_final']}')
      ORDER BY id_chat, data_acao, horario_acao;";

    # verificando se a consulta pode ser executada
    if ($resultado = $db->query($query)) {

      $acoes = array();

      # recuperando todas as ações diárias do colaborador no período atual
      while ($registro = $resultado->fetch_assoc()) {

        # verificando se a ação diária é de atendimento realizado com auxílio da base de conhecimento
        if ($registro['id_acao_diaria'] == '4') {

          $query = "SELECT id FROM lh_msg WHERE (chat_id = {$registro['id_chat']}) AND (msg LIKE '%bc.avancoinfo.com.br%');";
          
          $objeto = $db->query($query);
          
          # verificando se no atendimento não foi enviado o link do documento da base de conhecimento
          if ($objeto->num_rows == 0) {

            # alterando o id da ação diária para atendimento realizado
            $registro['id_acao_diaria'] = '1';

          }

        }

        $acoes[] = array(
          
          'id_colaborador' => $registro['id_colaborador'],
          'id_acao_diaria' => $registro['id_acao_diaria'],
          'id_chat'        => $registro['id_chat'],
          'data_acao'      => $registro['data_acao'],
          'horario_acao'   => $registro['horario_acao']

        );
        
      }

    }

  # verificando se a data atual está fora do período da campanha da base de conhecimento  
  } else {

    $query =
    "SELECT
      c.user_id AS id_colaborador,
      CASE
        WHEN (i.equipe = 4)
          THEN 2
        WHEN (i.equipe = 5)
          THEN 3
        ELSE 1
      END AS id_acao_diaria,
      c.id AS id_chat,
      FROM_UNIXTIME(c.time, '%Y-%m-%d') AS data_acao,
      FROM_UNIXTIME(c.last_user_msg_time, '%H:%i:%s') AS horario_acao
    FROM lh_chat AS c
    INNER JOIN av_questionario_interno AS i
      ON i.id_chat = c.id
    WHERE (c.user_id = {$carteira['id_colaborador']})
      AND (c.status = 2)
      AND NOT ($valores)
      AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$carteira['periodo_atual']['data_inicial']}' AND '{$carteira['periodo_atual']['data_final']}')
    ORDER BY id_chat, data_acao, horario_acao;";

    # verificando se a consulta pode ser executada
    if ($resultado = $db->query($query)) {

      $acoes = array();

      # recuperando novas ações diárias
      while ($registro = $resultado->fetch_assoc()) {

        $acoes[] = array(

          'id_colaborador' => $registro['id_colaborador'],
          'id_acao_diaria' => $registro['id_acao_diaria'],
          'id_chat'        => $registro['id_chat'],
          'data_acao'      => $registro['data_acao'],
          'horario_acao'   => $registro['horario_acao']

        );

      }     

    }

  }

  return $acoes;

 }

/**
 * consulta todas as ações diárias do colaborador no período atual
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 */
function consultaAcoesDiarias($db, $carteira)
{
  $data = date('Y-m-d');
  
  # verificando se a data atual está no período da campanha da base de conhecimento
  if ($data >= '2018-04-02' AND $data <= '2018-04-06') {

    $query =
      "SELECT
        c.user_id AS id_colaborador,
          CASE
            WHEN (i.equipe <> 4 AND i.equipe <> 5 AND i.utilizou_base_conhecimento = 'Nao')
              THEN 1
            WHEN (i.equipe = 4)
              THEN 2
            WHEN (i.equipe = 5)
              THEN 3
            WHEN (i.equipe <> 4 AND i.equipe <> 5 AND i.utilizou_base_conhecimento = 'Sim')
              THEN 4
          END AS id_acao_diaria,
        c.id AS id_chat,	
        FROM_UNIXTIME(c.time, '%Y-%m-%d') AS data_acao,
        FROM_UNIXTIME(c.last_user_msg_time, '%H:%i:%s') AS horario_acao
      FROM lh_chat AS c
      INNER JOIN av_questionario_interno AS i
        ON i.id_chat = c.id
      WHERE (c.user_id = {$carteira['id_colaborador']})
        AND (c.status = 2)
        AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$carteira['periodo_atual']['data_inicial']}' AND '{$carteira['periodo_atual']['data_final']}')
      ORDER BY id_chat, data_acao, horario_acao;";

    # verificando se a consulta pode ser executada
    if ($resultado = $db->query($query)) {

      $acoes = array();

      # recuperando todas as ações diárias do colaborador no período atual
      while ($registro = $resultado->fetch_assoc()) {

        # verificando se a ação diária é de atendimento realizado com auxílio da base de conhecimento
        if ($registro['id_acao_diaria'] == '4') {

          $query = "SELECT id FROM lh_msg WHERE (chat_id = {$registro['id_chat']}) AND (msg LIKE '%bc.avancoinfo.com.br%');";
          
          $objeto = $db->query($query);
          
          # verificando se no atendimento não foi enviado o link do documento da base de conhecimento
          if ($objeto->num_rows == 0) {

            # alterando o id da ação diária para atendimento realizado
            $registro['id_acao_diaria'] = '1';

          }

        }

        $acoes[] = array(
          
          'id_colaborador' => $registro['id_colaborador'],
          'id_acao_diaria' => $registro['id_acao_diaria'],
          'id_chat'        => $registro['id_chat'],
          'data_acao'      => $registro['data_acao'],
          'horario_acao'   => $registro['horario_acao']

        );
        
      }

    }

  # verificando se a data atual está fora do período da campanha da base de conhecimento
  } else { 

    $query =
      "SELECT
        c.user_id AS id_colaborador,
          CASE
            WHEN (i.equipe = 4)
              THEN 2
            WHEN (i.equipe = 5)
              THEN 3
            ELSE 1
          END AS id_acao_diaria,
        c.id AS id_chat,
        FROM_UNIXTIME(c.time, '%Y-%m-%d') AS data_acao,
        FROM_UNIXTIME(c.last_user_msg_time, '%H:%i:%s') AS horario_acao
      FROM lh_chat AS c
      INNER JOIN av_questionario_interno AS i
        ON i.id_chat = c.id
      WHERE (c.user_id = {$carteira['id_colaborador']})
        AND (c.status = 2)
        AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$carteira['periodo_atual']['data_inicial']}' AND '{$carteira['periodo_atual']['data_final']}')
      ORDER BY id_chat, data_acao, horario_acao;";

    # verificando se a consulta pode ser executada
    if ($resultado = $db->query($query)) {

      $acoes = array();

      # recuperando todas as ações diárias do colaborador no período atual
      while ($registro = $resultado->fetch_assoc()) {

        $acoes[] = array(

          'id_colaborador' => $registro['id_colaborador'],
          'id_acao_diaria' => $registro['id_acao_diaria'],
          'id_chat'        => $registro['id_chat'],
          'data_acao'      => $registro['data_acao'],
          'horario_acao'   => $registro['horario_acao']

        );

      }

    }

  }

  return $acoes;

}
