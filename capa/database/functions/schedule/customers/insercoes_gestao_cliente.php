<?php

/**
 * insere um atendimento de gestão de clientes
 * @param - objeto com uma conexão aberta
 * @param - array com o dados de um atendimento de gestão de clientes
 */
function insereAtendimentoGestao($db, $gestao)
{  
  $query = 
    "INSERT INTO 
      av_agenda_atendimentos_gestao_clientes
    VALUES (
      {$gestao['id']},
      {$gestao['id_cnpj']},      
      {$gestao['id_contato']},
      {$gestao['registro']},
     '{$gestao['tipo']}',
      {$gestao['supervisor']},
      {$gestao['colaborador']},
     '{$gestao['status']}',
     '{$gestao['data_inicial']}',
     '{$gestao['data_final']}',
     '{$gestao['horario']}',
     '{$gestao['produto']}',
     '{$gestao['modulo']}',
     '{$gestao['observacao']}',
      {$gestao['faturado']},
      {$gestao['valor_hora']},
      {$gestao['valor_pacote']},
      {$gestao['despesa']},
     '{$gestao['registrado']}'
    )";

  $resultado = mysqli_query($db, $query);
  
  return $resultado;
}