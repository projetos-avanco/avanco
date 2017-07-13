<?php

/**
 * verifica na base de dados se login e senha repassados estão corretos
 * @param - uma conexão aberta
 * @param - array com usuário e senha
 */
function consultaDadosDoUsuario($conexao, $login)
{
  $login['senhaHash'] = criaCodigoHash($login['senha']);

  $sql =
    "SELECT
      id,
      nome
    FROM av_usuarios
    WHERE usuario = '{$login['usuario']}'
      AND senha   = '{$login['senhaHash']}'";

  $resultado = mysqli_query($conexao, $sql);

  if ($resultado->num_rows <= 0) {

    echo 'Usuário ou Senha incorretos!';

    header('Location: ' . BASE_URL . 'public/views/login/form-login.php');

    exit();

  }

  $usuario = mysqli_fetch_assoc($resultado);

  session_start();
  $_SESSION['usuario_logado']       = true;
  $_SESSION['id_usuario']   = $usuario['id'];
  $_SESSION['nome_usuario'] = $usuario['nome'];

  header('Location: ' . BASE_URL . 'public/home.php');

}
