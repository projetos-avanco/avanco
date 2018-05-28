<?php

/**
 * insere o ganhador do prêmio artilheiro do mês atual na tabela av_dashboard_titulos
 * @param - objeto com uma conexão aberta
 * @param - string com a data do último dia do mês
 */
function insereGanhadorDoPremioArtilheiro($db, $datas)
{
  $query = "SELECT codigo_jogador FROM av_jogadores_avancao ORDER BY quantidade_atendimentos_jogador DESC LIMIT 1";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {
    
    $id = $resultado->fetch_row();
    $id = $id[0];

    $query = 
      "INSERT INTO av_dashboard_colaborador_titulos VALUES (null, $id, 1, '{$datas['periodo_anterior']['data_final']}');";
    
    # inserindo ganhador
    $resultado = $db->query($query);

    return $resultado;

  } else {

    echo 'A query da função insereGanhadorDoPremioArtilheiro não está correta!';
    exit;

  }

}

/**
 * insere o ganhador do prêmio goleiro do mês atual na tabela av_dashboard_titulos
 * @param - objeto com uma conexão aberta
 * @param - string com a data do primeiro dia do mês
 * @param - string com a data do último dia do mês
 */
function insereGanhadorDoPremioGoleiro($db, $datas)
{
  $query = 
    "SELECT 
      b.codigo_jogador AS id,
      COUNT(b.conteudo_postado_base_de_conhecimento) AS conteudo_postado
    FROM av_base_de_conhecimento_avancao AS b
    INNER JOIN av_jogadores_avancao AS j
      ON b.codigo_jogador = j.codigo_jogador
    WHERE (b.data BETWEEN '{$datas['periodo_anterior']['data_inicial']}' AND '{$datas['periodo_anterior']['data_final']}')
      GROUP BY b.codigo_jogador
    ORDER BY 
      conteudo_postado DESC,
      j.quantidade_atendimentos_jogador DESC, 
      j.indice_avancino_jogador DESC, 
      j.indice_questionario_interno_respondido_jogador DESC";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $id = array();

    # recuperando dados
    while ($registro = $resultado->fetch_assoc()) {

      $id[] = $registro['id'];

    }

    # verificando se não há ganhador
    if ($resultado->num_rows == 0) {

      return true;

    } else {

      # recuperando id do ganhador
      $id = $id[0];

      $query = 
        "INSERT INTO av_dashboard_colaborador_titulos VALUES (null, $id, 2, '{$datas['periodo_anterior']['data_final']}');";

      # inserindo ganhador
      $resultado = $db->query($query);

      return $resultado;

    }
    
  } else {

    echo 'A query da função insereGanhadorDoPremioGoleiro não está correta!';
    exit;

  }

}

/**
 * insere o ganhador do prêmio lateral do mês atual na tabela av_dashboard_titulos
 * @param - objeto com uma conexão aberta
 * @param - string com a data do primeiro dia do mês
 * @param - string com a data do último dia do mês
 */
function insereGanhadorDoPremioLateral($db, $datas)
{
  $query = 
    "SELECT 
      i.codigo_jogador AS id,
      COUNT(i.conteudo_postado_info_varejo) AS pontos_info_varejo
    FROM av_info_varejo_avancao AS i
    INNER JOIN av_jogadores_avancao AS j
      ON j.codigo_jogador = i.codigo_jogador
    WHERE (i.data BETWEEN '{$datas['periodo_anterior']['data_inicial']}' AND '{$datas['periodo_anterior']['data_final']}')
      GROUP BY i.nome_jogador
    ORDER BY 
      pontos_info_varejo DESC, 
      j.quantidade_atendimentos_jogador DESC, 
      j.indice_avancino_jogador DESC, 
      j.indice_questionario_interno_respondido_jogador DESC";
  
  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $id = array();

    # recuperando dados
    while ($registro = $resultado->fetch_assoc()) {

      $id[] = $registro['id'];

    }

    # verificando se não há ganhador
    if ($resultado->num_rows == 0) {

      return true;

    } else {

      # recuperando id do ganhador
      $id = $id[0];

      $query = 
      "INSERT INTO av_dashboard_colaborador_titulos VALUES (null, $id, 3, '{$datas['periodo_anterior']['data_final']}');";

      # inserindo ganhador
      $resultado = $db->query($query);

      return $resultado;

    }

  } else {

    echo 'A query da função insereGanhadorDoPremioLateral não está correta!';
    exit;

  }

}

/**
 * insere o ganhador do prêmio meio campo do mês atual na tabela av_dashboard_titulos
 * @param - objeto com uma conexão aberta
 * @param - string com a data do último dia do mês
 */
function insereGanhadorDoPremioMeioCampo($db, $datas)
{
  $query = 
    "SELECT 
      codigo_jogador AS id	
    FROM av_jogadores_avancao
    ORDER BY 
      indice_avancino_jogador DESC, 
      quantidade_atendimentos_jogador DESC, 
      indice_questionario_interno_respondido_jogador DESC
    LIMIT 1";

  if ($resultado = $db->query($query)) {

    $id = $resultado->fetch_row();
    $id = $id[0];

    $query = 
      "INSERT INTO av_dashboard_colaborador_titulos VALUES (null, $id, 4, '{$datas['periodo_anterior']['data_final']}');";
    
    # inserindo ganhador
    $resultado = $db->query($query);

    return $resultado;

  } else {

    echo 'A query da função insereGanhadorDoPremioMeioCampo não está correta!';
    exit;

  }

}

/**
 * insere o ganhador do prêmio zagueiro do mês atual na tabela av_dashboard_titulos
 * @param - objeto com uma conexão aberta
 * @param - string com a data do último dia do mês
 */
function insereGanhadorDoPremioZagueiro($db, $datas)
{
  $query = 
    "SELECT
      codigo_jogador AS id	
    FROM av_jogadores_avancao
    ORDER BY 
      indice_questionario_interno_respondido_jogador DESC, 
      quantidade_atendimentos_jogador DESC, 
      indice_avancino_jogador DESC
    LIMIT 1";

  if ($resultado = $db->query($query)) {

    $id = $resultado->fetch_row();
    $id = $id[0];

    $query = "INSERT INTO av_dashboard_colaborador_titulos VALUES (null, $id, 5, '{$datas['periodo_anterior']['data_final']}');";

    # inserindo ganhador
    $resultado = $db->query($query);

    return $resultado;

  } else {

    echo 'A query da função insereGanhadorDoPremioArtilheiro não está correta!';
    exit;

  }

}