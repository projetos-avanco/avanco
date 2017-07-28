<?php

require ABS_PATH . 'app/modules/profile/colaborador.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  $datas = array(
    'inicial' => '',
    'final' => ''
  );

  $datas['inicial'] = isset($_GET['datas']['inicial']) ? $_GET['datas']['inicial'] : date('Y-m-d');
  $datas['final']   = isset($_GET['datas']['final'])   ? $_GET['datas']['final']   : date('Y-m-d');

  atualizaDadosDoColaborador($datas);

}
