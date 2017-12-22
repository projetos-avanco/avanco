<?php

/*
 * responsável por atualizar a ações diárias do colaborador no período atual
 */
function atualizaAcoesDiarias()
{
  require DIRETORIO_MODELS    . 'carteira.php';
  require DIRETORIO_FUNCTIONS . 'avancoins/periodo.php';
  require DIRETORIO_FUNCTIONS . 'avancoins/acoes_diarias.php';

  # chamando função que abre uma conexão com a base de dados
  $db = abre_conexao();

  # chamando função que cria uma array modelo de carteira de avancoins
  $carteira = defineArrayModeloDeCarteiraAvancoins();

  # recuperando id do colaborador
  $carteira['id_colaborador'] = $_SESSION['colaborador']['id'];

  # chamando função que retorna o período que deve ser consultado
  $carteira = verificaPeriodoAtivo($db, $carteira);

  $carteira['periodo']['data_inicial'] = '2017-11-01'; # RETIRAR
  $carteira['periodo']['data_final']   = '2017-11-30'; # RETIRAR

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
