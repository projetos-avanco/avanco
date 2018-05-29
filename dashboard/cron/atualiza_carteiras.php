<?php

/**
 * responsável por verificar o período atual
 * @param - objeto com uma conexão ativa
 * @param - array modelo que irá receber as datas
 */
function verificaPeriodoAtual($db, $datas)
{
  # consulta que retorna a data inicial e a data final do período ativo na tabela de períodos
  $query = "SELECT data_inicial, data_final FROM av_avancoins_periodos WHERE (ativo = 1);";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    # recuperando data inicial e data final do mês ativo na tabela de períodos
    while ($registro = $resultado->fetch_assoc()) {

      $datas['periodo_atual']['data_inicial'] = $registro['data_inicial'];
      $datas['periodo_atual']['data_final']    = $registro['data_final'];

    }

  }

  return $datas;
}

/**
 * responsável por verificar o período passado
 * @param - objeto com uma conexão ativa
 * @param - array modelo que irá receber as datas
 */
function verificaPeriodoPassado($db, $datas)
{
  settype($datas['mes_atual'], 'integer');

  # recuperando id do mês anterior
  $mesAnterior = $datas['mes_atual'] - 1;

  # verificando se o id está no mês de janeiro (se estiver no mês de janeiro, o período anterior será o mês de dezembro)
  if ($mesAnterior == 0) {

    # recuperando ano anterior
    $anoAnterior = date('Y') -1;

    $datas['periodo_anterior']['data_inicial'] = $anoAnterior . '-12' . '-01';
    $datas['periodo_anterior']['data_final']   = $anoAnterior . '-12' . '-31';

  }

  $query = "SELECT data_inicial, data_final FROM av_avancoins_periodos WHERE (id = $mesAnterior);";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    # recuperando data inicial e data final do mês anterior
    while ($registro = $resultado->fetch_assoc()) {

      $datas['periodo_anterior']['data_inicial'] = $registro['data_inicial'];
      $datas['periodo_anterior']['data_final']   = $registro['data_final'];

    }

  }

  return $datas;
}

/**
 * responsável por retornar o período atual e passado
 * @param - objeto com uma conexão ativa
 * @param - array modelo que irá receber as datas
 */
function retornaPeriodos($db, $datas)
{
  $datas = verificaPeriodoAtual($db, $datas);
  $datas = verificaPeriodoPassado($db, $datas);

  return $datas;
}

/**
 * responsável por atualizar as ações diárias, mensais (se necessário) e a carteira
 * @param - objeto com uma conexão ativa
 * @param - booleano informando se deve atualizar as ações mensais
 */
function atualizaDados($db, $mensal = null)
{
  $query = "SELECT id FROM av_avancoins_carteiras ORDER BY id;";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $ids = array();

    # recuperando todos os ids dos colaboradores que recebem avancoins
    while ($registro = $resultado->fetch_assoc()) {

      $ids[] = $registro['id'];      

    }

  }

  # verificando se é necessário atualizar as ações mensais
  if ($mensal) {

    # chamando função responsável por atualizar as ações mensais do colaborador no período atual
    atualizaAcoesMensais();

    echo "Atualizou as Ações Mensais!\n";

  } else {

    # atualizando a carteira de todos os colaboradores que recebem avancoins
    foreach ($ids as $id) {

      # chamando função responsável por atualizar as ações diárias do colaborador no período atual
      atualizaAcoesDiarias($id);

      # chamando função responsável por atualizar a quantidade de moedas na carteira do colaborador
      atualizaCarteira($id);

    }

    echo "Atualizou as Ações Diárias e a Carteira!\n";

  }
  
  # printando ids atualizados no log
  print_r($ids);

  echo "\n";
  echo "Script Executado!\n";
  echo "=============================\n";
}

/**
 * responsável por verificar se estamos no último dia do mês, em caso positivo, solicita a atualização das ações mensais
 * @param - objeto com uma conexão ativa
 * @param - string com a data do primeiro dia do mês
 * @param - string com a data do último dia do mês
 */
function verificaAtualizacaoDasAcoesMensais($db, $datas)
{
  # chamando funções que pesquisam e inserem os ganhadores na tabela av_dashboard_colaborador_titulos
  $resultadoArtilheiro = verificaGanhadorDoPremioArtilheiro($db, $datas);
  $resultadoGoleiro    = verificaGanhadorDoPremioGoleiro($db, $datas);
  $resultadoLateral    = verificaGanhadorDoPremioLateral($db, $datas);
  $resultadoMeioCampo  = verificaGanhadorDoPremioMeioCampo($db, $datas);
  $resultadoZagueiro   = verificaGanhadorDoPremioZagueiro($db, $datas);

  # verificando se foram verificados todos os prêmios
  if ($resultadoArtilheiro && $resultadoGoleiro && $resultadoLateral && $resultadoMeioCampo && $resultadoZagueiro) {
    
    # chamando função que atualiza as ações diárias, mensais (se necessário) e a carteira
    atualizaDados($db, true);
    
  }

}

require '../init.php';
require DIRETORIO_MODULES  . 'avancoins/avancoins.php';

$db = abre_conexao();

# verificando se a conexão com a base de dados foi realizada com sucesso
if ($db) {

  $datas = array(    
    'periodo_atual' => array(
      'data_inicial' => '',
      'data_final' => ''
    ),
    'periodo_anterior' => array(
      'data_inicial' => '',
      'data_final' => ''
    ),
    'mes_atual' => date('n'),
    'data_atual' => date('Y-m-d'),
    'horario_atual' => date('H:i:s')
  );

  # chamando função que retorna o período atual e o passado
  $datas = retornaPeriodos($db, $datas);

  # verificando se a data atual é o primeiro dia do mês
  if ($datas['data_atual'] == $datas['periodo_atual']['data_inicial'] && $datas['horario_atual'] >= '20:00:00') {

    # chamando função que atualiza as ações mensais
    verificaAtualizacaoDasAcoesMensais($db, $datas);

  }

  # chamando função que atualiza as ações diárias, mensais (se necessário) e a carteira
  atualizaDados($db);

  fecha_conexao($db);

} else {

  echo "A conexão não foi realizada com sucesso!\n <br><br>";

}