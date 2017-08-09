<?php

/**
 * retorna todos os documentos (nome e data de postagem) inseridos na base de conhecimento com a ajuda do colaborador
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo de documento
 * @param - string com o id do colaborador que requisitou a página
 */
function retornaDocumentosInseridosNaBaseDeConhecimento($objeto, $modelo, $id)
{
  $query =
    "SELECT
    	conteudo_postado_base_de_conhecimento AS nome,
      data_conteudo_postado AS data_postagem
    FROM av_base_de_conhecimento_avancao
    WHERE codigo_jogador = $id
    	ORDER BY data_conteudo_postado DESC";

  $resultado = mysqli_query($objeto, $query);

  while ($registros = mysqli_fetch_assoc($resultado)) {

    $modelo['nome'][]          = $registros['nome'];
    $modelo['data_postagem'][] = $registros['data_postagem'];

  }

  # chamando função que formata todas as datas de postagem para dd/mm/aaaa
  $modelo['data_postagem'] = formataArrayComDatasParaExibir($modelo['data_postagem']);

  return $modelo;
}
