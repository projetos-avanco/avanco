<?php

# verificando se foi enviado requisição via método GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  require '../../modules/schedule/enderecos.php';

  if (! empty($_GET['id-cnpj'])) {
    retornaEndereco($_GET['id-cnpj']);
  }
}
