<?php

require ABS_PATH . 'app/modules/profile/colaborador.php';

# verificando se houve requisição da página via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  # criando array modelo para datas
  $datas = array(
    'data1' => '',
    'data2' => ''
  );

  # recuperando data informada pelo usuário ou data atual
  $datas['data1'] = isset($_POST['datas']['data1']) ? $_POST['datas']['data1'] : date('Y-m-d');
  $datas['data2'] = isset($_POST['datas']['data2']) ? $_POST['datas']['data2'] : date('Y-m-d');

  # chamando função que consulta os dados do colaborador
  consultaDadosDoColaborador($datas);

}
