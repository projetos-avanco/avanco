<?php

/**
 * redireciona o usuário para a página de dashboard ou para a página de login
 */
function redirecionaUsuario()
{
  # verificando se a sessão de usuário foi criada
  if (isset($_SESSION['usuario'])) {

    # verificando se o usuário está cadastrado
    if ($_SESSION['usuario']['id'] != '0' AND $_SESSION['usuario']['tipo'] == 1) {

      # redirecionando para a página de dashboard do usuário
      header('Location: ' . BASE_URL .
        'public/views/profile/colaborador.php?usuario=' .
        strtolower(removeAcentos($_SESSION['usuario']['nome'])) .
        '-' .
        strtolower(removeAcentos($_SESSION['usuario']['sobrenome']))
      );

      # verificando se os dados não foram preenchidos no formulário ou se o envio de requisição está incorreto ou se o usuário não está cadastrado
    } elseif ($_SESSION['usuario']['id'] == '0' AND (
        $_SESSION['usuario']['tipo'] == 2 OR
        $_SESSION['usuario']['tipo'] == 3 OR
        $_SESSION['usuario']['tipo'] == 4
      )) {

      # redirecionando para a página de login
      header('Location: ' . BASE_URL . 'public/views/login/form-login.php');

    }

  }

}

/*
 * verifica se o usuário está logado
 */
function verificaUsuarioLogado()
{
  # verificando se existe a sessão usuário ou se a sessão logado está como falso
  if (! isset($_SESSION['usuario']) OR $_SESSION['usuario']['logado'] !== true) {

    return false;

  }

  return true;
}

/*
 * gera código hash sha1 utilizando uma senha informada
 */
function geraCodigoHash($senha)
{
  $codigo = sha1($senha);

  return $codigo;
}
