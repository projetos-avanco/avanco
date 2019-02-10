<?php

/**
 * atualiza um registro de pesquisa externa
 * @param - objeto com uma conexão aberta
 * @param - array com os dados de uma pesquisa externa
 */
function atualizaPesquisaExterna($db, $pesquisa)
{
  $query = 
    "UPDATE av_agenda_pesquisas_externas 
      SET 
        supervisor    =  {$pesquisa['supervisor']}, 
        status        = '{$pesquisa['status']}',
        qualidade     = '{$pesquisa['qualidade']}',
        entrega       =  {$pesquisa['entrega']},
        consideracoes = '{$pesquisa['consideracoes']}',
        registrado    = '{$pesquisa['registrado']}'
    WHERE id = {$pesquisa['id']}";
  
  $resultado = mysqli_query($db, $query);

  return $resultado;
}