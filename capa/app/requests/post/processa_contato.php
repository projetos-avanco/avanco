<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  require '../../../init.php';
  require DIRETORIO_MODULES . 'schedule/modulo_contatos.php';

  if (! empty($_GET['id-cnpj'])) {
    retornaContatos($_GET['id-cnpj']);
  }
}
