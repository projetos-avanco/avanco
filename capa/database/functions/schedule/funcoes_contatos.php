<?php

/**
 *
 *
 */
function consultaEmails($db, $id, $tr)
{
  $query = "SELECT endereco FROM av_agenda_emails WHERE (id_contato = $id)";

  $resultado = mysqli_query($db, $query);

  $tr .= "<td class='text-left' data-fixo=''>";

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

  $tr .= "<td class='text-center'>";

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

  $tr .= "<td class='text-center'>";

  while ($linha = mysqli_fetch_array($resultado)) {
    $tr .= "{$linha['fixo']}<br>";
  }

  $tr .= "</td>";

  return $tr;
}

/**
 *
 *
 */
function consultaContatos($db, $idCnpj)
{
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

  $table =
    "<table class='table table-condensed'>
      <thead>
        <tr>
          <th class='text-center' width='10%'>ID</th>
          <th class='text-center' width='10%'>Nome</th>
          <th class='text-center' width='10%'>Tel. Fixo</th>
          <th class='text-center' width='10%'>Tel. Móvel</th>
          <th class='text-center' width='25%'>Email</th>
          <th class='text-center' width='8%'></th>
          <th class='text-center' width='8%'></th>
          <th class='text-center' width='8%'></th>
        </tr>
      </thead>
      <tbody>";

  $tr = '';

  while ($linha = mysqli_fetch_array($resultado)) {
    $id   = $linha['id'];
    $nome = ucwords($linha['nome']);

    $tr .=
      "<tr>
        <td class='text-center' data-id='$id'>$id</td>
        <td class='text-left' data-nome='$nome'>$nome</td>";

    $tr = consultaTelefonesFixos($db, $id, $tr);
    $tr = consultaTelefonesMoveis($db, $id, $tr);
    $tr = consultaEmails($db, $id, $tr);

    $tr .=
      "<td>
        <button class='btn btn-block btn-xs btn-danger' type='button'>
          <i class='fa fa-trash' aria-hidden='true'></i>
          Excluir
        </button>
      </td>
      <td>
        <button class='btn btn-block btn-xs btn-warning' type='button'>
          <i class='fa fa-pencil' aria-hidden='true'></i>
          Editar
        </button>
      </td>
      <td>
        <button class='btn btn-block btn-xs btn-default' id='slc' type='button'>
          <i class='fa fa-check' aria-hidden='true'></i>
          Selecionar
        </button>
      </td>";

    $tr .= "</tr>";
  }

  $table .= $tr;
  $table .=
    "</tbody>
      </table>";

  echo $table;
}
