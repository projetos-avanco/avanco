<?php

/**
 * atualiza um atendimento remoto
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do atendimento remoto
 */
function alteraAtendimentoRemoto($db, $dados)
{
  $query =
    "UPDATE
      av_agenda_atendimentos_remotos
        SET
          tipo         = '{$dados['tipo']}',
          supervisor   =  {$dados['supervisor']},
          colaborador  =  {$dados['colaborador']},
          data         = '{$dados['data']}',          
          horario      = '{$dados['horario']}',
          produto      = '{$dados['produto']}',
          modulo       = '{$dados['modulo']}',
          observacao   = '{$dados['observacao']}',
          faturado     =  {$dados['faturado']},
          valor_hora   =  {$dados['valor_hora']},
          valor_pacote =  {$dados['valor_pacote']},          
          registrado   = '{$dados['registrado']}'
    WHERE id = {$dados['id']}";
  
  $resultado = mysqli_query($db, $query);

  return $resultado;
}

/**
 * confirma o status de um atendimento remoto
 * @param - objeto com uma conexão aberta
 * @param - string com o id do atendimento remoto
 */
function confirmaUmAtendimentoRemoto($db, $id)
{
  $query = "UPDATE av_agenda_atendimentos_remotos SET status = '1' WHERE id = $id";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}

/**
 * cancela o status de um atendimento remoto
 * @param - objeto com uma conexão aberta
 * @param - string com o id do atendimento remoto
 */
function cancelaUmAtendimentoRemoto($db, $id)
{
  $query = "UPDATE av_agenda_atendimentos_remotos SET status = '4' WHERE id = $id";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}