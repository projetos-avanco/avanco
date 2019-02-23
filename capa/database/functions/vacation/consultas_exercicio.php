<?php

/**
 * consulta registro de exercício de férias do ano vigente
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do exercício
 * @param - array com os dados do portal avanção
 */
function consultaExercicioDeFeriasRegistrado($db, $exercicio, $dados)
{
  # verificando se o colaborador é estagiário
  if ($dados['regime'] === '2' && $dados['contrato'] === '1') {
    return 0;
  } else {
    $query = 
      "SELECT
        DATE_FORMAT(exercicio_inicial, '%Y') AS exercicio_inicial
      FROM av_agenda_exercicios_ferias
      WHERE (colaborador = {$exercicio['colaborador']})
      ORDER BY id DESC LIMIT 1";
    
    $resultado = mysqli_query($db, $query);

    $ano = mysqli_fetch_row($resultado);

    $ano = $ano[0];

    $tmp = explode('-', $exercicio['exercicio_inicial']);

    # verificano se o ano do último registro de férias é igual ao do novo exercício lançado
    if ($ano === $tmp[0]) {
      return 1;
    } else {
      return 0;
    }
  }
}

/**
 * consulta o último exercício de férias lançado
 * @param - objeto com uma conexão aberta
 */
function consultaUltimoExercicioDeFerias($db)
{
  $query = "SELECT * FROM av_agenda_exercicios_ferias ORDER BY id DESC LIMIT 1";

  $resultado = mysqli_query($db, $query);

  $id = mysqli_fetch_row($resultado);

  return $id[0];
}

/**
 * consulta os exercícios de férias lançados de um colaborador para tela de pedidos
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 */
function consultaExerciciosDeFeriasLancadosDoColaborador($db, $id)
{
  # verificando se quem solicitou o relatório é para página exercicios_ferias_lancados.php
  if ($id == -1) {
    $query =
      "SELECT
        e.id,
        CONCAT(s.name, ' ', s.surname) AS supervisor,
        CASE
          WHEN (e.status = false)
            THEN 'Não Agendadas'
          WHEN (e.status = true)
            THEN 'Agendadas'
        END AS status,
        CONCAT(c.name, ' ', c.surname) AS colaborador,	
        e.exercicio_inicial,
        e.exercicio_final,
        e.vencimento,
        DATE_FORMAT(e.registrado, '%Y-%m-%d') AS registrado
      FROM av_agenda_exercicios_ferias AS e
      INNER JOIN lh_users AS s
        ON s.id = e.supervisor
      INNER JOIN lh_users AS c
        ON c.id = e.colaborador    
      ORDER BY exercicio_inicial DESC";

    $resultado = mysqli_query($db, $query);

    $tr = '';

    while ($linha = mysqli_fetch_array($resultado)) {
      $linha['exercicio_inicial'] = formataDataParaExibir($linha['exercicio_inicial']);
      $linha['exercicio_final']   = formataDataParaExibir($linha['exercicio_final']);
      $linha['vencimento']        = formataDataParaExibir($linha['vencimento']);
      $linha['registrado']        = formataDataParaExibir($linha['registrado']);

      $id          = $linha['id'];
      $supervisor  = $linha['supervisor'];
      $colaborador = $linha['colaborador'];
      $status      = $linha['status'];
      $inicial     = $linha['exercicio_inicial'];
      $final       = $linha['exercicio_final'];
      $vencimento  = $linha['vencimento'];
      $registrado  = $linha['registrado'];

      $tr .= "<tr>";    
      $tr .= "<td class='text-center' width='15%'>$supervisor</td>";
      $tr .= "<td class='text-left' width='15%'>$status</td>";
      $tr .= "<td class='text-left' width='15%'>$colaborador</td>";
      $tr .= "<td class='text-center' data-inicial='$inicial'>$inicial</td>";
      $tr .= "<td class='text-center' data-final='$final'>$final</td>";
      $tr .= "<td class='text-center' data-vencimento='$vencimento'>$vencimento</td>";
      $tr .= "<td class='text-center'>$registrado</td>";      
      $tr .= 
      "<td class='text-center'>
        <button class='btn btn-sm btn-block btn-danger' id='btn-deletar' type='submit' value='$id'>
          <i class='fa fa-trash' aria-hidden='true'></i> Deletar
        </button>
      </td>";

      $tr .= "</tr>";      
    }
  } else {
    $query = 
      "SELECT
        e.id,
        CONCAT(s.name, ' ', s.surname) AS supervisor,
        CASE
          WHEN (e.status = false)
            THEN 'Não Agendadas'
          WHEN (e.status = true)
            THEN 'Agendadas'
        END AS status,
        CONCAT(c.name, ' ', c.surname) AS colaborador,        
        e.exercicio_inicial,
        e.exercicio_final,
        e.vencimento,
        DATE_FORMAT(e.registrado, '%Y-%m-%d') AS registrado
      FROM av_agenda_exercicios_ferias AS e
      INNER JOIN lh_users AS s
        ON s.id = e.supervisor
      INNER JOIN lh_users AS c
        ON c.id = e.colaborador
      WHERE e.colaborador = $id
      ORDER BY exercicio_inicial DESC";

    $resultado = mysqli_query($db, $query);

    $tr = '';

    while ($linha = mysqli_fetch_array($resultado)) {
      $linha['exercicio_inicial'] = formataDataParaExibir($linha['exercicio_inicial']);
      $linha['exercicio_final']   = formataDataParaExibir($linha['exercicio_final']);
      $linha['vencimento']        = formataDataParaExibir($linha['vencimento']);
      $linha['registrado']        = formataDataParaExibir($linha['registrado']);

      $id          = $linha['id'];
      $supervisor  = $linha['supervisor'];
      $status      = $linha['status'];
      $colaborador = $linha['colaborador'];
      $inicial     = $linha['exercicio_inicial'];
      $final       = $linha['exercicio_final'];
      $vencimento  = $linha['vencimento'];
      $registrado  = $linha['registrado'];

      $tr .= "<tr>";    
      $tr .= "<td class='text-center' width='15%'>$supervisor</td>";
      $tr .= "<td class='text-left' width='15%'>$status</td>";
      $tr .= "<td class='text-left' width='15%'>$colaborador</td>";
      $tr .= "<td class='text-center' data-inicial='$inicial'>$inicial</td>";
      $tr .= "<td class='text-center' data-final='$final'>$final</td>";
      $tr .= "<td class='text-center' data-vencimento='$vencimento'>$vencimento</td>";
      $tr .= "<td class='text-center'>$registrado</td>";      
      
      if ($status === 'Não Agendadas') {
        $tr .= 
        "<td class='text-center'>
          <button class='btn btn-sm btn-block btn-default' id='agendar' type='submit' value='$id'>
            <i class='fa fa-calendar' aria-hidden='true'></i> Agendar
          </button>
        </td>";
      } else {
        $tr .= 
        "<td class='text-center'></td>";
      }

      $tr .= "</tr>";      
    }
  }

  echo $tr;
}

/**
 * consulta os exercícios de férias lançados de um colaborador
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 * @param - string com o status para consulta
 */
function consultaExerciciosDeFeriasLancados($db, $id, $status)
{
  switch ($status) {
    case '':
      $query = 
        "SELECT
          e.id,
          CONCAT(s.name, ' ', s.surname) AS supervisor,
          CASE
            WHEN (e.status = false)
              THEN 'Não Agendadas'
            WHEN (e.status = true)
              THEN 'Agendadas'
          END AS status,
          CONCAT(c.name, ' ', c.surname) AS colaborador,	
          e.exercicio_inicial,
          e.exercicio_final,
          e.vencimento,
          DATE_FORMAT(e.registrado, '%Y-%m-%d') AS registrado
        FROM av_agenda_exercicios_ferias AS e
        INNER JOIN lh_users AS s
          ON s.id = e.supervisor
        INNER JOIN lh_users AS c
          ON c.id = e.colaborador
        WHERE e.colaborador = $id
        ORDER BY exercicio_inicial DESC";
          break;

    case '0':
      $query =
        "SELECT
          e.id,
          CONCAT(s.name, ' ', s.surname) AS supervisor,
          CASE
            WHEN (e.status = false)
              THEN 'Não Agendadas'
            WHEN (e.status = true)
              THEN 'Agendadas'
          END AS status,
          CONCAT(c.name, ' ', c.surname) AS colaborador,	
          e.exercicio_inicial,
          e.exercicio_final,
          e.vencimento,
          DATE_FORMAT(e.registrado, '%Y-%m-%d') AS registrado
        FROM av_agenda_exercicios_ferias AS e
        INNER JOIN lh_users AS s
          ON s.id = e.supervisor
        INNER JOIN lh_users AS c
          ON c.id = e.colaborador
        WHERE e.colaborador = $id
          AND status = false
        ORDER BY exercicio_inicial DESC";
          break;

    case '1':
      $query = 
        "SELECT
          e.id,
          CONCAT(s.name, ' ', s.surname) AS supervisor,
          CASE
            WHEN (e.status = false)
              THEN 'Não Agendadas'
            WHEN (e.status = true)
              THEN 'Agendadas'
          END AS status,
          CONCAT(c.name, ' ', c.surname) AS colaborador,	
          e.exercicio_inicial,
          e.exercicio_final,
          e.vencimento,
          DATE_FORMAT(e.registrado, '%Y-%m-%d') AS registrado
        FROM av_agenda_exercicios_ferias AS e
        INNER JOIN lh_users AS s
          ON s.id = e.supervisor
        INNER JOIN lh_users AS c
          ON c.id = e.colaborador
        WHERE e.colaborador = $id
          AND status = true
        ORDER BY colaborador, exercicio_inicial";
          break;
  }

  $resultado = mysqli_query($db, $query);

  $tr = '';

  while ($linha = mysqli_fetch_array($resultado)) {
    $linha['exercicio_inicial'] = formataDataParaExibir($linha['exercicio_inicial']);
    $linha['exercicio_final']   = formataDataParaExibir($linha['exercicio_final']);
    $linha['vencimento']        = formataDataParaExibir($linha['vencimento']);
    $linha['registrado']        = formataDataParaExibir($linha['registrado']);

    $id          = $linha['id'];
    $supervisor  = $linha['supervisor'];
    $colaborador = $linha['colaborador'];
    $status      = $linha['status'];
    $inicial     = $linha['exercicio_inicial'];
    $final       = $linha['exercicio_final'];
    $vencimento  = $linha['vencimento'];
    $registrado  = $linha['registrado'];

    $tr .= "<tr>";
    $tr .= "<td class='text-center' width='15%'>$supervisor</td>";
    $tr .= "<td class='text-left' width='15%'>$status</td>";
    $tr .= "<td class='text-left' width='15%'>$colaborador</td>";    
    $tr .= "<td class='text-center'>$inicial</td>";
    $tr .= "<td class='text-center'>$final</td>";
    $tr .= "<td class='text-center'>$vencimento</td>";
    $tr .= "<td class='text-center'>$registrado</td>";
    $tr .= 
    "<td class='text-center'>
      <button class='btn btn-sm btn-block btn-danger' id='btn-deletar' type='submit' value='$id'>
        <i class='fa fa-trash' aria-hidden='true'></i> Deletar
      </button>
    </td>";
    $tr .= "</tr>";
  }

  echo $tr; exit;
}

/**
 * consulta a data de admissão, regime e contrato de um colaborador
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 */
function consultaDadosContratuais($db, $id)
{
  $query = 
    "SELECT      
      l.admissao,
      l.regime,
      l.contrato
    FROM av_usuarios_login AS l
    INNER JOIN lh_users AS u
      ON u.username = l.usuario
    WHERE u.id = $id";

  $resultado = mysqli_query($db, $query);

  $dados = array();

  while ($linha = mysqli_fetch_array($resultado)) {    
    $dados['admissao'] = $linha['admissao'];
    $dados['regime']   = $linha['regime'];
    $dados['contrato'] = $linha['contrato'];
  }

  return $dados;
}