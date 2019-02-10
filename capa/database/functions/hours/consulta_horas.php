<?php 

/**
 * verifica se já existe um registro com o mesmo número de issue na tabela de issues
 * @param - objeto com uma conexão aberta
 * @param - string com o número da issue
 */
function verificaDuplicidadeDeIssue($db, $issue)
{
  $query = "SELECT * FROM av_registro_horas_issues WHERE (issue = '$issue');";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    # verificando se já existe um registro com o mesmo número de issue na tabela de issues
    if ($resultado->num_rows > 0) {

      return true;

    } else {

      return false;

    }

  }

}

/**
 * consulta o id da issue inserido na tabela de issues
 */
function consultaIdDaIssue($db, $issue)
{
  $query = "SELECT id FROM av_registro_horas_issues WHERE (issue = '$issue');";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    # recuperando dado
    $resultado = $resultado->fetch_row();

    $id = (int)$resultado[0];

  }

  return $id;

}

/**
 * consulta todas as issues gravadas no registro de horas
 * @param - objeto com uma conexão aberta
 * @param - array modelo os dados das issues
 */
function consultaTodasAsIssuesDoRegistroDeHoras($db, $issues)
{
  $query =
    "SELECT
      i.id,
      CONCAT(u.name, ' ', u.surname) AS supervisor,
      i.cnpj,
      i.conta_contrato,
      i.razao_social,
      i.issue
    FROM av_registro_horas_issues AS i
    INNER JOIN lh_users AS u
      ON u.id = i.supervisor
    ORDER BY i.id DESC";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {
    
    # recuperando os dados
    while ($registro = $resultado->fetch_assoc()) {

      $registro['issue'] = strtoupper($registro['issue']);      

      $issues[] = array(

        'id'             => $registro['id'],
        'supervisor'     => $registro['supervisor'],
        'cnpj'           => $registro['cnpj'],
        'conta_contrato' => $registro['conta_contrato'],
        'razao_social'   => $registro['razao_social'],
        'issue'          => $registro['issue']

      );
      
    }

  }

  return $issues;

}

/**
 * consulta os dados de registro de uma única issue
 * @param - objeto com uma conexão aberta
 * @param - string com o número da issue
 */
function consultaDadosCadastraisDaIssue($db, $issue)
{
  $issues = array(

    'id'             => '',
    'issue'          => '',
    'tipo'           => '',
    'cnpj'           => '',
    'conta_contrato' => '',
    'razao_social'   => '',
    'supervisor'     => '',
    'colaborador'    => '',
    'observacao'     => ''

  );

  $query =
    "SELECT
      i.id,
      i.issue,
      i.tipo,
      i.cnpj,
      i.conta_contrato,
      i.razao_social,
      CONCAT(s.name, ' ', s.surname) AS supervisor,
      c.id AS id_colaborador,
      CONCAT(c.name, ' ', c.surname) AS colaborador,
      i.observacao
    FROM av_registro_horas_issues AS i
    INNER JOIN lh_users AS s
      ON s.id = i.supervisor
    INNER JOIN lh_users AS c
      ON c.id = i.colaborador
    WHERE (i.issue = '$issue')";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    # recuperando os dados
    while ($registro = $resultado->fetch_assoc()) {

      $registro['issue'] = strtoupper($registro['issue']);
      $registro['tipo']  = ucwords($registro['tipo']);

      $issues['id']             = $registro['id'];
      $issues['issue']          = $registro['issue'];
      $issues['tipo']           = $registro['tipo'];
      $issues['cnpj']           = $registro['cnpj'];
      $issues['conta_contrato'] = $registro['conta_contrato'];
      $issues['razao_social']   = $registro['razao_social'];
      $issues['supervisor']     = $registro['supervisor'];
      $issues['id_colaborador'] = $registro['id_colaborador'];
      $issues['colaborador']    = $registro['colaborador'];
      $issues['observacao']     = $registro['observacao'];

    }

  }

  return $issues;

}

/**
 * consulta as despesas de uma única issue
 * @param - objeto com uma conexão aberta
 * @param - string com o id da issue
 */
function consultaDadosDeDespesaDaIssue($db, $id)
{
  $despesas = array(

    'deslocamento'   => 0.0,
    'alimentacao'    => 0.0,
    'hospedagem'     => 0.0,
    'total_despesas' => 0.0

  );

  $query = 
    "SELECT
      deslocamento,
      alimentacao,
      hospedagem,
      total
    FROM av_registro_horas_despesas
    WHERE (id_issue = $id)";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    # recuperando os dados
    while ($registro = $resultado->fetch_assoc()) {

      $despesas['deslocamento']   = $registro['deslocamento'];
      $despesas['alimentacao']    = $registro['alimentacao'];
      $despesas['hospedagem']     = $registro['hospedagem'];
      $despesas['total_despesas'] = $registro['total'];

    }

  }

  return $despesas;
  
}

/**
 * consulta todos os lançamentos de uma única issue
 * @param - objeto com uma conexão aberta
 * @param - string com o id da issue
 */
function consultaDadosDeLancamentosDaIssue($db, $id)
{
  require DIRETORIO_HELPERS  . 'datas.php';

  $lancamentos = array();
  
  $query = 
    "SELECT
      data,
      CASE
        WHEN (produto = 1)
          THEN 'Integral'
        WHEN (produto = 2)
          THEN 'Frente de Loja'
        WHEN (produto = 3)
          THEN 'Gestor'
        WHEN (produto = 4)
          THEN 'Novo ERP'
      END AS produto,
      horas_trabalhadas,
      horas_faturadas,
      valor_hora,
      total
    FROM av_registro_horas_lancamentos
    WHERE (id_issue = $id)";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    # recuperando dados
    while ($registro = $resultado->fetch_assoc()) {

      $registro['data']  = formataDataParaExibir($registro['data']);

      $lancamentos[] = array(

        'data'              => $registro['data'],
        'produto'           => $registro['produto'],
        'horas_trabalhadas' => $registro['horas_trabalhadas'],
        'horas_faturadas'   => $registro['horas_faturadas'],
        'valor_hora'        => $registro['valor_hora'],
        'total'             => $registro['total']

      );

    }

  }

  return $lancamentos;

}

/**
 * consulta os dados de uma única issue
 * @param - objeto com uma conexão aberta
 * @param - array modelo para os dados de lançamentos
 * @param - array com o período
 */
function consultaDadosDoRegistroDeHoras($db, $dados, $issue) 
{
  $issues      = consultaDadosCadastraisDaIssue($db, $issue);
  $despesas    = consultaDadosDeDespesaDaIssue($db, $issues['id']);
  $lancamentos = consultaDadosDeLancamentosDaIssue($db, $issues['id']);

  $dados = array_merge($issues, $despesas, $lancamentos);
  
  return $dados;

}