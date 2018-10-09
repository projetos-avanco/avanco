<?php

/**
 * retorna o id de um contato
 * @param - objeto com uma conexão aberta
 * @param - string com o id da empresa
 * @param - string com o nome do contato
 */
function retornaIdDoContato($db, $id, $nome)
{
  $query = "SELECT id FROM av_agenda_contatos WHERE id_cnpj = $id AND nome = '$nome'";

  $resultado = mysqli_query($db, $query);

  $idContato = mysqli_fetch_row($resultado);

  return $idContato[0];
}

/**
 *
 *
 */
function consultaEmails($db, $id, $tr)
{
  $query = "SELECT endereco FROM av_agenda_emails WHERE (id_contato = $id)";

  $resultado = mysqli_query($db, $query);

  $tr .= "<td class='text-left' data-email=''>";

  while ($linha = mysqli_fetch_array($resultado)) {
    $tr .= "{$linha['endereco']}<br>";
  }

  $tr .= "</td>";

  return $tr;
}

/**
 *
 *
 */
function consultaTelefonesMoveis($db, $id, $tr)
{
  $query = "SELECT movel FROM av_agenda_telefones_moveis WHERE (id_contato = $id)";

  $resultado = mysqli_query($db, $query);

  $tr .= "<td class='text-center' data-movel=''>";

  while ($linha = mysqli_fetch_array($resultado)) {
    $tr .= "{$linha['movel']}<br>";
  }

  $tr .= "</td>";

  return $tr;
}

/**
 *
 *
 */
function consultaTelefonesFixos($db, $id, $tr)
{
  $query = "SELECT fixo FROM av_agenda_telefones_fixos WHERE (id_contato = $id)";

  $resultado = mysqli_query($db, $query);

  $tr .= "<td class='text-center' data-fixo=''>";

  while ($linha = mysqli_fetch_array($resultado)) {
    $tr .= "{$linha['fixo']} <br>";
  }

  $tr .= "</td>";

  return $tr;
}

/**
 * consulta todos os contatos (fixo(s), móvel(eis) e email(s)) de um cnpj de uma empresa
 * @param - objeto com uma conexão aberta
 * @param - string com o id de um cnpj de uma empresa
 */
function consultaContatos($db, $idCnpj)
{
  $table = '
    <table class="table table-condensed" id="lista-contatos">
      <thead>
        <tr>
          <th class="text-center" width="20%">Nome</th>
          <th class="text-center" width="15%">Fixo</th>
          <th class="text-center" width="15%">Móvel</th>
          <th class="text-center" width="25%">Email</th>
          <th class="text-center" width="8%"></th>
          <th class="text-center" width="8%"></th>
          <th class="text-center" width="8%"></th>
        </tr>
      </thead>
      <tbody>
  ';

  $query =
    "SELECT
    	t.id,
    	t.nome
    FROM av_agenda_cnpjs AS c
    INNER JOIN av_agenda_contatos AS t
    	ON t.id_cnpj = c.id
    WHERE (c.id = $idCnpj)
    ORDER BY t.nome";

  $resultado = mysqli_query($db, $query);

  $tr = '';
  
  while ($linha = mysqli_fetch_array($resultado)) {
    $id   = $linha['id'];
    $nome = mb_strtoupper($linha['nome'], 'utf-8');

    $tr .=
      "<tr>
        <td class='text-left' data-nome='$nome'>$nome</td>";

    $tr = consultaTelefonesFixos($db, $id, $tr);
    $tr = consultaTelefonesMoveis($db, $id, $tr);
    $tr = consultaEmails($db, $id, $tr);

    $tr .=
      "<td>
        <button class='btn btn-block btn-xs btn-danger' type='button'>
          <i class='fa fa-trash' aria-hidden='true'></i>
        </button>
      </td>
      <td>
        <button class='btn btn-block btn-xs btn-warning' type='button'>
          <i class='fa fa-pencil' aria-hidden='true'></i>
        </button>
      </td>
      <td data-id='$id'>
        <button class='btn btn-block btn-xs btn-default' id='slc' type='button'>
          <i class='fa fa-check' aria-hidden='true'></i>
        </button>
      </td>";

    $tr .= "</tr>";
  }

  $table .= $tr;
  $table .= '
      <tbody>
    </table>
  ';

  return $table;
}
