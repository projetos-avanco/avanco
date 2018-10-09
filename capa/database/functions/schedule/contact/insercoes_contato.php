<?php

/**
 * insere o nome de um contato na tabela contatos
 * @param - objeto com uma conexão aberta
 * @param - string com o id da empresa
 * @param - string com o nome do contato
 */
function insereNomeDoContato($db, $id, $nome)
{
  $query = "INSERT INTO av_agenda_contatos VALUES (0, $id, '$nome')";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}

/**
 * insere telefone(s) fixo(s)
 * @param - objeto com uma conexão aberta
 * @param - string com o id do contato
 * @param - array com o(s) telefone(s) fixo(s)
 */
function insereTelefonesFixos($db, $id, $fixos)
{
  for ($i = 0; $i < count($fixos); $i++) {
    $query = "INSERT INTO av_agenda_telefones_fixos VALUES (0, $id, '{$fixos[$i]}')";

    mysqli_query($db, $query);
  }
}

/**
 * insere telefone(s) movél(eis)
 * @param - objeto com uma conexão aberta
 * @param - string com o id do contato
 * @param - array com o(s) telefone(s) movél(eis)
 */
function insereTelefonesMoveis($db, $id, $moveis)
{
  for ($i = 0; $i < count($moveis); $i++) {
    $query = "INSERT INTO av_agenda_telefones_moveis VALUES (0, $id, '{$moveis[$i]}')";

    mysqli_query($db, $query);
  }
}

/**
 * insere email(s)
 * @param - objeto com uma conexão aberta
 * @param - string com o id do contato
 * @param - array com o(s) email(s)
 */
function insereEmails($db, $id, $emails)
{
  for ($i = 0; $i < count($emails); $i++) {
    $query = "INSERT INTO av_agenda_emails VALUES (0, $id, '{$emails[$i]}')";

    mysqli_query($db, $query);
  }
}