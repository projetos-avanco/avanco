<?php

  require 'init.php';
  require 'app/helpers/diversas.php';

  $dbc = abre_conexao();

  if ($dbc) {
    $query = "SELECT id, cnpj FROM av_agenda_cnpjs ORDER BY id";

    $resultado = mysqli_query($dbc, $query);

    $cnpjs = array();

    while ($linha = mysqli_fetch_array($resultado)) {
      $cnpjs[] = array(
        'id'   => $linha['id'],
        'cnpj' => $linha['cnpj']
      );
    }

    $id = 1;

    for ($i = 0; $i < count($cnpjs); $i++) {      
      $query =
        "SELECT
        	*
        FROM
        	(SELECT
        		SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', lh_chat.additional_data)+ 29)),'\"',1) AS cnpj,
        		SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"nomeContato\"', lh_chat.additional_data)+ 29)),'\"',1) AS cliente,
                SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"Telefone\"', lh_chat.additional_data)+ 26)),'\"',1) AS contato
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
        WHERE (c.cnpj = '{$cnpjs[$i]['cnpj']}')
        	AND (c.contato <> '' AND c.contato <> 'nomeContato')
        	AND (c.cliente <> '' AND c.cliente <> '.' AND c.cliente <> ':' AND c.cliente <> '>62' AND c.cliente <> '(32) 3724-1228' AND c.cliente <> '(37) 9802-7812' AND c.cliente <> ',MERCADO VALOR DE SEROPEDICA')
        GROUP BY
        	c.contato
        ORDER BY
        	c.cliente";

      $resultado = mysqli_query($dbc, $query);

      while ($linha = mysqli_fetch_array($resultado)) {
        $cliente = decodificaCaracteresJSON($linha['cliente']);

        $insert = "INSERT INTO av_agenda_contatos VALUES (null, {$cnpjs[$i]['id']}, '$cliente')";

        mysqli_query($dbc, $insert);

        if (strlen($linha['contato']) <= 14) {
          $insert = "INSERT INTO av_agenda_telefones_fixos VALUES (null, $id, '{$linha['contato']}')";

          mysqli_query($dbc, $insert);
        } else {
          $insert = "INSERT INTO av_agenda_telefones_moveis VALUES (null, $id, '{$linha['contato']}')";

          mysqli_query($dbc, $insert);
        }

        $id++;
      }
    }
  }
