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