<?php

# verificando se o usuário não está logado
if (! verificaUsuarioLogado()) {

  # criando mensagem de aviso na sessão
  $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Ops!</strong> Faça o login para acessar o sistema.</p>';
  $_SESSION['mensagens']['tipo']     = 'warning';
  $_SESSION['mensagens']['exibe']    = true;

  # redirecionando
  header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php');

}
