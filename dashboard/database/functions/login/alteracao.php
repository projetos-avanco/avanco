<?php

/**
 * altera a senha de login do usuário
 * @param - objeto com uma conexão aberta
 * @param - array com os dados para alteração (usuário, nova senha e confirmação)
 */
function alteraSenhaDeLogin($conexao, $alteracao)
{
  # gerando código hash da senha atual
  $alteracao['senha-atual'] = geraCodigoHash($alteracao['senha-atual']);

  $query =
    "SELECT
      id
    FROM av_usuarios_login
    WHERE (email = '{$alteracao['usuario']}')
      AND (senha = '{$alteracao['senha-atual']}')";

  $resultado = mysqli_query($conexao, $query);

  # verificando se o usuário existe na base de dados
  if ($resultado->num_rows > 0) {

    # recuperando id do usuário
    $id = mysqli_fetch_row($resultado);

    # gerando código hash da nova senha
    $senha = geraCodigoHash($alteracao['senha']);

    $query = "UPDATE av_usuarios_login SET senha = '$senha' WHERE id = {$id[0]}";

    $resultado = mysqli_query($conexao, $query);

    # criando mensagem, alteração realizada
    if ($resultado) {

      $_SESSION['mensagens']['alteracao_senha']['tipo']     = 1;
      $_SESSION['mensagens']['alteracao_senha']['mensagem'] = 'Senha Alterada com Sucesso!';

    }

    # criando mensagem, alteração não realizada
  } else {

    $_SESSION['mensagens']['alteracao_senha']['tipo']     = 2;
    $_SESSION['mensagens']['alteracao_senha']['mensagem'] = 'Usuário ou senha atual incorreto!';

  }

  # fechando conexão aberta
  fecha_conexao($conexao);

  if ($_SESSION['mensagens']['alteracao_senha']['tipo'] == 1) {

    # redirecionando usuário para o formulário de login
    header('Location: ' . BASE_URL . 'public/views/login/form_login.php');

  } elseif ($_SESSION['mensagens']['alteracao_senha']['tipo'] == 2) {

    # redirecionando usuário para o formulário de alteração de senha
    header('Location: ' . BASE_URL . 'public/views/login/form_alteracao_senha.php');

  }

}
