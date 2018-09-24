<?php

/**
 * insere um registro na tabela de endereços
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do endereço
 * @param - inteiro com o id do bairro
 */
function insereNovoEndereco($db, $endereco, $distrito)
{
  $insert = "INSERT INTO av_agenda_enderecos VALUES (null, {$endereco['id']}, $distrito, '{$endereco['tipo']}', '{$endereco['logradouro']}', '{$endereco['complemento']}', '{$endereco['numero']}', '{$endereco['cep']}', '{$endereco['referencia']}')";

  mysqli_query($db, $insert);
}

/**
 * insere um registro na tabela de bairros
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id da cidade
 * @param - string com o nome do bairro
 */
function insereNovoDistrito($db, $localidade, $distrito)
{
  $insert = "INSERT INTO av_agenda_bairros VALUES (null, $localidade, '$distrito')";

  mysqli_query($db, $insert);
}

/**
 * insere um registro na tabela de cidades
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do estado
 * @param - string com o nome da cidade
 */
function insereNovaLocalidade($db, $uf, $localidade)
{
  $insert = "INSERT INTO av_agenda_cidades VALUES (null, $uf, '$localidade')";

  mysqli_query($db, $insert);
}
