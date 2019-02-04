<?php

require '../../../../../init.php';
require DIRETORIO_HELPERS . 'datas.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $filtros = array();

  $db = abre_conexao();

  # verificando se o filtro de empresa foi enviado e não está vazio
  if (isset($_POST['id']) && (!empty($_POST['id']))) {
    # verificando se o id da empresa é numérico
    if (is_numeric($_POST['id'])) {
      $filtros['id'] = (int) $_POST['id'];
    }
  } else {
    # cnpj da empresa não foi enviado, retornando 0
    echo json_encode(0); exit;
  }

  # verificando se o filtro data inicial foi enviada e não está vazia
  if (isset($_POST['data_inicial']) && (!empty($_POST['data_inicial']))) {
    # verificando se a data inicial é uma string
    if (is_string($_POST['data_inicial'])) {
      $filtros['data_inicial'] = $_POST['data_inicial'];
    }      
  }

  # verificando se o filtro data final foi enviada e não está vazia
  if (isset($_POST['data_final']) && (!empty($_POST['data_final']))) {
    # verificando se a data final é uma string
    if (is_string($_POST['data_final'])) {
      $filtros['data_final'] = $_POST['data_final'];
    }      
  }

  # verificando se o filtro de data inicial foi enviado
  if (isset($_POST['data_inicial'])) {
    # verificando se a data inicial é uma string
    if (is_string($_POST['data_inicial'])) {
      $filtros['data_inicial'] = $_POST['data_inicial'];
    }
  }

  # verificando se o filtro de data final foi enviado
  if (isset($_POST['data_final'])) {
    # verificando se a data final é uma string
    if (is_string($_POST['data_final'])) {
      $filtros['data_final'] = $_POST['data_final'];
    }
  }

  $query =
    "SELECT
    e.id,
    e.id_contato,
    e.id_cnpj,      
    e.registro,
    CASE
      WHEN (e.status = 1)
        THEN 'Confirmado'
      WHEN (e.status = 2)
        THEN 'À Confirmar'
      WHEN (e.status = 3)
        THEN 'Reservado'
      WHEN (e.status = 4)
        THEN 'Cancelado'
    END AS status,
    CONCAT(s.name, ' ', s.surname) AS supervisor,
    CONCAT(t.name, ' ', t.surname) AS colaborador,	
    CASE 
      WHEN (e.tipo = 1)
        THEN 'Visita de Relacionamento'
      WHEN (e.tipo = 2)
        THEN 'Ligação para o Dono'
      WHEN (e.tipo = 3)
        THEN 'Envio de E-mail'
    END AS tipo,
    r.razao_social AS empresa,
    r.cnpj,
    c.nome AS contato,
    DATE_FORMAT(e.registrado, '%Y-%m-%d') AS registrado,
    e.data_inicial,
    e.data_final,
    e.horario,
    CASE
      WHEN (e.produto = 1)
        THEN 'Integral'
      WHEN (e.produto = 2)
        THEN 'Frente Avanço'
      WHEN (e.produto = 3)
        THEN 'Gestor'
      WHEN (e.produto = 4)
        THEN 'Novo ERP'
      WHEN (e.produto = 5)
        THEN 'Outros'
    END AS produto,
    e.observacao,
    CASE
      WHEN (e.faturado = false)
        THEN 'Não'
      WHEN (e.faturado = true)
        THEN 'Sim'
    END AS faturado,
    CASE
      WHEN (e.despesa = false)
        THEN 'Não'
      WHEN (e.despesa = true)
        THEN 'Sim'
    END AS despesa      
  FROM av_agenda_atendimentos_gestao_clientes AS e       
  INNER JOIN av_agenda_cnpjs AS r
    ON r.id = e.id_cnpj
  INNER JOIN lh_users AS s
    ON s.id = e.supervisor
  INNER JOIN lh_users AS t
    ON t.id = e.colaborador
  INNER JOIN av_agenda_contatos AS c
    ON c.id = e.id_contato
  WHERE (e.data_inicial BETWEEN '{$filtros['data_inicial']}' AND '{$filtros['data_final']}')
    AND (r.id LIKE '%{$filtros['id']}%');";
  
  $resultado = mysqli_query($db, $query);

  $dados = array();

  while ($linha = mysqli_fetch_array($resultado)) {        
    $linha['cnpj']     = substr($linha['cnpj'], 0, 2) . '.'. substr($linha['cnpj'], 2, 3) . '.' . substr($linha['cnpj'], 5, 3) . '/' . substr($linha['cnpj'], 8, 4) . '-' . substr($linha['cnpj'], 12, 2);
    $linha['contato'] = ucwords($linha['contato']);
    $linha['observacao'] = ucwords($linha['observacao']);

    $linha['registrado']   = formataDataParaExibir($linha['registrado']);
    $linha['data_inicial'] = formataDataParaExibir($linha['data_inicial']);
    $linha['data_final']   = formataDataParaExibir($linha['data_final']);
    
    $dados[] = array(
      'id'                 => $linha['id'],
      'id_contato'         => $linha['id_contato'],
      'id_cnpj'            => $linha['id_cnpj'],      
      'registro'           => $linha['registro'],
      'status'             => $linha['status'],
      'supervisor'         => $linha['supervisor'],
      'colaborador'        => $linha['colaborador'],
      'tipo'               => $linha['tipo'],
      'empresa'            => $linha['empresa'],
      'cnpj'               => $linha['cnpj'],
      'contato'            => $linha['contato'],
      'registrado'         => $linha['registrado'],
      'periodo'            => $linha['data_inicial'] . ' até ' . $linha['data_final'] . 'às' . $linha['horario'],
      'produto'            => $linha['produto'],
      'observacao'         => $linha['observacao'],
      'faturado'           => $linha['faturado'],
      'despesas'           => $linha['despesa']
    );        
  }

  echo json_encode($dados);
}