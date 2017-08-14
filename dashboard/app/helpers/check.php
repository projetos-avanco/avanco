<?php

# verificando se o usuário não está logado
if (! verificaUsuarioLogado()) {

  # redirecionando
  header('Location: ' . BASE_URL . 'public/views/login/form-login.php');

}
