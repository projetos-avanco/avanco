<?php

/**
 * consulta se o usuário já possui registro no portal avanção
 * @param - objeto com uma conexao aberta
 * @param - string com o nome do usuário
 * @param - string com o sobrenome do usuário
 * @param - string com o nome de usuário
 */
function consultaRegistroExistenteDeUsuario($db, $nome, $sobrenome, $usuario)
{
  $query = 
    "SELECT 
      id 
    FROM av_usuarios_login 
    WHERE nome = '$nome'
      AND (sobrenome = '$sobrenome') 
      AND (usuario = '$usuario')";

  $resultado = mysqli_query($db, $query);

  $id = mysqli_fetch_row($resultado);

  return $id[0];
}

/**
 * consulta os dados de um usuário cadastrado no chat
 * @param - objeto com uma conexão aberta
 * @param - string com o id do chat
 */
function consultaDadosDoUsuarioDoChat($db, $id)
{  
  $query = 
    "SELECT
      u.id,
      u.name AS nome,
      u.surname AS sobrenome,
      u.username AS usuario,
      u.email
    FROM lh_users AS u
    WHERE u.id = $id";
  
  $resultado = mysqli_query($db, $query);

  $dados = array();
  
  while ($linha = mysqli_fetch_assoc($resultado)) {
    array_push($dados, $linha);
  }

  return $dados;
}

/**
 * consulta o ramal do usuário
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da conta do usuário
 */
function retornaRamalDoUsuario($db, $usuario)
{
  $query = "SELECT ramal FROM av_usuarios_login WHERE (id = {$usuario['id']});";

  $ramal = null;

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $ramal = $resultado->fetch_row();
    $ramal = $ramal[0];

  }

  return $ramal;

}

/**
 * retorna todos os ramais dos usuários
 * @param - objeto com uma conexão aberta
 */
function retornaTodosOsRamaisDosUsuarios($db)
{
  $query =
    "SELECT
      id,
      nome,
      sobrenome,
      email,
      ramal
    FROM av_usuarios_login
    ORDER BY nome;";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $arr = array('suporte' => array(), 'comercial' => array(), 'rh' => array());

    # recuperando dados da tabela de usuários do capa
    while ($registro = $resultado->fetch_assoc()) {

      switch ($registro['id']) {

        case '1':

          $arr['comercial'][] = array(

            'nome'      => $registro['nome'],
            'sobrenome' => $registro['sobrenome'],
            'email'     => $registro['email'],
            'ramal'     => $registro['ramal']

          );

          break;

        case '3':

          $arr['rh'][] = array(

            'nome'      => $registro['nome'],
            'sobrenome' => $registro['sobrenome'],
            'email'     => $registro['email'],
            'ramal'     => $registro['ramal']

          );

          break;

        case '2':
        case '5':
        case '6':
        case '7':
        case '9':
        case '10':
        case '11':
        case '13':
        case '14':
        case '15':
        case '16':
        case '17':
        case '18':
        case '19':
        case '21':
        case '22':
        case '23':
        case '24':
        case '25':
        case '26':
        case '27':
        case '28':
        case '29':
        case '30':
        case '33':
        case '34':
        case '35':
        case '36':
        case '37':

          $arr['suporte'][] = array(

            'nome'      => $registro['nome'],
            'sobrenome' => $registro['sobrenome'],
            'email'     => $registro['email'],
            'ramal'     => $registro['ramal']

          );

          break;

      }

    }

  }

  return $arr;

}

/**
 * retorna todos os colaboradores ativos no chat via ajax
 * @param - objeto com uma conexão aberta
 */
function retornaTodosOsColaboradoresAtivosDoChat($db)
{
  $query =
    "SELECT
      id,
      CONCAT(name, ' ', surname) AS nome
    FROM lh_users
    WHERE (disabled = 0)
      AND NOT (id = 1 OR id = 2 OR id = 3 OR id = 4 OR id = 6 OR id = 44)
    ORDER BY name";
  
  $resultado = mysqli_query($db, $query);

  $dados = array();

  while ($linha = mysqli_fetch_array($resultado)) {
    $dados[] = array(
      'id'   => $linha['id'],
      'nome' => $linha['nome']
    );
  }

  echo json_encode($dados); exit;
}