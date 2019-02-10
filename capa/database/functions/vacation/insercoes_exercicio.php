<?php

/**
 * insere um registro de exercício de férias
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do exercício
 */
function insereExercicioDeFerias($db, $exercicio)
{
  $query = 
    "INSERT INTO 
      av_agenda_exercicios_ferias
      VALUES (
         {$exercicio['id']},
         {$exercicio['supervisor']},
         {$exercicio['colaborador']},
         {$exercicio['status']},
        '{$exercicio['exercicio_inicial']}',
        '{$exercicio['exercicio_final']}',
        '{$exercicio['vencimento']}',
        '{$exercicio['registrado']}'
      )";
        
  $resultado = mysqli_query($db, $query);

  return $resultado;
}