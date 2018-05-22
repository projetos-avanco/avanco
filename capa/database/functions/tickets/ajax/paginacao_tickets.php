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
  $query = "SELECT COUNT(id) FROM av_tickets;";

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
require DIRETORIO_HELPERS . 'datas.php';

$db = abre_conexao();

$dados = array();

$columns = array(
  0 => 'data',
  1 => 'ticket',
  2 => 'colaborador',
  3 => 'data_agendada',
  4 => 'hora_agendada',
  5 => 'chat_id',
  6 => 'razao_social',
  7 => 'validade'
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
        DATE_FORMAT(t.data_hora, '%Y-%m-%d') AS data,
        t.ticket, 
        CONCAT(c.name, ' ', c.surname) AS colaborador,
        DATE_FORMAT(t.agendado, '%Y-%m-%d') AS data_agendada,
	      DATE_FORMAT(t.agendado, '%H:%i:%s') AS hora_agendada,
        CASE
          WHEN (t.chat_id IS NULL)
            THEN (0)
          ELSE
            (t.chat_id)
        END AS chat_id,
        CASE
          WHEN (t.validade = 0)
            THEN ('Vencido')
          WHEN (t.validade = 1)
            THEN ('Válido')
        END AS validade,
        t.razao_social
      FROM av_tickets AS t
      INNER JOIN lh_users AS c
        ON c.id = t.colaborador) AS a
    WHERE
      (a.data 			   LIKE $search OR 
       a.ticket 			 LIKE $search OR
       a.colaborador 	 LIKE $search OR
       a.data_agendada LIKE $search OR
       a.hora_agendada LIKE $search OR
       a.chat_id       LIKE $search OR
       a.validade 		 LIKE $search OR
       a.razao_social  LIKE $search)";

  $resultado = $db->query($query);

  # chamando função que retorna o total de registros filtrados
  $json = retornaTotalDeRegistrosFiltrados($resultado->num_rows, $json);

  $query .= 
    "ORDER BY " . $columns[$_POST['order'][0]['column']] . " " . $_POST['order'][0]['dir'] . " LIMIT " . $_POST['start'] . " , " . $_POST['length'] ." ";
  
    # verificando se a consulta pode se executada
  if ($resultado = $db->query($query)) {

    # recuperando registros
    while ($registro = $resultado->fetch_assoc()) {

      # chamando função que formata a data para exibir na página
      $registro['data'] = formataDataParaExibir($registro['data']);
      $registro['data_agendada'] = formataDataParaExibir($registro['data_agendada']);

      $dados[] = array(
        
        'data'           => $registro['data'],
        'ticket'         => $registro['ticket'],
        'colaborador'    => $registro['colaborador'],
        'data_agendada'  => $registro['data_agendada'],        
        'hora_agendada'  => $registro['hora_agendada'],        
        'chat_id'        => $registro['chat_id'],
        'razao_social'   => $registro['razao_social'],
        'validade'       => $registro['validade'],
        'visualizar'     => $registro['chat_id']
      
      );

    }

  }

# realizando busca pelas páginas da tabela
} else {

  $query =
    "SELECT
      DATE_FORMAT(t.data_hora, '%Y-%m-%d') AS data,	
      t.ticket,
      CONCAT(c.name, ' ', c.surname) AS colaborador,
      DATE_FORMAT(t.agendado, '%Y-%m-%d') AS data_agendada,      
      DATE_FORMAT(t.agendado, '%H:%i:%s') AS hora_agendada,      
      CASE
        WHEN (t.chat_id IS NULL)
          THEN (0)
      ELSE
      t.chat_id
      END AS chat_id,
      CASE
        WHEN (t.validade = 0)
          THEN ('Vencido')
        WHEN (t.validade = 1)
          THEN ('Válido')
      END AS validade,
      t.razao_social
    FROM av_tickets AS t
    INNER JOIN lh_users AS c
      ON c.id = t.colaborador
    ORDER BY " . $columns[$_POST['order'][0]['column']] . " " . $_POST['order'][0]['dir'] . 
    " LIMIT " . $_POST['length'] . " OFFSET " . $_POST['start'];

  # verificando se a consulta pode se exeuctada
  if ($resultado = $db->query($query)) {

    # recuperando registros
    while ($registro = $resultado->fetch_assoc()) {

      # chamando função que formata a data para exibir na página
      $registro['data'] = formataDataParaExibir($registro['data']);
      $registro['data_agendada'] = formataDataParaExibir($registro['data_agendada']);

      $dados[] = array(
        
        'data'           => $registro['data'],
        'ticket'         => $registro['ticket'],
        'colaborador'    => $registro['colaborador'],
        'data_agendada'  => $registro['data_agendada'],        
        'hora_agendada'  => $registro['hora_agendada'],        
        'chat_id'        => $registro['chat_id'],
        'razao_social'   => $registro['razao_social'],
        'validade'       => $registro['validade']        
      
      );

    }

  }

}

# repassando registros encontrados para o array que será retornado
$json['data'] = $dados;

# transformando array para o formato JSON
echo json_encode($json);