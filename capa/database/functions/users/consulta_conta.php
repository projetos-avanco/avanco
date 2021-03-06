<?php

/**
 * consulta se o time do colaborador foi alterado
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do time
 * @param - string com o id do chat
 */
function verificaAlteracaoDoTime($db, $time, $id)
{
  $query =
    "SELECT
      id_times
    FROM av_dashboard_colaborador_times AS t
    WHERE (t.id_colaborador = $id)
      AND (t.data_saida IS NULL)";
  
  $resultado = mysqli_query($db, $query);

  $timeAtual = mysqli_fetch_row($resultado);
  $timeAtual = (int) $timeAtual[0];

  return ($timeAtual != $time);
}

/**
 * consulta as especialidades do usuário
 * @param - objeto com uma conexão aberta
 * @param - string com o id do chat
 */
/* function consultaEspecialidadesDoUsuario($db, $id)
{
  $query =
    "SELECT
      DISTINCT
        ce.id_modulo
    FROM av_dashboard_colaborador_especialidades AS ce
    INNER JOIN av_dashboard_modulos AS m
      ON m.id = ce.id_modulo
    WHERE (ce.id_colaborador = $id)
      AND (ce.conhecimento = 1)";
  
  $resultado = mysqli_query($db, $query);

  $dados = array();

  while ($linha = mysqli_fetch_array($resultado)) {
    array_push($dados, $linha['id_modulo']);
  }

  return $dados;
} */

/**
 * consulta as especialidades do usuário
 * @param - objeto com uma conexão aberta
 * @param - string com o id do chat
 */
function consultaEspecialidadesDoUsuario($db, $id)
{
  $query =
    "SELECT
        id_especialidade
    FROM av_dashboard_colaborador_especialidades
    WHERE (id_colaborador = $id)
        AND (conhecimento = 1)";
  
  $resultado = mysqli_query($db, $query);

  $dados = array();

  while ($linha = mysqli_fetch_array($resultado)) {
    array_push($dados, $linha['id_especialidade']);
  }

  return $dados;
}

/**
 * consulta o time atual do usuário
 * @param - objeto com uma conexão aberta
 * @param - string com o id do chat
 */
function consultaTimeDoUsuario($db, $id)
{
  $query =
    "SELECT
      c.id_times
    FROM av_dashboard_colaborador_times AS c
    WHERE (c.id_colaborador = $id)
      AND (c.data_saida IS NULL)";

  $resultado = mysqli_query($db, $query);

  $time = mysqli_fetch_row($resultado);

  return $time[0];
}

/**
 * consulta os dados de um usuário cadastrado no portal avanção
 * @param - objeto com uma conexão aberta
 * @param - string com o id do chat
 */
function consultaDadosDoUsuarioDoPortalAvancao($db, $id)
{
  $query =
    "SELECT
      l.id,
      u.name AS nome,
      u.surname AS sobrenome,
      l.nivel,
      l.regime,
      l.contrato,
      l.admissao,
      l.ramal
    FROM av_usuarios_login AS l
    INNER JOIN lh_users AS u
      ON u.username = l.usuario
    WHERE (u.id = $id)";
  
  $resultado = mysqli_query($db, $query);

  $dados = array();

  while ($linha = mysqli_fetch_array($resultado)) {
    $dados['id']        = $linha['id'];
    $dados['nome']      = $linha['nome'];
    $dados['sobrenome'] = $linha['sobrenome'];
    $dados['nivel']     = $linha['nivel'];
    $dados['regime']    = $linha['regime'];
    $dados['contrato']  = $linha['contrato'];
    $dados['admissao']  = $linha['admissao'];
    $dados['ramal']     = $linha['ramal'];
  }

  return $dados;
}

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
        case '11':
        case '13':
        case '14':        
        case '16':
        case '17':
        case '18':
        case '19':
        case '21':
        case '22':
        case '23':        
        case '25':        
        case '27':
        case '28':
        case '29':
        case '30':
        case '33':
        case '34':
        case '35':        
        case '37':
        case '38':
        case '39':
        case '40':

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