<?php

require DIRETORIO_FUNCTIONS . 'login/validacao.php';
require DIRETORIO_MODELS    . 'usuario.php';

/**
 * valida usuário e senha informados no formulário de login
 * @param - string com o usuário
 * @param - string com a senha
 */
function validaFormularioDeLogin($usuario, $senha)
{
  # criando array com o modelo de usuário
  $login = defineArrayModeloDeUsuarioParaLogin();

  # abrindo conexão com a base de dados
  $conexao = abre_conexao();

  # recuperando usuário e senha informados no formulário de login escapando os caracteres especiais
  $login['usuario'] = mysqli_real_escape_string($conexao, $usuario);
  $login['senha']   = mysqli_real_escape_string($conexao, $senha);

  # gerando código hash com a senha informada
  $login['senha'] = geraCodigoHash($login['senha']);

  # chamando função que consulta na base de dados o usuário e senha informados no formulário de login
  consultaDadosDeLogin($conexao, $login);

}
