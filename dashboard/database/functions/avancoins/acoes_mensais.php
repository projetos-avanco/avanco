<?php

/**
 * insere os logs dos colaboradores com percentual de questionário interno respondido fora da meta no mês anterior
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 *
 */
function insereLogsPercentualQuestionarioInternoForaDaMeta($db, $carteira)
{
  $query =
    "SELECT
    	id
    FROM av_avancoins_carteiras";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $arrays = array();

    # recuperando ids dos colaboradores
    while ($registro = $resultado->fetch_assoc()) {

      $arrays[] = array(

        'id_colaborador'              => $registro['id'],
        'indice_questionario_interno' => 0

      );

    }

    # recuperando os percentuais de perda de todos os colaboradores
    for ($i = 0; $i < count($arrays); $i++) {

      $query = '';

      $query =
        "SELECT
          ROUND(100 * (
            (SELECT
              COUNT(d.id_chat)
            FROM 
              (SELECT
                i.id_chat,
                c.chat_duration,
                TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
              FROM av_questionario_interno AS i
              INNER JOIN lh_chat AS c
                ON c.id = i.id_chat
              WHERE (c.user_id = {$arrays[$i]['id_colaborador']})
                AND (c.status = 2)
                AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$carteira['periodo_atual']['data_inicial']}' AND '{$carteira['periodo_atual']['data_final']}')) AS d
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
              WHERE (c.user_id = {$arrays[$i]['id_colaborador']})
                AND (c.status = 2)
                AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$carteira['periodo_atual']['data_inicial']}' AND '{$carteira['periodo_atual']['data_final']}')) AS d
              WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))), 0) AS percentual_questionario_respondido;";
      
      # verificando se a consulta pode ser executada
      if ($resultado = $db->query($query)) {

        $arrays[$i]['indice_questionario_interno'] = $resultado->fetch_row();
        $arrays[$i]['indice_questionario_interno'] = (float)$arrays[$i]['indice_questionario_interno'][0];

      }

    }

    # inserindo logs de ações mensais
    for ($i = 0; $i < count($arrays); $i++) {

      # verificando se o colaborador está com o percentual de questionário interno respondido fora da meta
      if ($arrays[$i]['indice_questionario_interno'] > 0 AND $arrays[$i]['indice_questionario_interno'] < 99) {

        $query = '';
        $query = "INSERT INTO av_avancoins_acoes_mensais_logs VALUES ('', {$arrays[$i]['id_colaborador']}, 8, '{$carteira['periodo_atual']['data_final']}', '21:00:00');";

        $db->query($query);

      }

    }

  }

}

/**
 * insere os logs dos colaboradores com percentual avancino fora da meta no mês anterior
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 *
 */
function insereLogsPercentualAvancinoForaDaMeta($db, $carteira)
{
  $query =
    "SELECT
    	id
    FROM av_avancoins_carteiras";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $arrays = array();

    # recuperando ids dos colaboradores
    while ($registro = $resultado->fetch_assoc()) {

      $arrays[] = array(

        'id_colaborador'   => $registro['id'],
        'indice_avancino' => 0

      );

    }

    # recuperando os percentuais de perda de todos os colaboradores
    for ($i = 0; $i < count($arrays); $i++) {

      $query = '';

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
              WHERE (c.user_id = {$arrays[$i]['id_colaborador']})
                AND (e.avaliacao_colaborador = 'Otimo' OR e.avaliacao_colaborador = 'Bom')
                AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$carteira['periodo_atual']['data_inicial']}' AND '{$carteira['periodo_atual']['data_final']}')) AS d
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
              WHERE (c.user_id = {$arrays[$i]['id_colaborador']})
                AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$carteira['periodo_atual']['data_inicial']}' AND '{$carteira['periodo_atual']['data_final']}')) AS d
              WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))), 0) AS percentual_indice_avancino;";
      
      # verificando se a consulta pode ser executada
      if ($resultado = $db->query($query)) {

        $arrays[$i]['indice_avancino'] = $resultado->fetch_row();
        $arrays[$i]['indice_avancino'] = (float)$arrays[$i]['indice_avancino'][0];

      }

    }

    # inserindo logs de ações mensais
    for ($i = 0; $i < count($arrays); $i++) {

      # verificando se o colaborador está com o percentual avancino fora da meta
      if ($arrays[$i]['indice_avancino'] > 0 AND $arrays[$i]['indice_avancino'] <= 94) {

        $query = '';
        $query = "INSERT INTO av_avancoins_acoes_mensais_logs VALUES ('', {$arrays[$i]['id_colaborador']}, 7, '{$carteira['periodo_atual']['data_final']}', '21:00:00');";

        $db->query($query);

      }

    }

  }

}

/**
 * insere os logs dos colaboradores com percentual de fila até 15 minutos na meta ou fora da meta no mês anterior
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 *
 */
function insereLogsPercentualDeFilaAte15Minutos($db, $carteira)
{
  $query =
    "SELECT
    	id
    FROM av_avancoins_carteiras";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $arrays = array();

    # recuperando ids dos colaboradores
    while ($registro = $resultado->fetch_assoc()) {

      $arrays[] = array(

        'id_colaborador'  => $registro['id'],
        'percentual_fila' => 0

      );

    }

    # recuperando os percentuais de perda de todos os colaboradores
    for ($i = 0; $i < count($arrays); $i++) {

      $query = '';

      $query =
        "SELECT
        	ROUND(100 * (
        		(SELECT
        			COUNT(c.id) AS atendimentos_realizados_ate_15_minutos
        		FROM lh_chat AS c
        		WHERE (c.user_id = {$arrays[$i]['id_colaborador']})        			
        			AND (c.wait_time <= 900)
              AND (c.chat_duration > 0)
              AND (c.status = 2)
        			AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$carteira['periodo_atual']['data_inicial']}' AND '{$carteira['periodo_atual']['data_final']}'))

        		/

            (SELECT
              COUNT(d.id) atendimentos_demandados
            FROM
              (SELECT
                c.id,
                c.chat_duration,
                TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
              FROM lh_chat AS c
              WHERE (c.user_id = {$arrays[$i]['id_colaborador']})
                AND (c.status = 2)
                AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$carteira['periodo_atual']['data_inicial']}' AND '{$carteira['periodo_atual']['data_final']}')) AS d
            WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))), 0) AS percentual_atendimentos_15_minutos;";

      # verificando se a consulta pode ser executada
      if ($resultado = $db->query($query)) {

        $arrays[$i]['percentual_fila'] = $resultado->fetch_row();

        # verificando se o percentual de fila é diferente de null (se for igual a null o colaborador não realizou atendimentos no período)
        if ($arrays[$i]['percentual_fila'][0] != null) {

          $arrays[$i]['percentual_fila'] = (float)$arrays[$i]['percentual_fila'][0];

        } else {

          $arrays[$i]['percentual_fila'] = null;

        }

      }

    }

    # inserindo logs de ações mensais
    for ($i = 0; $i < count($arrays); $i++) {

      # verificando se o colaborador está com o percentual de fila até 15 minutos na meta ou fora da meta
      if ($arrays[$i]['percentual_fila'] != null AND $arrays[$i]['percentual_fila'] < 50) {

        $query = '';
        $query = "INSERT INTO av_avancoins_acoes_mensais_logs VALUES ('', {$arrays[$i]['id_colaborador']}, 10, '{$carteira['periodo_atual']['data_final']}', '21:00:00');";

        $db->query($query);

      } elseif ($arrays[$i]['percentual_fila'] != null AND $arrays[$i]['percentual_fila'] >= 80) {

        $query = '';
        $query = "INSERT INTO av_avancoins_acoes_mensais_logs VALUES ('', {$arrays[$i]['id_colaborador']}, 6, '{$carteira['periodo_atual']['data_final']}', '21:00:00');";

        $db->query($query);

      }

    }

  }

}

/**
 * insere os logs dos colaboradores com percentual de perda na meta ou fora da meta no mês anterior
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 *
 */
function insereLogsPercentualDePerda($db, $carteira)
{
  $query =
    "SELECT
    	id
    FROM av_avancoins_carteiras";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $arrays = array();

    # recuperando ids dos colaboradores
    while ($registro = $resultado->fetch_assoc()) {

      $arrays[] = array(

        'id_colaborador'   => $registro['id'],
        'percentual_perda' => 0

      );

    }

    # recuperando os percentuais de perda de todos os colaboradores
    for ($i = 0; $i < count($arrays); $i++) {

      $query = '';

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
              WHERE (c.user_id = {$arrays[$i]['id_colaborador']})
                AND (c.status = 2)
                AND (c.chat_duration = 0)
                AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$carteira['periodo_atual']['data_inicial']}' AND '{$carteira['periodo_atual']['data_final']}')) AS d
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
              WHERE (c.user_id = {$arrays[$i]['id_colaborador']})
                AND (c.status = 2)
                AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$carteira['periodo_atual']['data_inicial']}' AND '{$carteira['periodo_atual']['data_final']}')) AS d
              WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))), 0) AS percentual_perda;";
      
      # verificando se a consulta pode ser executada
      if ($resultado = $db->query($query)) {

        $arrays[$i]['percentual_perda'] = $resultado->fetch_row();
        $arrays[$i]['percentual_perda'] = (float)$arrays[$i]['percentual_perda'][0];

      }

    }

    # inserindo logs de ações mensais
    for ($i = 0; $i < count($arrays); $i++) {

      # verificando se o colaborador está com o percentual de perda na meta ou fora da meta
      if ($arrays[$i]['percentual_perda'] >= 0 AND $arrays[$i]['percentual_perda'] <= 15) {

        $query = '';
        $query = "INSERT INTO av_avancoins_acoes_mensais_logs VALUES ('', {$arrays[$i]['id_colaborador']}, 5, '{$carteira['periodo_atual']['data_final']}', '21:00:00');";

        $db->query($query);

      } elseif ($arrays[$i]['percentual_perda'] > 20) {

        $query = '';
        $query = "INSERT INTO av_avancoins_acoes_mensais_logs VALUES ('', {$arrays[$i]['id_colaborador']}, 9, '{$carteira['periodo_atual']['data_final']}', '21:00:00');";

        $db->query($query);

      }

    }

  }

}

/**
 * insere os logs dos colaboradores integrantes do time vencedor no mês anterior
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 *
 */
function insereLogsIntegrantesTimeVencedor($db, $carteira)
{
  $query =
    "SELECT
      codigo_time,
      pontuacao_time
    FROM av_times_avancao
    WHERE (data_partida_time = '{$carteira['periodo_atual']['data_final']}')
    ORDER BY pontuacao_time DESC";

  if ($resultado = $db->query($query)) {

    $codigoTime = $resultado->fetch_row();
    $codigoTime = $codigoTime[0];

    $query =
      "SELECT
        id_colaborador
      FROM av_dashboard_colaborador_times
      WHERE (id_times = $codigoTime)
        AND (data_saida IS NULL)
      ORDER BY id_colaborador";

    if ($resultado = $db->query($query)) {

      $idsColaboradores = array();

      while ($registro = $resultado->fetch_assoc()) {

        $idsColaboradores[] = $registro['id_colaborador'];

      }

      foreach ($idsColaboradores as $chave => $valor) {

        $query = '';
        $query =
          "INSERT INTO
            av_avancoins_acoes_mensais_logs
          VALUES
            ('', $valor, 4, '{$carteira['periodo_atual']['data_final']}', '21:00:00')";

        $db->query($query);

      }

    }

  }

}

/**
 * insere o log do ganhador do prêmio de goleiro no mês anterior
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 *
 */
function insereLogDeGoleiro($db, $carteira)
{
  $query =
    "SELECT
      id_colaborador,
      data_premiacao
    FROM av_dashboard_colaborador_titulos
    WHERE (id_titulos = 2)
      AND (data_premiacao = '{$carteira['periodo_atual']['data_final']}');";

  if ($resultado = $db->query($query)) {

    $idColaborador = $resultado->fetch_row();
    $idColaborador = $idColaborador[0];

    $query =
      "INSERT INTO
        av_avancoins_acoes_mensais_logs
      VALUES
        ('', $idColaborador, 3, '{$carteira['periodo_atual']['data_final']}', '21:00:00');";

    $db->query($query);

  }

}

/**
 * insere o log do ganhador do prêmio de meio campo no mês anterior
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 *
 */
function insereLogDeMeioCampo($db, $carteira)
{
  $query =
    "SELECT
      id_colaborador,
      data_premiacao
    FROM av_dashboard_colaborador_titulos
    WHERE (id_titulos = 4)
      AND (data_premiacao = '{$carteira['periodo_atual']['data_final']}');";

  if ($resultado = $db->query($query)) {

    $idColaborador = $resultado->fetch_row();
    $idColaborador = $idColaborador[0];

    $query =
      "INSERT INTO
        av_avancoins_acoes_mensais_logs
      VALUES
        ('', $idColaborador, 2, '{$carteira['periodo_atual']['data_final']}', '21:00:00');";

    $db->query($query);

  }

}

/**
 * insere o log do ganhador do prêmio de artilheiro no mês anterior
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 *
 */
function insereLogDeArtilheiro($db, $carteira)
{
  $query =
    "SELECT
      id_colaborador,
      data_premiacao
    FROM av_dashboard_colaborador_titulos
    WHERE (id_titulos = 1)
      AND (data_premiacao = '{$carteira['periodo_atual']['data_final']}');";

  if ($resultado = $db->query($query)) {

    $idColaborador = $resultado->fetch_row();
    $idColaborador = $idColaborador[0];

    $query =
      "INSERT INTO
        av_avancoins_acoes_mensais_logs
      VALUES
        ('', $idColaborador, 1, '{$carteira['periodo_atual']['data_final']}', '21:00:00');";

    $db->query($query);

  }

}

/**
 * consulta todas as ações mensais dos colaboradores no período anterior
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 *
 */
function consultaAcoesMensais($db, $carteira)
{
  # chamando funções de inserem as ações mensais de todos os colaboradores no período anterior
  insereLogDeArtilheiro($db, $carteira);
  insereLogDeMeioCampo($db, $carteira);
  insereLogDeGoleiro($db, $carteira);
  insereLogsIntegrantesTimeVencedor($db, $carteira);
  insereLogsPercentualDePerda($db, $carteira);
  insereLogsPercentualDeFilaAte15Minutos($db, $carteira);
  insereLogsPercentualAvancinoForaDaMeta($db, $carteira);
  insereLogsPercentualQuestionarioInternoForaDaMeta($db, $carteira);
}
