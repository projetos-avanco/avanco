<?php

/**
 * verifica na base de dados se email e senha repassados estão corretos
 * @param - uma conexão aberta
 * @param - array com email, senha e senha criptografada
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

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    # verificando se existe um usuário com email e senha criptografada enviados pelo formulário de login
    if ($resultado->num_rows > 0) {

      # recuperando dados do usuário
      while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

        $usuario['id']        = $registro['id'];
        $usuario['nome']      = $registro['nome'];
        $usuario['sobrenome'] = $registro['sobrenome'];
        $usuario['email']     = $registro['email'];
        $usuario['nivel']     = $registro['nivel'];

      }

      # criando variáveis de sessão com os dados do usuário
      $_SESSION['usuario']['id']        = $usuario['id'];
      $_SESSION['usuario']['nome']      = $usuario['nome'];
      $_SESSION['usuario']['sobrenome'] = $usuario['sobrenome'];
      $_SESSION['usuario']['email']     = $usuario['email'];
      $_SESSION['usuario']['nivel']     = $usuario['nivel'];
      $_SESSION['usuario']['logado']    = true;

      # redirecionando usuário para a página home da aplicação
      header('Location: ' . BASE_URL . 'public/home.php');

    } else {

      # criando variáveis de sessão com as mensagens
      $_SESSION['mensagem'] = 'Email ou Senha incorreto!';
      $_SESSION['tipo']     = 'danger';

      # redirecionando usuário para o formulário de login
      header('Location: ' . BASE_URL . 'public/views/login/form_login.php');

    }

  }

  fecha_conexao($db);

}
