<?php

/**
 * atualiza o nome de um contato na tabela contatos
 * @param - objeto com uma conexão aberta
 * @param - string com o id do contato
 * @param - string com o nome do contato
 */
function atualizaNomeDeUmContato($db, $id, $nome)
{
  $query = "UPDATE av_agenda_contatos SET nome = '$nome' WHERE id = $id";

  mysqli_query($db, $query);
}