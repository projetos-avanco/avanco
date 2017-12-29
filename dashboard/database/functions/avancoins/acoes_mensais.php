<?php

/**
 * insere os logs dos colaboradores com percentual de de questionário interno respondido fora da meta no mês anterior
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
        			COUNT(i.id_chat)
        		FROM av_questionario_interno AS i
        		INNER JOIN lh_chat AS c
        			ON c.id = i.id_chat
        		WHERE (c.user_id = {$arrays[$i]['id_colaborador']})
        			AND (c.status = 2)
        			AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$carteira['periodo_anterior']['data_inicial']}' AND '{$carteira['periodo_anterior']['data_final']}'))

        		/

        		(SELECT
        			COUNT(c.id)
        		FROM lh_chat AS c
        		WHERE (c.user_id = {$arrays[$i]['id_colaborador']})
        			AND (c.status = 2)
        			AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$carteira['periodo_anterior']['data_inicial']}' AND '{$carteira['periodo_anterior']['data_final']}'))), 0) AS percentual_questionario_respondido;";

      # verificando se a consulta pode ser executada
      if ($resultado = $db->query($query)) {

        $arrays[$i]['indice_questionario_interno'] = $resultado->fetch_row();
        $arrays[$i]['indice_questionario_interno'] = (float)$arrays[$i]['indice_questionario_interno'][0];

      }

    }

    # inserindo logs de ações mensais
    for ($i = 0; $i < count($arrays); $i++) {

      # verificando se o colaborador está com o percentual de perda na meta ou fora da meta
      if ($arrays[$i]['indice_questionario_interno'] > 0 AND $arrays[$i]['indice_questionario_interno'] < 99) {

        $query = '';
        $query = "INSERT INTO av_avancoins_acoes_mensais_logs VALUES ('', {$arrays[$i]['id_colaborador']}, 8, '{$carteira['periodo_anterior']['data_final']}', '21:00:00');";

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
        			COUNT(e.cod_pesquisa)
        		FROM av_questionario_externo AS e
        		INNER JOIN lh_chat AS c
        			ON c.id = e.id_chat
        		WHERE (c.user_id = {$arrays[$i]['id_colaborador']})
        			AND (e.avaliacao_colaborador = 'Ótimo' OR e.avaliacao_colaborador = 'Bom')
        			AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$carteira['periodo_anterior']['data_inicial']}' AND '{$carteira['periodo_anterior']['data_final']}'))

        		/

        		(SELECT
        			COUNT(e.cod_pesquisa)
        		FROM av_questionario_externo AS e
        		INNER JOIN lh_chat AS c
        			ON c.id = e.id_chat
        		WHERE (c.user_id = {$arrays[$i]['id_colaborador']})
        			AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$carteira['periodo_anterior']['data_inicial']}' AND '{$carteira['periodo_anterior']['data_final']}'))), 0) AS percentual_indice_avancino;";

      # verificando se a consulta pode ser executada
      if ($resultado = $db->query($query)) {

        $arrays[$i]['indice_avancino'] = $resultado->fetch_row();
        $arrays[$i]['indice_avancino'] = (float)$arrays[$i]['indice_avancino'][0];

      }

    }

    # inserindo logs de ações mensais
    for ($i = 0; $i < count($arrays); $i++) {

      # verificando se o colaborador está com o percentual de perda na meta ou fora da meta
      if ($arrays[$i]['indice_avancino'] > 0 AND $arrays[$i]['indice_avancino'] <= 94) {

        $query = '';
        $query = "INSERT INTO av_avancoins_acoes_mensais_logs VALUES ('', {$arrays[$i]['id_colaborador']}, 7, '{$carteira['periodo_anterior']['data_final']}', '21:00:00');";

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
        			COUNT(id) AS atendimentos_realizados_ate_15_minutos
        		FROM lh_chat
        		WHERE (user_id = {$arrays[$i]['id_colaborador']})
        			AND (status = 2)
        			AND (wait_time <= 900)
        			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$carteira['periodo_anterior']['data_inicial']}' AND '{$carteira['periodo_anterior']['data_final']}'))

        		/


        		(SELECT
        			COUNT(id) AS atendimentos_demandados
        		FROM lh_chat
        		WHERE (user_id = {$arrays[$i]['id_colaborador']})
        			AND (status = 2)
        			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$carteira['periodo_anterior']['data_inicial']}' AND '{$carteira['periodo_anterior']['data_final']}'))), 0) AS percentual_atendimentos_15_minutos;";

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

      # verificando se o colaborador está com o percentual de perda na meta ou fora da meta
      if ($arrays[$i]['percentual_fila'] != null AND $arrays[$i]['percentual_fila'] < 50) {

        $query = '';
        $query = "INSERT INTO av_avancoins_acoes_mensais_logs VALUES ('', {$arrays[$i]['id_colaborador']}, 10, '{$carteira['periodo_anterior']['data_final']}', '21:00:00');";

        $db->query($query);

      } elseif ($arrays[$i]['percentual_fila'] != null AND $arrays[$i]['percentual_fila'] >= 80) {

        $query = '';
        $query = "INSERT INTO av_avancoins_acoes_mensais_logs VALUES ('', {$arrays[$i]['id_colaborador']}, 6, '{$carteira['periodo_anterior']['data_final']}', '21:00:00');";

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
              COUNT(id) AS atendimentos_perdidos
            FROM lh_chat
            WHERE (user_id = {$arrays[$i]['id_colaborador']})
              AND (status = 2)
              AND (chat_duration = 0)
              AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$carteira['periodo_anterior']['data_inicial']}' AND '{$carteira['periodo_anterior']['data_final']}'))

            /

            (SELECT
              COUNT(id) AS atendimentos_demandados
            FROM lh_chat
            WHERE (user_id = {$arrays[$i]['id_colaborador']})
              AND (status = 2)
              AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$carteira['periodo_anterior']['data_inicial']}' AND '{$carteira['periodo_anterior']['data_final']}'))), 0) AS percentual_perda;";

      # verificando se a consulta pode ser executada
      if ($resultado = $db->query($query)) {

        $arrays[$i]['percentual_perda'] = $resultado->fetch_row();
        $arrays[$i]['percentual_perda'] = (float)$arrays[$i]['percentual_perda'][0];

      }

    }

    # inserindo logs de ações mensais
    for ($i = 0; $i < count($arrays); $i++) {

      # verificando se o colaborador está com o percentual de perda na meta ou fora da meta
      if ($arrays[$i]['percentual_perda'] > 0 AND $arrays[$i]['percentual_perda'] <= 15) {

        $query = '';
        $query = "INSERT INTO av_avancoins_acoes_mensais_logs VALUES ('', {$arrays[$i]['id_colaborador']}, 5, '{$carteira['periodo_anterior']['data_final']}', '21:00:00');";

        $db->query($query);

      } elseif ($arrays[$i]['percentual_perda'] > 20) {

        $query = '';
        $query = "INSERT INTO av_avancoins_acoes_mensais_logs VALUES ('', {$arrays[$i]['id_colaborador']}, 9, '{$carteira['periodo_anterior']['data_final']}', '21:00:00');";

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
    WHERE (data_partida_time = '{$carteira['periodo_anterior']['data_final']}')
    ORDER BY pontuacao_time DESC";

  if ($resultado = $db->query($query)) {

    $codigoTime = $resultado->fetch_row();
    $codigoTime = $codigoTime[0];

    $query =
      "SELECT
      	id_colaborador
      FROM av_dashboard_colaborador_times
      WHERE (id_times = $codigoTime)";

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
            ('', $valor, 4, '{$carteira['periodo_anterior']['data_final']}', '21:00:00')";

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
      AND (data_premiacao = '{$carteira['periodo_anterior']['data_final']}');";

  if ($resultado = $db->query($query)) {

    $idColaborador = $resultado->fetch_row();
    $idColaborador = $idColaborador[0];

    $query =
      "INSERT INTO
        av_avancoins_acoes_mensais_logs
      VALUES
        ('', $idColaborador, 3, '{$carteira['periodo_anterior']['data_final']}', '21:00:00');";

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
      AND (data_premiacao = '{$carteira['periodo_anterior']['data_final']}');";

  if ($resultado = $db->query($query)) {

    $idColaborador = $resultado->fetch_row();
    $idColaborador = $idColaborador[0];

    $query =
      "INSERT INTO
        av_avancoins_acoes_mensais_logs
      VALUES
        ('', $idColaborador, 2, '{$carteira['periodo_anterior']['data_final']}', '21:00:00');";

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
      AND (data_premiacao = '{$carteira['periodo_anterior']['data_final']}');";

  if ($resultado = $db->query($query)) {

    $idColaborador = $resultado->fetch_row();
    $idColaborador = $idColaborador[0];

    $query =
      "INSERT INTO
        av_avancoins_acoes_mensais_logs
      VALUES
        ('', $idColaborador, 1, '{$carteira['periodo_anterior']['data_final']}', '21:00:00');";

    $db->query($query);

  }

}

/**
 * consulta todas as ações mensais do colaborador no período anterior
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 *
 */
function consultaAcoesMensais($db, $carteira)
{
  $query =
    "SELECT
    	COUNT(id)
    FROM av_avancoins_acoes_mensais_logs
    WHERE (data_acao = '{$carteira['periodo_anterior']['data_final']}');";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $quantidadeRegistros = $resultado->fetch_row();
    $quantidadeRegistros = $quantidadeRegistros[0];

  }

  # verificando se a quantidade de registros no banco é igual a zero (se for 0 as consultas de ações mensais ainda não foram executadas)
  if ($quantidadeRegistros == 0) {

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

}
