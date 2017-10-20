<?php

/*
 * função que redireciona o usuário para a página de login caso ele tente acessar uma página sem realizar o login
 */
if (! verificaUsuarioLogado()) {

  header('Location: ' . BASE_URL . 'public/views/login/form_login.php');

}
