<?php

/**
 * insere um registro de pesquisa externa
 * @param - objeto com uma conexão aberta
 * @param - string com o id do atendimento externo
 */
function inserePesquisaExterna($db, $id)
{
  $query = "INSERT INTO av_agenda_pesquisas_externas (id, id_atendimento_externo, status) VALUES (0, $id, '1')";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}

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
      {$externo['id_contato']},
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
     '{$externo['tarefa']}',
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