<?php

require ABS_PATH . 'database/functions/profile/tables/dashboard.php';

require ABS_PATH . 'app/models/dashboard.php';

/**
 * consulta e cria a sessão com os dados que serão exibidos no dashboard
 * @param - string com o id do colaborador que requisitou a página
 */
function geraDadosParaDashboard($id)
{
  # abrindo conexão com a base de dados
  $conexao = abre_conexao();

  # criando array com o modelo de dashboard
  $dashboard = defineArrayModeloDeDashboard();

  # chamando função que retorna os dados para o dashboard
  $dashboard = retornaDadosParaDashboard($conexao, $dashboard, $id);

  unset($dashboard['colaborador']['id']);

  $_SESSION['front_end'] = array(
    'dashboard' => $dashboard
  );

  exit(var_dump($_SESSION['front_end']));
}
