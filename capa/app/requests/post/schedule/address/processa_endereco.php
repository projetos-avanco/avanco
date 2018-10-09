<?php

# verificando se foi enviado requisição via método GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  # importando script de configurações
  require '../../../../../init.php';
  
  # verificando se o id do cnpj da empresa foi enviado
  if ((!empty($_GET['id-cnpj']))) {
    # importando script
    require DIRETORIO_MODULES . '/schedule/modulo_endereco.php';

    # chamando função que retorna o endereço de um cnpj
    consultaEnderecoAjax($_GET['id-cnpj']);
  }
}
