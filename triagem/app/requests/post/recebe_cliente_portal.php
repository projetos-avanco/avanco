<?php

# verificando se foi enviado uma requisição via método POST pelo portal avanço
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  require '../../../init.php';

  require ABS_PATH . 'app/modules/transfer/tecnologia.php';
  require ABS_PATH . 'app/modules/transfer/suporte.php';
  require ABS_PATH . 'app/modules/transfer/novo_erp.php';

  # chamando função que verifica se os dados do cliente foram enviados
  $confirma = confirmaEnvioDosDadosDoCliente();

  # verificando se os dados do cliente foram enviados
  if ($confirma) {

    # chamando função que retorna um array modelo para receber os dados do cliente
    $cliente = criaModeloDeCliente();

    # chamando função que recupera os dados do cliente no array super-global $_POST
    recuperaDados($cliente, 'POST');

    # verificando se o cliente deseja falar no departamento do novo ERP
    if (isset($_POST['cliente']['produto']) AND $_POST['cliente']['produto'] == '4') {

      # chamando função que consulta informações na base de dados do chat
      consultaChatNovoErp();

    # verificando se o cliente deseja falar no departamento de tecnologia
    } elseif (isset($_POST['cliente']['produto']) AND $_POST['cliente']['produto'] == '5') {

      # chamando função que consulta informações na base de dados do chat
      consultaChatTecnologia();

    # verificando se o cliente deseja falar no departamento de suporte geral
    } else {

      # chamando função que verifica se os dados da demanda foram enviados
      $confirma = confirmaEnvioDosDadosDaDemanda();

      # verificando se os dados da demanda foram enviados
      if ($confirma) {

        # chamando função que consulta informações na base de dados do chat
        consultaChatSuporte();

      } else {

        $msg = 'Produto, Módulo ou Dúvida não foram enviados!';

        # retornando mensagem para o portal avanço
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);

        exit;
      }

    }

  } else {

    $msg = 'Nome, Nome de Usuário, CNPJ, Conta Contrato ou Razão Social não foram enviados!';

    # retornando mensagem para o portal avanço
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);

    exit;
  }

} else {

  $msg = 'Os dados do formulário não foram enviados via método POST!';

  # retornando mensagem para o portal avanço
  echo json_encode($msg, JSON_UNESCAPED_UNICODE);

  exit;
}
