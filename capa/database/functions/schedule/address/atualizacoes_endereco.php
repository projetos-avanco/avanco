<?php

/**
 * atualiza um registro na tabela de endereços
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do endereço
 * @param - inteiro com o id do bairro
 */
function atualizaEnderecoExistente($db, $endereco, $distrito)
{
  $query = 
    "UPDATE
      av_agenda_enderecos 
    SET 
      id_bairro   = $distrito, 
      tipo        = '{$endereco['tipo']}', 
      logradouro  = '{$endereco['logradouro']}', 
      complemento = '{$endereco['complemento']}',
      numero      = '{$endereco['numero']}',
      cep         = '{$endereco['cep']}',
      referencia  = '{$endereco['referencia']}'
    WHERE (id = {$endereco['id_endereco']} AND id_cnpj = {$endereco['id_cnpj']})";

  mysqli_query($db, $query);
}