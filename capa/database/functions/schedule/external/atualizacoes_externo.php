<?php

/**
 * atualiza um atendimento externo
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do atendimento externo
 */
function alteraAtendimentoExterno($db, $dados)
{
  $query =
    "UPDATE
      av_agenda_atendimentos_externos
        SET
          tipo         = '{$dados['tipo']}',
          supervisor   =  {$dados['supervisor']},
          colaborador  =  {$dados['colaborador']},
          data_inicial = '{$dados['data_inicial']}',
          data_final   = '{$dados['data_final']}',
          horario      = '{$dados['horario']}',
          produto      = '{$dados['produto']}',
          modulo       = '{$dados['modulo']}',
          tarefa       = '{$dados['tarefa']}',
          observacao   = '{$dados['observacao']}',
          faturado     =  {$dados['faturado']},
          valor_hora   =  {$dados['valor_hora']},
          valor_pacote =  {$dados['valor_pacote']},
          despesa      =  {$dados['despesa']},
          registrado   = '{$dados['registrado']}'
    WHERE id = {$dados['id']}";
  
  $resultado = mysqli_query($db, $query);

  return $resultado;
}

/**
 * confirma o status de um atendimento externo
 * @param - objeto com uma conexão aberta
 * @param - string com o id do atendimento externo
 */
function confirmaUmAtendimentoExterno($db, $id)
{
  $query = "UPDATE av_agenda_atendimentos_externos SET status = '1' WHERE id = $id";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}

/**
 * cancela o status de um atendimento externo
 * @param - objeto com uma conexão aberta
 * @param - string com o id do atendimento externo
 */
function cancelaUmAtendimentoExterno($db, $id)
{
  $query = "UPDATE av_agenda_atendimentos_externos SET status = '4' WHERE id = $id";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}