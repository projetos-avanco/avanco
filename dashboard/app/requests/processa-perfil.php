<?php

require ABS_PATH . 'app/modules/profile/colaborador.php';

require ABS_PATH . 'app/helpers/data.php';

# criando array com o modelo de datas
$datas = defineArrayModeloDeDatas();

# verificando se houve requisição da página via método GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  # setando data atual
  $datas['data_1'] = date('Y-m-d');
  $datas['data_2'] = date('Y-m-d');

}

# verificando se houve requisição da página via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  # recuperando data informada pelo usuário ou data atual
  $datas['data_1'] = isset($_POST['datas']['data-1']) ? $_POST['datas']['data-1'] : date('Y-m-d');
  $datas['data_2'] = isset($_POST['datas']['data-2']) ? $_POST['datas']['data-2'] : date('Y-m-d');

}

# chamando função que consulta os dados do colaborador
consultaDadosDoColaborador($datas);
