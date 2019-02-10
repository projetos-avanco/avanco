<?php

require DIRETORIO_MODELS    . 'carteira.php';
require DIRETORIO_FUNCTIONS . 'avancoins/periodo.php';
require DIRETORIO_FUNCTIONS . 'avancoins/acoes_diarias.php';
require DIRETORIO_FUNCTIONS . 'avancoins/acoes_mensais.php';
require DIRETORIO_FUNCTIONS . 'avancoins/carteira.php';
require DIRETORIO_FUNCTIONS . 'avancoins/ganhadores_avancao.php';

/*
 * responsável por atualizar as ações diárias do colaborador no período atual
 * @param - string com o id do colaborador
 */
function atualizaAcoesDiarias($id)
{
  # chamando função que abre uma conexão com a base de dados
  $db = abre_conexao();

  # chamando função que cria uma array modelo de carteira de avancoins
  $carteira = defineArrayModeloDeCarteiraAvancoins();

  # recuperando id do colaborador  
  $carteira['id_colaborador'] = $id;

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
 * @param - string com o id do colaborador
 */
function atualizaAcoesMensais($id = null)
{
  # chamando função que abre uma conexão com a base de dados
  $db = abre_conexao();

  # chamando função que cria uma array modelo de carteira de avancoins
  $carteira = defineArrayModeloDeCarteiraAvancoins();

  # recuperando id do colaborador  
  $carteira['id_colaborador'] = $id;

  # chamando função que retorna o período do mês atual
  $carteira = verificaPeriodoAtivo($db, $carteira);

  # verificando se o período atual corresponde a janeiro de 2018, em caso positivo, no mês de dezembro de 2017 não terá prêmiações mensais
  if ($carteira['periodo_atual']['data_inicial'] != '2018-01-01' AND $carteira['periodo_atual']['data_final'] != '2018-01-31') {

    # chamando função que retorna o período do mês anterior
    $carteira = verificaPeriodoAnterior($db, $carteira);

    # verificando se a data atual é o último dia do mês atual
    if ($carteira['data_atual'] == $carteira['periodo_atual']['data_final']) {

      # chamando função que consulta todas as ações mensais do colaborador no período anterior
      consultaAcoesMensais($db, $carteira);

    }

  }
  
}

/*
 * responsável por atualizar a quantidade de moedas na carteira de avancoins
 * @param - string com o id do colaborador
 */
function atualizaCarteira($id)
{
  # chamando função que abre uma conexão com a base de dados
  $db = abre_conexao();

  # chamando função que cria uma array modelo de carteira de avancoins
  $carteira = defineArrayModeloDeCarteiraAvancoins();

  # recuperando id do colaborador  
  $carteira['id_colaborador'] = $id;

  # chamando função que retorna o período do mês atual
  $carteira = verificaPeriodoAtivo($db, $carteira);

  # chamando função que atualiza a quantidade de moedas na carteira de avancoins
  atualizaQuantidadeDeMoedasNaCarteira($db, $carteira);

  fecha_conexao($db);

}

/*
 * responsável por retornar para o dashboard a quantidade atual de moedas do colaborador
 * @param - string com o id do colaborador
 */
function retornaQuantidadeDeMoedasDaCarteira($id)
{
  # chamando função que abre uma conexão com a base de dados
  $db = abre_conexao();

  # chamando função que cria uma array modelo de carteira de avancoins
  $carteira = defineArrayModeloDeCarteiraAvancoins();

  # recuperando id do colaborador  
  $carteira['id_colaborador'] = $id;

  # chamando função que retorna a quantidade atual de moedas do colaborador
  $carteira['moedas'] = consultaQuantidadeDeMoedas($db, $carteira);

  $imagens = array();

  settype($carteira['moedas'], 'string');

  $contador = strlen($carteira['moedas']);

  # montando array de imagens com o caminho das imagens referente a quantidade de moedas
  for ($i = 0; $i < $contador; $i++) {

    switch ($carteira['moedas'][$i]) {

      case '-':
        $imagens[$i] = BASE_URL . '/public/img/others/numeros/traco.png';
      break;

      case '0':
        $imagens[$i] = BASE_URL . '/public/img/others/numeros/zero.png';
      break;

      case '1':
        $imagens[$i] = BASE_URL . '/public/img/others/numeros/um.png';
      break;

      case '2':
        $imagens[$i] = BASE_URL . '/public/img/others/numeros/dois.png';
      break;

      case '3':
        $imagens[$i] = BASE_URL . '/public/img/others/numeros/tres.png';
      break;

      case '4':
        $imagens[$i] = BASE_URL . '/public/img/others/numeros/quatro.png';
      break;

      case '5':
        $imagens[$i] = BASE_URL . '/public/img/others/numeros/cinco.png';
      break;

      case '6':
        $imagens[$i] = BASE_URL . '/public/img/others/numeros/seis.png';
      break;

      case '7':
        $imagens[$i] = BASE_URL . '/public/img/others/numeros/sete.png';
        break;

      case '8':
        $imagens[$i] = BASE_URL . '/public/img/others/numeros/oito.png';
      break;

      case '9':
        $imagens[$i] = BASE_URL . '/public/img/others/numeros/nove.png';
      break;

    }

  }

  return $imagens;

}

/*
 * responsável por verificar o ganhador do prêmio artilheiro no mês atual e inserir na tabela av_dashboard_colaborador_titulos
 * @param - objeto com uma conexão aberta
 * @param - string com a data do último dia do mês
 */
function verificaGanhadorDoPremioArtilheiro($db, $datas)
{
  $resutado = insereGanhadorDoPremioArtilheiro($db, $datas);

  return $resutado;
}

/*
 * responsável por verificar o ganhador do prêmio goleiro no mês atual e inserir na tabela av_dashboard_colaborador_titulos
 * @param - objeto com uma conexão aberta
 * @param - string com a data do primeiro dia do mês
 * @param - string com a data do último dia do mês
 */
function verificaGanhadorDoPremioGoleiro($db, $datas)
{
  $resultado = insereGanhadorDoPremioGoleiro($db, $datas);

  return $resultado;
}

/*
 * responsável por verificar o ganhador do prêmio lateral no mês atual e inserir na tabela av_dashboard_colaborador_titulos
 * @param - objeto com uma conexão aberta
 * @param - string com a data do primeiro dia do mês
 * @param - string com a data do último dia do mês
 */
function verificaGanhadorDoPremioLateral($db, $datas)
{
  $resultado = insereGanhadorDoPremioLateral($db, $datas);

  return $resultado;
}

/*
 * responsável por verificar o ganhador do prêmio meio campo no mês atual e inserir na tabela av_dashboard_colaborador_titulos
 * @param - objeto com uma conexão aberta
 * @param - string com a data do último dia do mês
 */
function verificaGanhadorDoPremioMeioCampo($db, $datas)
{
  $resultado = insereGanhadorDoPremioMeioCampo($db, $datas);

  return $resultado;
}

/*
 * responsável por verificar o ganhador do prêmio zagueiro no mês atual e inserir na tabela av_dashboard_colaborador_titulos
 * @param - objeto com uma conexão aberta
 * @param - string com a data do último dia do mês
 */
function verificaGanhadorDoPremioZagueiro($db, $datas)
{
  $resultado = insereGanhadorDoPremioZagueiro($db, $datas);

  return $resultado;
}