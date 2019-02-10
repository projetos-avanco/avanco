<?php

/**
 * consulta os dados de uma pesquisa
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id da pesquisa
 */
function consultaDadosDeUmaPesquisaExterna($db, $id)
{
  require DIRETORIO_HELPERS . 'datas.php';

  $query = 
    "SELECT 
    e.id,
    CONCAT(u.name, ' ', u.surname) AS supervisor,
    CASE
      WHEN (e.status = 1)
        THEN 'Pendente'
      WHEN (e.status = 2)
        THEN 'Realizada'
    END AS status,
    e.qualidade,
    CASE
      WHEN (e.entrega = 1)
        THEN 'Sim'
      WHEN (e.entrega = 2)
        THEN 'Não'
      WHEN (e.entrega = 3)
        THEN 'Em Partes'
      END AS entrega,
    e.consideracoes,
    DATE_FORMAT(e.registrado, '%Y-%m-%d') AS registrado
  FROM av_agenda_pesquisas_externas AS e
  INNER JOIN lh_users AS u
    ON u.id = e.supervisor
  WHERE e.id = $id";
  
  $resultado = mysqli_query($db, $query);

  $dados = array();

  while ($linha = mysqli_fetch_array($resultado)) {
    $linha['consideracoes'] = ucwords($linha['consideracoes']);

    $linha['registrado'] = formataDataParaExibir($linha['registrado']);

    $dados['id']            = $linha['id'];
    $dados['supervisor']    = $linha['supervisor'];
    $dados['status']        = $linha['status'];
    $dados['qualidade']     = $linha['qualidade'];
    $dados['entrega']       = $linha['entrega'];
    $dados['consideracoes'] = $linha['consideracoes'];
    $dados['registrado']    = $linha['registrado'];
  }

  return $dados;
}