<?php

/**
 * insere um atendimento remoto
 * @param - objeto com uma conexão aberta
 * @param - array com o dados de um atendimento remoto
 */
function insereAtendimentoRemoto($db, $remoto)
{  
  $query = 
    "INSERT INTO 
      av_agenda_atendimentos_remotos
    VALUES (
      {$remoto['id']},
      {$remoto['id_cnpj']},
      {$remoto['id_issue']},
      {$remoto['id_contato']},
      {$remoto['registro']},
     '{$remoto['tipo']}',
      {$remoto['supervisor']},
      {$remoto['colaborador']},
     '{$remoto['status']}',
     '{$remoto['data']}',
     '{$remoto['horario']}',
     '{$remoto['produto']}',
     '{$remoto['modulo']}',
     '{$remoto['tarefa']}',
     '{$remoto['observacao']}',
      {$remoto['faturado']},
      {$remoto['valor_hora']},
      {$remoto['valor_pacote']},
     '{$remoto['registrado']}'
    )";

  $resultado = mysqli_query($db, $query);
  
  return $resultado;
}