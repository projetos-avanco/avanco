<?php

# verificando se houve requisição via método get
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  # requisitando script de configurações
  require '../../../../../init.php';  

  # verificando se o id do cnpj da empresa foi enviado
  if (!empty($_GET['id-cnpj'])) {
    # requisitando script
    require DIRETORIO_MODULES . 'schedule/modulo_contato.php';

    # chamando função responsável por retornar todos os contatos de um cnpj
    retornaContatos($_GET['id-cnpj']);
  }
}
