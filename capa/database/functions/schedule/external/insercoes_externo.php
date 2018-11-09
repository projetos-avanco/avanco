<?php

/**
 * insere um atendimento externo
 * @param - objeto com uma conexão aberta
 * @param - array com o dados de um atendimento externo
 */
function insereAtendimentoExterno($db, $externo)
{  
  $query = 
    "INSERT INTO 
      av_agenda_atendimentos_externos
    VALUES (
      {$externo['id']},
      {$externo['id_cnpj']},
      {$externo['id_issue']},
      {$externo['registro']},
     '{$externo['tipo']}',
      {$externo['supervisor']},
      {$externo['colaborador']},
     '{$externo['status']}',
     '{$externo['data_inicial']}',
     '{$externo['data_final']}',
     '{$externo['horario']}',
     '{$externo['produto']}',
     '{$externo['modulo']}',
     '{$externo['observacao']}',
      {$externo['faturado']},
      {$externo['valor_hora']},
      {$externo['valor_pacote']},
      {$externo['despesa']},
     '{$externo['registrado']}'
    )";

  $resultado = mysqli_query($db, $query);
  
  return $resultado;
}