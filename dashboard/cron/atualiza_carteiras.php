<?php

require '../init.php';
require DIRETORIO_MODULES  . 'avancoins/avancoins.php';
require ABS_PATH . 'cron/funcoes.php';

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