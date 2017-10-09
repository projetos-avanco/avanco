<?php

require '../../init.php';

require ABS_PATH . 'app/models/cliente.php';
require ABS_PATH . 'app/modules/transfer/tecnologia.php';
require ABS_PATH . 'app/modules/transfer/suporte_geral.php';
require ABS_PATH . 'app/modules/transfer/novo_erp.php';
require ABS_PATH . 'app/modules/knowledge-base/documentos.php';
require ABS_PATH . 'app/helpers/requisicoes.php';

# verificando se foi enviado uma requisição via método POST para esse script
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  # chamando função que verifica se os dados do cliente foram enviados
  $confirma = confirmaEnvioDosDadosDoCliente();

  # verificando se os dados do cliente foram enviados
  if ($confirma) {

    # verificando se o cliente deseja falar no departamento de tecnologia
    if (isset($_POST['cliente']['tecnologia']) AND ! empty($_POST['cliente']['tecnologia'])) {

      echo 'chamou tecnologia'; exit;

    # verificando se o cliente deseja falar no departamento do novo ERP
    } elseif (isset($_POST['cliente']['novo_erp']) AND ! empty($_POST['cliente']['novo_erp'])) {

      echo 'chamou novo ERP'; exit;

    # verificando se o cliente deseja falar no departamento de suporte geral
    } else {

      # chamando função que verifica se os dados da demanda foram enviados
      $confirma = confirmaEnvioDosDadosDaDemanda();

      # verificando se os dados da demanda foram enviados
      if ($confirma) {

        # chamando função que retorna um array modelo para receber os dados do cliente
        $cliente = criaModeloDeCliente();

        # chamando função que recupera os dados do cliente no array super-global $_POST
        recuperaDados($cliente, 'POST');

        # chamando função que consulta a dúvida do cliente na base de conhecimento
        consultaDuvidaNaBaseDeConhecimento();

        # chamando função que consulta informações na base de dados do chat
        consultaChat();

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
