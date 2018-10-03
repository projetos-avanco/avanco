<?php

# verificando se foi enviado requisição via método GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  require '../../../init.php';
  require DIRETORIO_MODULES . '/schedule/modulo_endereco.php';

  if ((! empty($_GET['id-cnpj']))) {
    consultaEnderecoAjax($_GET['id-cnpj']);
  }
}
