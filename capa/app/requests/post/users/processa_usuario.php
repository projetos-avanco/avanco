<?php

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require_once '../../../../init.php';
  require_once DIRETORIO_MODULES . 'users/usuario.php';

  # verificando se foi enviado o id do usuário do chat
  if (isset($_POST['id']) && !empty($_POST['id'])) {
    # verificando se o id do usuário do chat é uma string numérica
    if (is_numeric($_POST['id'])) {
      $id = $_POST['id'];

      # chamando função que retorna os dados do usuário do chat
      retornaDadosDoUsuarioDoChat($id);
    }
  }  
}