<?php

/**
 * verifica na base de dados se login e senha repassados estão corretos
 * @param - uma conexão aberta
 * @param - array com usuário e senha
 */
function consultaDadosDoUsuario($login, $usuario, $db)
{
  $query =
    "SELECT
      id,
      nome,
      sobrenome,
      email,
      nivel
    FROM av_usuarios_login
    WHERE (email = '{$login['email']}')
      AND (senha = '{$login['senha_hash']}')
      AND (ativo = true);";

  if ($resultado = $db->query($query)) {

    if ($resultado->num_rows > 0) {

      while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

        $usuario['id']        = $registro['id'];
        $usuario['nome']      = $registro['nome'];
        $usuario['sobrenome'] = $registro['sobrenome'];
        $usuario['email']     = $registro['email'];
        $usuario['nivel']     = $registro['nivel'];

      }

      $_SESSION['usuario']['id']        = $usuario['id'];
      $_SESSION['usuario']['nome']      = $usuario['nome'];
      $_SESSION['usuario']['sobrenome'] = $usuario['sobrenome'];
      $_SESSION['usuario']['email']     = $usuario['email'];
      $_SESSION['usuario']['nivel']     = $usuario['nivel'];
      $_SESSION['usuario']['logado']    = true;

      header('Location: ' . BASE_URL . 'public/home.php');

    }

  } else {

    $_SESSION['mensagem'] = 'Email ou Senha incorreto!';
    $_SESSION['tipo']     = 'danger';

    header('Location: ' . BASE_URL . 'public/views/login/form-login.php');

  }

  $db->close();

}
