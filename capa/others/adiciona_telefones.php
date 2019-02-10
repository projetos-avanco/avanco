<?php

  require 'init.php';
  require 'app/helpers/diversas.php';

  $dbc = abre_conexao();

  if ($dbc) {
    $query =
      "SELECT
    	c.cnpj,
    	t.id,
    	t.nome
    FROM av_agenda_contatos AS t
    INNER JOIN av_agenda_cnpjs AS c
    	ON c.id = t.id_cnpj
    ORDER BY t.nome, c.cnpj";

    $resultado = mysqli_query($dbc, $query);

    $clientes = array();

    while ($linha = mysqli_fetch_array($resultado)) {
      $clientes[] = array(
        'id'   => $linha['id'],
        'cnpj' => $linha['cnpj'],
        'nome' => str_replace("\\", "\\\\", json_encode($linha['nome']))
      );
    }

    for ($i = 0; $i < count($clientes); $i++) {
      $query =
        "SELECT
        	SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1) AS cnpj,
        	SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) AS cliente,
        	SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"Telefone\"', c.additional_data)+ 26)),'\"',1) AS contato
        FROM lh_chat AS c
        WHERE (SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1) = '{$clientes[$i]['cnpj']}')
        	AND FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '2018-01-01' AND CURRENT_DATE()
        	AND SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) = {$clientes[$i]['nome']}
        	AND NOT SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1) = ''
        	AND NOT SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) = ''
          AND NOT SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"Telefone\"', c.additional_data)+ 26)),'\"',1) 	 = ''
        GROUP BY SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"Telefone\"', c.additional_data)+ 26)),'\"',1)";

      $resultado = mysqli_query($dbc, $query);

      while ($linha = mysqli_fetch_array($resultado)) {
        if (strlen($linha['contato']) == 14) {
          $insert = "INSERT INTO av_agenda_telefones_fixos VALUES (NULL, {$clientes[$i]['id']}, '{$linha['contato']}')";

          mysqli_query($dbc, $insert);
        } elseif (strlen($linha['contato']) == 15) {
          $insert = "INSERT INTO av_agenda_telefones_moveis VALUES (NULL, {$clientes[$i]['id']}, '{$linha['contato']}')";

          mysqli_query($dbc, $insert);
        }
      }
    }
  }
