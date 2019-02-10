<?php

require DIRETORIO_MODELS  . 'sessoes.php';
require DIRETORIO_HELPERS . 'caracteres.php';

/**
 * cria o usuário (query string) para consulta dos dados do colaborador no dashboard
 * @param - string com o nome do colaborador
 * @param - string com o sobrenome do colaborador
 */
function criaUsuariosParaDashboard($nome, $sobrenome)
{
  # retirando acentos, acrescentando . e deixando todas as letras minúsculas para criar o usuário do dashboard
  $usuario = strtolower(removeAcentos($nome)) . '.' . strtolower(removeAcentos($sobrenome));

  return $usuario;
}

/**
 * consulta os colaboradores cadastrados como usuários de nível 1 no sistema
 * @param - objeto com uma conexão aberta
 */
function consultaColaboradoresDoChat($objeto)
{
  # chamando função que cria a sessão de colaboradores
  criaSessaoDeColaboradores();

  $query =
    "SELECT
    	nome,
      sobrenome
    FROM av_usuarios_login
    WHERE (nivel = 1 OR nivel = 3)
    AND (ativo = true)
    ORDER BY nome";

  $resultado = mysqli_query($objeto, $query);

  $options = '';

  # montando os options
  while ($registros = mysqli_fetch_assoc($resultado)) {

    # chamando função que cria o usuário do colaborador no dashboard
    $usuario = criaUsuariosParaDashboard($registros['nome'], $registros['sobrenome']);

    # montando options
    $options .= "<option value='{$usuario}'>{$registros['nome']} {$registros['sobrenome']}</option>";

  }

  # enviando opções para a sessão
  $_SESSION['colaboradores']['options'] = $options;

  # fechando conexão aberta
  fecha_conexao($objeto);
}
