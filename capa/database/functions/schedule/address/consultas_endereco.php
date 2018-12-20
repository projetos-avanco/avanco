<?php

/**
 * verifica se o bairro já está cadastrado e retorna o seu id
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id da cidade
 * @param - string com o nome do bairro
 */
function verificaDistritoCadastrado($db, $localidade, $distrito)
{
  $select = "SELECT id FROM av_agenda_bairros WHERE id_cidade = $localidade AND distrito = '$distrito'";

  $resultado = mysqli_query($db, $select);

  $id = mysqli_fetch_row($resultado);

  return $id[0];
}

/**
 * verifica se a cidade já está cadastrada e retorna o seu id
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do estado
 * @param - string com o nome da cidade
 */
function verificaLocalidadeCadastrada($db, $uf, $localidade)
{
  $select = "SELECT id FROM av_agenda_cidades WHERE id_estado = $uf AND localidade = '$localidade'";

  $resultado = mysqli_query($db, $select);

  $id = mysqli_fetch_row($resultado);

  return $id[0];
}

/**
 * retorna o endereço completo de um cnpj
 * @param - objeto com uma conexão aberta
 * @param - id do cnpj
 */
function retornaEnderecoAjax($db, $id)
{
  $select =
    "SELECT
      e.id,
    	CASE
        WHEN (e.tipo = '1')
          THEN 'Apartamento'
        WHEN (e.tipo = '2')
          THEN 'Casa'
        WHEN (e.tipo = '3')
          THEN 'Comercial'
        WHEN (e.tipo = '4')
          THEN 'Outros'
      END AS tipo,
    	e.logradouro,
    	e.complemento,
    	e.numero,
    	e.cep,
    	e.referencia,
    	b.distrito,
    	d.localidade,
    	t.uf
    FROM av_agenda_enderecos AS e
    INNER JOIN av_agenda_cnpjs AS c
    	ON c.id = e.id_cnpj
    INNER JOIN av_agenda_bairros AS b
    	ON b.id = e.id_bairro
    INNER JOIN av_agenda_cidades AS d
    	ON d.id = b.id_cidade
    INNER JOIN av_agenda_estados AS t
    	ON t.id = d.id_estado
    WHERE e.id_cnpj = $id";

  $resultado = mysqli_query($db, $select);

  $endereco = array();

  while ($linha = mysqli_fetch_array($resultado)) {
    $endereco = array(
      'id'          => $linha['id'],
      'logradouro'  => $linha['logradouro'],
      'distrito'    => $linha['distrito'],
      'localidade'  => $linha['localidade'],
      'uf'          => $linha['uf'],
      'tipo'        => $linha['tipo'],
      'cep'         => $linha['cep'],
      'numero'      => $linha['numero'],
      'complemento' => $linha['complemento'],
      'referencia'  => $linha['referencia']
    );
  }
  
  if (count($endereco) > 0) {
    $endereco['logradouro']  = mb_convert_case($endereco['logradouro'],  MB_CASE_TITLE, 'utf-8');
    $endereco['distrito']    = mb_convert_case($endereco['distrito'],    MB_CASE_TITLE, 'utf-8');
    $endereco['localidade']  = mb_convert_case($endereco['localidade'],  MB_CASE_TITLE, 'utf-8');
    $endereco['complemento'] = mb_convert_case($endereco['complemento'], MB_CASE_TITLE, 'utf-8');
    $endereco['referencia']  = mb_convert_case($endereco['referencia'],  MB_CASE_TITLE, 'utf-8');
  } else {
    $endereco = null;
  }

  return $endereco;
}
