<?php 

/**
 * atualiza data de saída do colaborador de um time
 * @param - objeto com uma conexão aberta
 * @param - array com os dados de cadastro
 */
function atualizaDataSaidaDoTime($db, $cadastro)
{
  $query =
    "UPDATE av_dashboard_colaborador_times 
      SET 
        data_saida = NOW() 
      WHERE (id_colaborador = {$cadastro['id_colaborador']})
        AND data_saida IS NULL";
  
  mysqli_query($db, $query);
}

/**
 * atualiza dados do usuário no portal avanção
 * @param - objeto com uma conexão aberta
 * @param - array com os dados de cadastro
 */
function atualizaDadosPortalUsuario($db, $cadastro)
{
  $query = 
    "UPDATE av_usuarios_login 
      SET 
        nivel    =  {$cadastro['nivel']},
        regime   = '{$cadastro['regime']}',
        contrato = '{$cadastro['contrato']}',
        admissao = '{$cadastro['admissao']}',
        ramal    = '{$cadastro['ramal']}'
      WHERE id =  {$cadastro['id_portal']}";

  mysqli_query($db, $query);
}

/**
 * atualiza o nível de usuário para administrador
 * @param - objeto com uma conexão aberta
 * @param - array com os dados de cadastro
 */
function atualizaDadosPortalAdministrador($db, $cadastro)
{
  $query = 
    "UPDATE av_usuarios_login 
      SET 
        nivel    = 2,
        regime   = '1',
        contrato = '0',
        admissao = '{$cadastro['admissao']}',
        ramal    = '{$cadastro['ramal']}',
      WHERE id = {$cadastro['id_portal']}";

  mysqli_query($db, $query);
}

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