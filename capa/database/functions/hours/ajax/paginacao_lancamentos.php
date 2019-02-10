<?php

/**
 * responsável por retornar o número da página da tabela
 * @param - array com os dados que serão retornados via json
 */
function retornaNumeroDaPaginaDaTabela($json)
{
  $json['draw'] = intval($_POST['draw']);

  return $json;

}

/**
 * responsável por retornar o total de registros encontrados
 * @param - objeto com uma conexão aberta
 * @param - array com os dados que serão retornados via json
 */
function retornaTotalDeRegistros($db, $json)
{
  $query = "SELECT COUNT(id) FROM av_registro_horas_issues;";

  if ($resultado = $db->query($query)) {
    
    $json['recordsTotal'] = $resultado->fetch_row();

    $json['recordsTotal'] = $json['recordsFiltered'] = intval($json['recordsTotal'][0]);

  }

  return $json;

}

/**
 * responsável por retornar o total de registros filtrados
 * @param - string com o total de de registros filtrados
 * @param - array com os dados que serão retornados via json
 */
function retornaTotalDeRegistrosFiltrados($registros, $json)
{
  $json['recordsFiltered'] = intval($registros);

  return $json;

}

require '../../../../init.php';

$db = abre_conexao();

$dados = array();

$columns = array(
  0 => 'id',  
  1 => 'issue',
  2 => 'razao_social',
  3 => 'supervisor'
);

$json = array(
  'draw'            => 0,
  'recordsTotal'    => 0,
  'recordsFiltered' => 0,
  'data'            => array()
);

# chamando funções que retornam o número da página e o total de registros da tabela
$json = retornaNumeroDaPaginaDaTabela($json);
$json = retornaTotalDeRegistros($db, $json);

# verificando se o usuário está realizando uma busca pelo filtro
if (isset($_POST['search']['value']) && ! empty($_POST['search']['value'])) {

  # recuperando o valor informado no filtro
  $search = "'%" . str_replace(",", "','", $_POST['search']['value']) . "%'";

  $query = 
    "SELECT
      *
    FROM
      (SELECT
        i.id,
        CONCAT(u.name, ' ', u.surname) AS supervisor,
        i.issue,
        i.razao_social
      FROM av_registro_horas_issues AS i
      INNER JOIN lh_users AS u
        ON u.id = i.supervisor) AS a
    WHERE 
      (a.id 		      LIKE $search OR
       a.supervisor 	LIKE $search OR
       a.issue        LIKE $search OR
       a.razao_social LIKE $search)";

  $resultado = $db->query($query);

  # chamando função que retorna o total de registros filtrados
  $json = retornaTotalDeRegistrosFiltrados($resultado->num_rows, $json);

  $query .= 
    " ORDER BY " . $columns[$_POST['order'][0]['column']] . " " . $_POST['order'][0]['dir'] . " LIMIT " . $_POST['start'] . " , " . $_POST['length'] ." ";
    
    # verificando se a consulta pode se executada
  if ($resultado = $db->query($query)) {

    # recuperando registros
    while ($registro = $resultado->fetch_assoc()) {

      $registro['issue'] = strtoupper($registro['issue']);

      $dados[] = array(
        'id'           => $registro['id'],
        'supervisor'   => $registro['supervisor'],
        'issue'        => $registro['issue'],        
        'razao_social' => $registro['razao_social']      
      );

    }

  }

# realizando busca pelas páginas da tabela
} else {

  $query =
    "SELECT
      i.id,
      CONCAT(u.name, ' ', u.surname) AS supervisor,
      i.issue,
      i.razao_social
    FROM av_registro_horas_issues AS i
    INNER JOIN lh_users AS u
      ON u.id = i.supervisor
    ORDER BY " . $columns[$_POST['order'][0]['column']] . " " . $_POST['order'][0]['dir'] . 
    " LIMIT " . $_POST['length'] . " OFFSET " . $_POST['start'];

  # verificando se a consulta pode se exeuctada
  if ($resultado = $db->query($query)) {

    # recuperando registros
    while ($registro = $resultado->fetch_assoc()) {

      $registro['issue'] = strtoupper($registro['issue']);

      $dados[] = array(        
        'id'           => $registro['id'],
        'supervisor'   => $registro['supervisor'],
        'issue'        => $registro['issue'],        
        'razao_social' => $registro['razao_social']      
      );

    }

  }

}

# repassando registros encontrados para o array que será retornado
$json['data'] = $dados;

# transformando array para o formato JSON
echo json_encode($json);