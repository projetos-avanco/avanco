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

      return true;

    } else {

      # criando variáveis de sessão com as mensagens
      $_SESSION['mensagem'] = '<p class="text-center"><strong>Ops!</strong> email ou senha não confere.</p>';
      $_SESSION['tipo']     = 'danger';

      return false;

    }

  }

  fecha_conexao($db);

}
