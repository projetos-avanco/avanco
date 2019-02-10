<?php

# verificando se houve requisição via método get
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
  # importando script de configurações
  require_once '../../../../../init.php';

  $id = $_GET['id'];

  # verificando se o id do contato foi enviado
  if ((!empty($id)) && is_numeric($id)) {
    # importando script
    require_once DIRETORIO_MODULES . 'schedule/modulo_contato.php';

    # chamando função responsável por deletar os dados do contato
    recebeContatoParaDelecao($id);
  }
}