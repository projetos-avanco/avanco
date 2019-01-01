<?php

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
        CONCAT(c.name, ' ', c.surname) AS colaborador,
        CASE
          WHEN (e.status = false)
            THEN 'Não Agendadas'
          WHEN (e.status = true)
            THEN 'Agendadas'
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
      ORDER BY colaborador, status DESC, exercicio_final";

    $resultado = mysqli_query($db, $query);

    $tr = '';

    while ($linha = mysqli_fetch_array($resultado)) {
      $id = $linha['id'];
      $supervisor = $linha['supervisor'];
      $colaborador = $linha['colaborador'];
      $status = $linha['status'];
      $inicial = $linha['exercicio_inicial'];
      $final = $linha['exercicio_final'];
      $vencimento = $linha['vencimento'];
      $registrado = $linha['registrado'];

      $tr .= "<tr>";    
      $tr .= "<td class='text-center'>$supervisor</td>";
      $tr .= "<td class='text-center'>$colaborador</td>";
      $tr .= "<td class='text-center'>$status</td>";
      $tr .= "<td class='text-center'>$inicial</td>";
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
        CONCAT(c.name, ' ', c.surname) AS colaborador,
        CASE
          WHEN (e.status = false)
            THEN 'Não Agendadas'
          WHEN (e.status = true)
            THEN 'Agendadas'
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
      WHERE e.colaborador = $id
      ORDER BY status DESC, exercicio_final";

    $resultado = mysqli_query($db, $query);

    $tr = '';

    while ($linha = mysqli_fetch_array($resultado)) {
      $id = $linha['id'];
      $supervisor = $linha['supervisor'];
      $colaborador = $linha['colaborador'];
      $status = $linha['status'];
      $inicial = $linha['exercicio_inicial'];
      $final = $linha['exercicio_final'];
      $vencimento = $linha['vencimento'];
      $registrado = $linha['registrado'];

      $tr .= "<tr>";    
      $tr .= "<td class='text-center'>$supervisor</td>";
      $tr .= "<td class='text-center'>$colaborador</td>";
      $tr .= "<td class='text-center'>$status</td>";
      $tr .= "<td class='text-center'>$inicial</td>";
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
          CONCAT(c.name, ' ', c.surname) AS colaborador,
          CASE
            WHEN (e.status = false)
              THEN 'Não Agendadas'
            WHEN (e.status = true)
              THEN 'Agendadas'
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
        WHERE e.colaborador = $id
        ORDER BY colaborador, exercicio_inicial, status DESC";
          break;

    case '0':
      $query =
        "SELECT
          e.id,
          CONCAT(s.name, ' ', s.surname) AS supervisor,
          CONCAT(c.name, ' ', c.surname) AS colaborador,
          CASE
            WHEN (e.status = false)
              THEN 'Não Agendadas'
            WHEN (e.status = true)
              THEN 'Agendadas'
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
        WHERE e.colaborador = $id
          AND status = false
        ORDER BY colaborador, exercicio_inicial";
          break;

    case '1':
      $query = 
        "SELECT
          e.id,
          CONCAT(s.name, ' ', s.surname) AS supervisor,
          CONCAT(c.name, ' ', c.surname) AS colaborador,
          CASE
            WHEN (e.status = false)
              THEN 'Não Agendadas'
            WHEN (e.status = true)
              THEN 'Agendadas'
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
        WHERE e.colaborador = $id
          AND status = true
        ORDER BY colaborador, exercicio_inicial";
          break;
  }

  $resultado = mysqli_query($db, $query);

  $tr = '';

  while ($linha = mysqli_fetch_array($resultado)) {
    $id = $linha['id'];
    $supervisor = $linha['supervisor'];
    $colaborador = $linha['colaborador'];
    $status = $linha['status'];
    $inicial = $linha['exercicio_inicial'];
    $final = $linha['exercicio_final'];
    $vencimento = $linha['vencimento'];
    $registrado = $linha['registrado'];

    $tr .= "<tr>";
    $tr .= "<td class='text-center'>$supervisor</td>";
    $tr .= "<td class='text-center'>$colaborador</td>";
    $tr .= "<td class='text-center'>$status</td>";
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
 * consulta a data de admissão de um colaborador
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 */
function consultaDataDeAdmissao($db, $id)
{
  $query = 
    "SELECT      
      l.admissao
    FROM av_usuarios_login AS l
    INNER JOIN lh_users AS u
      ON u.username = l.usuario
    WHERE u.id = $id";

  $resultado = mysqli_query($db, $query);

  $admissao = mysqli_fetch_row($resultado);

  return $admissao[0];
}