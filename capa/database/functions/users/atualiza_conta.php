<?php 

/**
 * atualiza a senha do usuário do portal
 * @param - objeto com uma conexão aberta
 * @param - string com a senha alterada
 * @param - inteiro com o id do usuário do portal avanção
 */
function atualizaSenhaDoPortal($db, $senha, $id)
{
  $query = "UPDATE av_usuarios_login SET senha = '$senha' WHERE id = $id";

  mysqli_query($db, $query);
}

/**
 * atualiza o ramal do usuário
 * @param - objeto com uma conexão aberta
 * @param - string com o ramal alterado
 * @param - inteiro com o id do usuário do portal avanção
 */
function atualizaRamal($db, $ramal, $id)
{
  $query = "UPDATE av_usuarios_login SET ramal = '$ramal' WHERE id = $id";

  mysqli_query($db, $query);
}

/**
 * atualiza a data de admissão do usuário
 * @param - objeto com uma conexão aberta
 * @param - string com a data de admissão alterada
 * @param - inteiro com o id do usuário do portal avanção
 */
function atualizaDataDeAdmissao($db, $admissao, $id)
{
  $query = "UPDATE av_usuarios_login SET admissao = '{$admissao}' WHERE id = $id";

  mysqli_query($db, $query);
}

/**
 * atualiza o nível de usuário
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o nível alterado
 * @param - inteiro com o id do usuário do portal avanção
 */
function atualizaNivel($db, $nivel, $id)
{
  $query = "UPDATE av_usuarios_login SET nivel = $nivel WHERE id = $id";

  mysqli_query($db, $query);
}

/**
 * atualiza o nível de usuário para administrador
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do usuário do portal avanção
 */
function atualizaNivelParaAdministrador($db, $id)
{
  $query = "UPDATE av_usuarios_login SET nivel = 2, regime = '1', contrato = '0' WHERE id = $id";

  mysqli_query($db, $query);
}

/**
 * atualiza o regime de usuário
 * @param - objeto com uma conexão aberta
 * @param - string com o regime alterado
 * @param - inteiro com o id do usuário do portal avanção
 */
function atualizaNivelDoUsuario($db, $nivel, $id)
{
  $query = "UPDATE av_usuarios_login SET nivel = $nivel WHERE id = $id";

  mysqli_query($db, $query);
}

/**
 * atualiza o ramal do usuário
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da conta do usuário
 */
function atualizaRamalDoUsuario($db, $usuario)
{  
  $query =
    "UPDATE av_usuarios_login
      SET ramal = {$usuario['ramal']}
    WHERE (id = {$usuario['id']});";
  
  # verificando se a consulta pode ser executada
  if ($db->query($query)) {

    $resultado = true;

  }

  return $resultado;

}