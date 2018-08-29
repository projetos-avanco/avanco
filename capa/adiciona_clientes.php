<?php

  require 'init.php';
  require 'app/helpers/diversas.php';

  $dbc = abre_conexao();

  if ($dbc) {
    # contratos
    $query =
      "SELECT DISTINCT
      	*
      FROM
      	(SELECT
      		SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"contaContratoContato\"',lh_chat.additional_data)+ 38)),'\"',1) AS contrato
      	FROM
      		lh_chat
      	WHERE
      		(FROM_UNIXTIME(lh_chat.time, '%Y-%m-%d') BETWEEN '2017-07-01' AND CURRENT_DATE())
      		AND NOT (
      			SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',lh_chat.additional_data)+ 29)),'\"',1) = ''                  OR
      			SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',lh_chat.additional_data)+ 29)),'\"',1) = 'taContratoContato' OR
      			SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',lh_chat.additional_data)+ 29)),'\"',1) = 'eContato'          OR
      			SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"contaContratoContato\"',lh_chat.additional_data)+ 38)),'\"',1) = ''         OR
      			SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"empresaContato\"',lh_chat.additional_data)+ 32)),'\"',1) = ''
      		)) AS c
      GROUP BY
      	c.contrato
      ORDER BY
      	c.contrato";

    $resultado = mysqli_query($dbc, $query);

    while ($linha = mysqli_fetch_array($resultado)) {
      $query = '';
      $query = "INSERT INTO av_agenda_contratos VALUES (null, '{$linha['contrato']}')";

      mysqli_query($dbc, $query);
    }

    $query = 'SELECT * FROM av_agenda_contratos';

    $resultado = mysqli_query($dbc, $query);

    $contratos = array();

    while ($linha = mysqli_fetch_array($resultado)) {
      $contratos[] = array(
        'id'       => $linha['id'],
        'contrato' => $linha['conta_contrato']
      );
    }

    # cnpjs
    $query =
      "SELECT
      	*
      FROM
      	(SELECT
      		SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"contaContratoContato\"',lh_chat.additional_data)+ 38)),'\"',1) AS contrato,
      		SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',lh_chat.additional_data)+ 29)),'\"',1) AS cnpj,
      		SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"empresaContato\"',lh_chat.additional_data)+ 32)),'\"',1) AS razao_social
      	FROM
      		lh_chat
      	WHERE
      		(FROM_UNIXTIME(lh_chat.time, '%Y-%m-%d') BETWEEN '2017-07-01' AND CURRENT_DATE())
      		AND NOT (
      			SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',lh_chat.additional_data)+ 29)),'\"',1) = ''                  OR
      			SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',lh_chat.additional_data)+ 29)),'\"',1) = 'taContratoContato' OR
      			SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',lh_chat.additional_data)+ 29)),'\"',1) = 'eContato'          OR
      			SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"contaContratoContato\"',lh_chat.additional_data)+ 38)),'\"',1) = ''         OR
      			SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"empresaContato\"',lh_chat.additional_data)+ 32)),'\"',1) = ''
      		)) AS c
      GROUP BY
      	c.cnpj
      ORDER BY
      	c.contrato,
      	c.razao_social,
      	c.cnpj";
  }

  $resultado = mysqli_query($dbc, $query);

  $clientes = array();

  while ($linha = mysqli_fetch_array($resultado)) {
    $clientes[] = array(
      'contrato'     => $linha['contrato'],
      'cnpj'         => $linha['cnpj'],
      'razao_social' => strtolower(decodificaCaracteresJSON($linha['razao_social']))
    );
  }

  for ($i = 0; $i < count($contratos); $i++) {
    for ($j = 0; $j < count($clientes); $j++) {
      if ($contratos[$i]['contrato'] == $clientes[$j]['contrato']) {
        $query = "INSERT INTO av_agenda_cnpjs VALUES (null, '{$contratos[$i]['id']}', '{$clientes[$j]['cnpj']}', '{$clientes[$j]['razao_social']}')";

        mysqli_query($dbc, $query);
      }
    }
  }
