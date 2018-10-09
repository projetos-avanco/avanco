<?php

# verificando se houve requisição via método get
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  require '../../../init.php';
  require DIRETORIO_MODULES . 'schedule/modulo_contato.php';

  if (! empty($_GET['id-cnpj'])) {
    # chamando função responsável por retornar todos os contatos de um cnpj
    retornaContatos($_GET['id-cnpj']);
  }
}
