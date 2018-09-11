<?php

/**
 *
 *
 */
function consultaEndereco($idCnpj)
{
  $select =
    "SELECT
    	e.tipo
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
    WHERE e.id_cnpj = ";
}
