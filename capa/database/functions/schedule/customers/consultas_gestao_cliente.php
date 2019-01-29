<?php

/**
 * consulta a quantidade de atendimentos realizados de uma empresa em um período
 * @param - objeto com uma conexão aberta
 * @param - array com os dados dos filtros
 */
function consultaAtendimentosRealizados($db, $filtros) {
  $query =
    "SELECT
      COUNT(c.id) AS atendimentos_realizados
    FROM lh_chat AS c
    WHERE (SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1) = {$filtros['cnpj']})
      AND (c.status = 2)
      AND (c.chat_duration > 0)
      AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$filtros['data_inicial']}' AND '{$filtros['data_final']}')";
  
  $resultado = mysqli_query($db, $query);

  while ($linha = mysqli_fetch_array($resultado)) {
    $atendimentos = $linha['atendimentos_realizados'];
  }

  return $atendimentos;
}

/**
 * calcula a taxa de perda de uma empresa em um período
 * @param - objeto com uma conexão aberta
 * @param - array com os dados dos filtros
 */
function calculaTaxaDePerda($db, $filtros) {
  $query = 
    "SELECT
      ROUND(100 * (
        (SELECT
          COUNT(d.id) AS atendimentos_perdidos
        FROM
          (SELECT
            c.id,
            TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
          FROM lh_chat AS c
          WHERE (SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1) = {$filtros['cnpj']})
            AND (c.status = 2)
            AND (c.chat_duration = 0)
            AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$filtros['data_inicial']}' AND '{$filtros['data_final']}')) AS d
        WHERE (d.time_diff >= '00:03:00'))

        /

        (SELECT
          COUNT(d.id) atendimentos_demandados
        FROM
          (SELECT
            c.id,
            c.chat_duration,
            TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
          FROM lh_chat AS c
          WHERE (SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1) = {$filtros['cnpj']})
            AND (c.status = 2)
            AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$filtros['data_inicial']}' AND '{$filtros['data_final']}')) AS d
        WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))), 0) AS percentual_perda";
  
  $resultado = mysqli_query($db, $query);

  while ($linha = mysqli_fetch_array($resultado)) {
    $perda = $linha['percentual_perda'];
  }

  return $perda;
}

/**
 * calcula o percentual do índice avancino de uma empresa em um determinado período
 * @param - objeto com uma conexão aberta
 * @param - array com os dados dos filtros
 */
function calculaIndiceAvancino($db, $filtros) {
  $query =
    "SELECT
      ROUND(100 * (
        (SELECT
          COUNT(d.id_chat)
        FROM
          (SELECT
            e.id_chat,							
            c.chat_duration,
            TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
          FROM lh_chat AS c
          INNER JOIN av_questionario_externo AS e
            ON e.id_chat = c.id
          WHERE (SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1) = {$filtros['cnpj']})
            AND (e.avaliacao_colaborador = 'Otimo' OR e.avaliacao_colaborador = 'Bom')
            AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$filtros['data_inicial']}' AND '{$filtros['data_final']}')) AS d
          WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))
    
          /
    
        (SELECT 
          COUNT(d.id_chat)
        FROM
          (SELECT
            e.id_chat,						
            c.chat_duration,
            TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
          FROM lh_chat AS c
          INNER JOIN av_questionario_externo AS e
            ON e.id_chat = c.id
          WHERE (SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1) = {$filtros['cnpj']})
            AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$filtros['data_inicial']}' AND '{$filtros['data_final']}')) AS d
          WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))), 0) AS percentual_indice_avancino";
  
  $resultado = mysqli_query($db, $query);

  while ($linha = mysqli_fetch_array($resultado)) {
    $avancino = $linha['percentual_indice_avancino'];
  }

  return $avancino;
}

/**
 * calcula o percentual de tempo de fila até 15 minutos de uma empresa em um determinado período
 * @param - objeto com uma conexão aberta
 * @param - array com os dados dos filtros
 */
function calculaFilaAte15Minutos($db, $filtros) {
  $query =
    "SELECT
    ROUND(100 * (
      (SELECT
        COUNT(d.id)
      FROM
        (SELECT
          c.id,
          c.chat_duration,
          TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
        FROM lh_chat AS c
        WHERE (SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1) = {$filtros['cnpj']})
          AND (c.wait_time < 900)
          AND (c.status = 2)
          AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$filtros['data_inicial']}' AND '{$filtros['data_final']}')) AS d
      WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))
  
      /
  
  
      (SELECT
        COUNT(d.id)
      FROM
        (SELECT
          c.id,
          c.chat_duration,
          TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
        FROM lh_chat AS c
        WHERE (SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1) = {$filtros['cnpj']})
          AND (c.status = 2)
          AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$filtros['data_inicial']}' AND '{$filtros['data_final']}')) AS d
      WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))), 0) AS percentual_atendimentos_15_minutos";

$resultado = mysqli_query($db, $query);

while ($linha = mysqli_fetch_array($resultado)) {
  $fila = $linha['percentual_atendimentos_15_minutos'];
}

return $fila;
}