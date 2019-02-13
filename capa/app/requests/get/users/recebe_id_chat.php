<?php

require_once '../../../../init.php';
require_once DIRETORIO_MODULES . 'users/usuario.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  # verificando se foi enviado o id do usuário do chat
  if (isset($_GET['id']) && !empty($_GET['id'])) {
    # verificando se o id do usuário do chat é uma string numérica
    if (is_numeric($_GET['id'])) {
      $id = $_GET['id'];

      # chamando função que retorna os dados do usuário para edição
      retornaDadosDoUsuarioParaEdicao($id);
    }
  }  
}