<?php

/**
 * deleta o(s) email(s) de um contato
 * @param - objeto com uma conexão aberta
 * @param - string com o id do contato
 */
function deletaEmails($db, $id)
{
  $query = "DELETE FROM av_agenda_emails WHERE (id_contato = $id)";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}

/**
 * deleta o(s) telefone(s) móvel(eis) de um contato
 * @param - objeto com uma conexão aberta
 * @param - string com o id do contato
 */
function deletaMoveis($db, $id)
{
  $query = "DELETE FROM av_agenda_telefones_moveis WHERE (id_contato = $id)";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}

/**
 * deleta o(s) telefone(s) fixo(s) de um contato
 * @param - objeto com uma conexão aberta
 * @param - string com o id do contato
 */
function deletaFixos($db, $id)
{
  $query = "DELETE FROM av_agenda_telefones_fixos WHERE (id_contato = $id)";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}

/**
 * deleta o id do contato
 * @param - objeto com uma conexão aberta
 * @param - string com o id do contato
 */
function deletaIdDoContato($db, $id)
{
  $query = "DELETE FROM av_agenda_contatos WHERE (id = $id)";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}

/**
 * solicita a deleção dos dados (telefones fixo(s), móvel(eis), email(s) e id) do contato
 * @param - objeto com uma conexão aberta
 * @param - string com o id do contato
 */
function deletaContato($db, $id)
{
  $resultados = array();
  
  $resultados['email']   = deletaEmails($db, $id);
  $resultados['movel']   = deletaMoveis($db, $id);
  $resultados['fixo']    = deletaFixos($db, $id);
  $resultados['contato'] = deletaIdDoContato($db, $id);

  return $resultados;
}