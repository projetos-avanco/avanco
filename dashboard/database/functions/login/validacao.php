<?php

require DIRETORIO_HELPERS . 'caracteres.php';

/**
 * consulta usuário e senha na base de dados e cria as variáveis de sessão para o usuário logado
 * @param - objeto com uma conexão aberta
 * @param - array com os dados de login
 */
function consultaDadosDeLogin($conexao, $login)
{
  $query =
    "SELECT
    	id,
      nome,
      sobrenome,
      usuario,
      nivel
    FROM av_usuarios_login
    WHERE (email = '{$login['usuario']}')
    	AND (senha = '{$login["senha"]}')
      AND (ativo = 1)
    		LIMIT 1";

  $resultado = mysqli_query($conexao, $query);

  # verificando se o usuário está cadastrado no sistema
  if ($resultado->num_rows != 1) {

    # setando mensagem de usuário ou senha incorretos na sessão
    $_SESSION['usuario']['tipo']     = 4;
    $_SESSION['usuario']['mensagem'] = 'Usuário ou senha incorreto!';

    # eliminando array de login
    unset($login);

    # fechando conexao com a base de dados
    fecha_conexao($conexao);

    # chamando função que redireciona o usuário (para a página de dashboard ou de volta para a página de login)
    redirecionaUsuario();

  } else {

    # recuperando dados do usuário
    while ($registros = mysqli_fetch_assoc($resultado)) {

      $login['id']        = $registros['id'];
      $login['nome']      = $registros['nome'];
      $login['sobrenome'] = $registros['sobrenome'];
      $login['usuario']   = $registros['usuario'];
      $login['nivel']     = $registros['nivel'];

    }

    # setando os dados do usuário na sessão
    $_SESSION['usuario']['id']        = $login['id'];
    $_SESSION['usuario']['nome']      = $login['nome'];
    $_SESSION['usuario']['sobrenome'] = $login['sobrenome'];
    $_SESSION['usuario']['usuario']   = $login['usuario'];
    $_SESSION['usuario']['nivel']     = (int)$login['nivel'];
    $_SESSION['usuario']['logado']    = true;
    $_SESSION['usuario']['tipo']      = 1;
    $_SESSION['usuario']['mensagem']  = 'usuário cadastrado.';

    # eliminando array de login
    unset($login);

    # fechando conexao com a base de dados
    fecha_conexao($conexao);

    # chamando função que redireciona o usuário (para a página de dashboard ou de volta para a página de login)
    redirecionaUsuario();

  }

}
