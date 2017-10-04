<?php

require '../../init.php';

require ABS_PATH . 'app/models/cliente.php';
require ABS_PATH . 'app/modules/knowledge-base/documentos.php';
require ABS_PATH . 'app/modules/transfer/redireciona.php';
require ABS_PATH . 'app/helpers/requisicoes.php';

# verificando se foi enviado uma requisição via método POST para esse script
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $valida = false;

  # verificando se todos os campos foram enviados
  if (! empty($_POST['cliente']['nome'])           AND
      ! empty($_POST['cliente']['nome_usuario'])   AND
      ! empty($_POST['cliente']['cnpj'])           AND
      ! empty($_POST['cliente']['conta_contrato']) AND
      ! empty($_POST['cliente']['razao_social'])   AND
      ! empty($_POST['cliente']['produto'])        AND
      ! empty($_POST['cliente']['modulo'])         AND
      ! empty($_POST['cliente']['duvida']))
        $valida = true;

  if ($valida) {

    # chamando função que retorna um array modelo para receber os dados do cliente
    $cliente = criaModeloDeCliente();

    # chamando função que recupera os dados do cliente no array super-global $_POST
    recuperaDados($cliente, 'POST');

    # chamando função que consulta a dúvida do cliente na base de conhecimento
    consultaDuvidaNaBaseDeConhecimento();

    # chamando função que consulta informações na base de dados do chat
    consultaChat();

  } else {

    # chamando a função que grava um log
    gravaLog('existem campos do formulário do cliente que não foram preenchidos', 'warning');

  }

} else {

  # chamando a função que grava um log
  gravaLog('os dados não foram enviados via método POST', 'warning');

}
