<?php

/**
 * consulta e retorna um array com id, nome e sobrenome dos colaboradores existentes no chat
 * @param - string vazia que receberá os dados
 * @param - objeto com uma conexão aberta
 */
function consultaColaboradores($options, $db)
{
  $query =
    "SELECT
    	id,
    	name AS nome,
    	surname AS sobrenome
    FROM lh_users
    WHERE (disabled = 0)
    	AND NOT (id = 1 OR id = 2 OR id = 3 OR id = 4 OR id = 5 OR id = 6 OR id = 42 OR id = 43 OR id = 44)
    ORDER BY nome";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $options .= '<option value="0" selected>Selecione um Colaborador</option>';

    while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

      $options .= "<option value='{$registro['id']}'>{$registro['nome']} {$registro['sobrenome']}</option>";

    }

  } else {

    #erro durante a execução da consulta
    echo 'erro';

  }

  return $options;
}

/**
 * consulta e retorna um array com razão social, cnpj e conta contrato dos clientes
 * @param - string com cnpj ou razão social do cliente desejado
 * @param - string com o tipo de dado que será pesquisado ($tipo = true -> cnpj ou $tipo = false -> razão social)
 * @param - string vazia que receberá as linhas para a tabela dinâmica de clientes
 * @param - objeto com uma conexão aberta
 */
function consultaDadosCadastraisDosClientes($pesquisa, $tipo, $linhas, $db)
{
  require '../../../app/helpers/diversas.php';

  if ($tipo) {

    $query =
      "SELECT DISTINCT
      	SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',lh_chat.additional_data)+ 29)),'\"',1) AS cnpj,
      	SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"contaContratoContato\"',lh_chat.additional_data)+ 38)),'\"',1) AS conta_contrato,
      	UPPER(SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"empresaContato\"',lh_chat.additional_data)+ 32)),'\"',1)) AS razao_social
      FROM lh_chat
      WHERE (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '2017-07-01' AND CURRENT_DATE())
      	AND (SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',lh_chat.additional_data)+ 29)),'\"',1) LIKE '$pesquisa%')
      ORDER BY razao_social";

  } else {

    $pesquisa = strtoupper(removeAcentos($pesquisa));

    $query =
      "SELECT DISTINCT
      	SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',lh_chat.additional_data)+ 29)),'\"',1) AS cnpj,
      	SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"contaContratoContato\"',lh_chat.additional_data)+ 38)),'\"',1) AS conta_contrato,
      	UPPER(SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"empresaContato\"',lh_chat.additional_data)+ 32)),'\"',1)) AS razao_social
      FROM lh_chat
      WHERE (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '2017-07-01' AND CURRENT_DATE())
      	AND (SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"empresaContato\"',lh_chat.additional_data)+ 32)),'\"',1) LIKE '%$pesquisa%')
      ORDER BY razao_social";

  }

  if ($resultado = $db->query($query)) {

    while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

      $linhas .=
        "<tr>
          <td class='text-center' data-cnpj='{$registro['cnpj']}'>{$registro['cnpj']}</td>
          <td class='text-center' data-conta='{$registro['conta_contrato']}'>{$registro['conta_contrato']}</td>
          <td class='text-left'   data-razao='{$registro['razao_social']}'>{$registro['razao_social']}</td>
          <td class='text-right'>
            <button class='btn btn-xs btn-success btn-block' type='button'>
              <span class='glyphicon glyphicon-ok'></span>
            </button>
          </td>
        </tr>";

    }

  } else {

    # erro durante a execução da consulta
    echo 'erro';

  }

  return $linhas;
}
