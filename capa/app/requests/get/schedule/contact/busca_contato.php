<?php

# verificando se houve requisição via método get
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
  # requisitando script de configurações
  require_once '../../../../../init.php';

  $id = $_GET['id'];

  # verificando se o id do contato foi enviado e se ele é uma string númerica
  if ((!empty($id)) && is_numeric($id)) {
    # requisitando script
    require_once DIRETORIO_MODULES . 'schedule/modulo_contato.php';

    # chamando função que retorna todos os dados de um contato via json
    recebeContatoParaBusca($id);
  }
}