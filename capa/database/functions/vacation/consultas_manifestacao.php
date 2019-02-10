<?php

/**
 * consulta o exercício do ano vigente agendado do colaborador
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 */
function consultaExercicioAgendadoDoColaborador($db, $id)
{
  $ano = date('Y') - 1;

  $query = 
    "SELECT
      e.id,
      CONCAT(s.name, ' ', s.surname) AS supervisor,
      CONCAT(c.name, ' ', c.surname) AS colaborador,
      CASE
        WHEN (e.status = true)
          THEN 'Agendadas'
        WHEN (e.status = false)
          THEN 'Não Agendadas'
      END AS status,
      DATE_FORMAT(e.exercicio_inicial, '%d/%m/%Y') AS exercicio_inicial,
      DATE_FORMAT(e.exercicio_final, '%d/%m/%Y') AS exercicio_final,
      DATE_FORMAT(e.vencimento, '%d/%m/%Y') AS vencimento,
      DATE_FORMAT(e.registrado, '%d/%m/%Y %H:%i:%s') AS registrado
    FROM av_agenda_exercicios_ferias AS e
    INNER JOIN lh_users AS s
      ON s.id = e.supervisor
    INNER JOIN lh_users AS c
      ON c.id = e.colaborador
    WHERE (e.colaborador = $id) 
      AND (e.status = true) 
      AND (DATE_FORMAT(e.exercicio_inicial, '%Y') = '$ano')";
  
  $resultado = mysqli_query($db, $query);

  $tr = '';

  while ($linha = mysqli_fetch_array($resultado)) {
    $id          = $linha['id'];
    $supervisor  = $linha['supervisor'];
    $colaborador = $linha['colaborador'];
    $status      = $linha['status'];
    $inicial     = $linha['exercicio_inicial'];
    $final       = $linha['exercicio_final'];
    $vencimento  = $linha['vencimento'];
    $registrado  = $linha['registrado'];
    
    $tr .= "<tr data-id='$id'>";
      $tr .= "<td class='text-center'>$supervisor</td>";
      $tr .= "<td class='text-center'>$colaborador</td>";
      $tr .= "<td class='text-center'>$status</td>";
      $tr .= "<td class='text-center'>$inicial</td>";
      $tr .= "<td class='text-center' data-final='$final'>$final</td>";
      $tr .= "<td class='text-center' data-vencimento='$vencimento'>$vencimento</td>";
      $tr .= "<td class='text-center'>$registrado</td>";    
    $tr .= "</tr>";
  }

  echo $tr; exit;
}

/**
 * consulta todos os exercícios de férias informando se existem pedidos de férias aguardando aprovação
 * @param - objeto com uma conexão aberta
 */
function consultaTodosOsExerciciosDeFerias($db)
{
  $query = 
    "SELECT
      DISTINCT
        e.id,
        e.colaborador AS id_colaborador,
        CONCAT(s.name, ' ', s.surname) AS supervisor,
        CONCAT(c.name, ' ', c.surname) AS colaborador,
        CASE
          WHEN (r.regime = '1')
            THEN 'Empregado'
          WHEN (r.regime = '2')
            THEN 'Estagiário'
        END AS regime,
        CASE
          WHEN (r.contrato = '0')
            THEN 'CLT'
          WHEN (r.contrato = '1')
            THEN 'Contrato Semestral'
          WHEN (r.contrato = '2')
            THEN 'Contrato Anual'
        END AS contrato,
        CASE
          WHEN (e.status = true)
            THEN 'Agendadas'
          WHEN (e.status = false)
            THEN 'Não Agendadas'
        END AS status,
        CASE
          WHEN (p.situacao = '1')
            THEN 'Aguardando Aprovação'
          WHEN (p.situacao = '2')
            THEN 'Aprovado'
        END AS pedido,        
        e.exercicio_inicial AS exercicio_inicial,
        e.exercicio_final AS exercicio_final,
        e.vencimento AS vencimento,
        DATE_FORMAT(e.registrado, '%Y-%m-%d') AS registrado
      FROM av_agenda_exercicios_ferias AS e
      LEFT JOIN av_agenda_pedidos_ferias AS p
        ON p.id_exercicio = e.id
      INNER JOIN lh_users AS s
        ON s.id = e.supervisor
      INNER JOIN lh_users AS c
        ON c.id = e.colaborador
      INNER JOIN av_usuarios_login AS r
        ON r.email = c.email
      WHERE (e.status = true)
        ORDER BY e.exercicio_inicial DESC;";
  
  $resultado = mysqli_query($db, $query);

  $dados = array();

  while ($linha = mysqli_fetch_array($resultado)) {
    $linha['exercicio_inicial'] = formataDataParaExibir($linha['exercicio_inicial']);
    $linha['exercicio_final']   = formataDataParaExibir($linha['exercicio_final']);
    $linha['vencimento']        = formataDataParaExibir($linha['vencimento']);
    $linha['registrado']        = formataDataParaExibir($linha['registrado']);

    $dados[] = array(
      'id'                => $linha['id'],
      'id_colaborador'    => $linha['id_colaborador'],
      'supervisor'        => $linha['supervisor'],
      'colaborador'       => $linha['colaborador'],
      'regime'            => $linha['regime'],
      'contrato'          => $linha['contrato'],
      'status'            => $linha['status'],
      'pedido'            => $linha['pedido'],
      'exercicio_inicial' => $linha['exercicio_inicial'],
      'exercicio_final'   => $linha['exercicio_final'],
      'vencimento'        => $linha['vencimento'],
      'registrado'        => $linha['registrado']
    );
  }

  return $dados;
}

/**
 * consulta os pedidos de um exercicio de férias
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do exercício de férias
 */
function consultaPedidosDeFeriasDeUmExercicio($db, $id)
{
  $query =
    "SELECT
      e.registro,
      CASE
        WHEN (situacao = '1')
          THEN 'Aguardando Aprovação'
        WHEN (situacao = '2')
          THEN 'Aprovado'
      END AS situacao,
      e.data_inicial,
      e.data_final,
      e.dias
    FROM av_agenda_pedidos_ferias AS e
    WHERE (e.id_exercicio = $id)";
  
  $resultado = mysqli_query($db, $query);

  $pedidos = array();

  while ($linha = mysqli_fetch_array($resultado)) {
    $linha['data_inicial'] = formataDataParaExibir($linha['data_inicial']);
    $linha['data_final']   = formataDataParaExibir($linha['data_final']);

    $pedidos[] = array(
      'registro'     => $linha['registro'],
      'situacao'     => $linha['situacao'],
      'data_inicial' => $linha['data_inicial'],
      'data_final'   => $linha['data_final'],
      'dias'         => $linha['dias']
    );
  }

  return $pedidos;
}