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
    	e.tipo,
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

  return $endereco;
}
