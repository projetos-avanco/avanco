<?php

# verificando se foi enviado uma requisição via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  require '../../modules/portal/requisicoes_portal.php';

  # recuperando o código de conta contrato
  $conta_contrato = isset($_POST['conta_contrato']) ? $_POST['conta_contrato'] : null;  

  # verificando se a conta contrato foi enviada
  if (! empty($conta_contrato)) {

    # chamando função responsável por retornar os tickets referente ao código de conta contrato recebido
    retornaTicketsValidados($conta_contrato);

  } else {

    $msg = 'Código de conta contrato não foi enviado!';

    # retornando mensagem para o portal
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);

    exit;
  }

}
