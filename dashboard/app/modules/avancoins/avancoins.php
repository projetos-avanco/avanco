<?php

require DIRETORIO_MODELS    . 'carteira.php';
require DIRETORIO_FUNCTIONS . 'avancoins/periodo.php';
require DIRETORIO_FUNCTIONS . 'avancoins/acoes_diarias.php';
require DIRETORIO_FUNCTIONS . 'avancoins/acoes_mensais.php';

/*
 * responsável por atualizar as ações diárias do colaborador no período atual
 */
function atualizaAcoesDiarias()
{
  # chamando função que abre uma conexão com a base de dados
  $db = abre_conexao();

  # chamando função que cria uma array modelo de carteira de avancoins
  $carteira = defineArrayModeloDeCarteiraAvancoins();

  # recuperando id do colaborador
  $carteira['id_colaborador'] = $_SESSION['colaborador']['id'];

  # chamando função que retorna o período do mês atual
  $carteira = verificaPeriodoAtivo($db, $carteira);

  # chamando função que consulta todas as ações diárias do colaborador no período atual
  $acoes = consultaAcoesDiarias($db, $carteira);

  # chamando função que retorna os logs de ações diárias no período atual
  $logs = retornaLogsDeAcoesDiarias($db, $carteira);

  # verificando se não existe nenhum log de ações diárias no período atual
  if (count($logs) == 0) {

    # chamando função que insere todas as ações diárias no período atual na tabela do logs de ações diárias
    insereAcoesDiarias($db, $acoes);

  } else {

    # chamando função que remove as ações existentes
    $acoes = removeAcoesDiariasRepetidas($db, $carteira, $logs);

    # verificando se não existe nenhuma ação diária nova para ser inserida na tabela de logs de ações diárias
    if (count($acoes) == 0) {

      fecha_conexao($db);

    } else {

      # chamando função que insere todas as ações diárias no período atual na tabela do logs de ações diárias
      insereAcoesDiarias($db, $acoes);

      fecha_conexao($db);

    }

  }

}

/*
 * responsável por atualizar as ações mensais do colaborador no período atual
 */
function atualizaAcoesMensais()
{
  # chamando função que abre uma conexão com a base de dados
  $db = abre_conexao();

  # chamando função que cria uma array modelo de carteira de avancoins
  $carteira = defineArrayModeloDeCarteiraAvancoins();

  # recuperando id do colaborador
  $carteira['id_colaborador'] = $_SESSION['colaborador']['id'];

  # chamando função que retorna o período do mês atual
  $carteira = verificaPeriodoAtivo($db, $carteira);

  # chamando função que retorna o período do mês anterior
  $carteira = verificaPeriodoAnterior($db, $carteira);

  # verificando se a data atual é igual ou maior que a data final do período anterior (para inserir os logs de ações mensais)
  if ($carteira['data_atual'] == $carteira['periodo_anterior']['data_final'] OR
      $carteira['data_atual'] > $carteira['periodo_anterior']['data_final']) {

    # chamando função que consulta todas as ações mensais do colaborador no período anterior
    consultaAcoesMensais($db, $carteira);

  }

  fecha_conexao($db);

}
