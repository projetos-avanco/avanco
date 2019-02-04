<?php

  require 'init.php';
  require 'app/helpers/diversas.php';

  $dbc = abre_conexao();

  /**
   *
   * NÃO É NECESSÁRIO RODAS ESSE SCRIPT, APENAS INSERIR MANUALMENTE OS CONTATOS QUE ESTÃO NO ARQUIVO contatos.sql NO DROPBOX
   */

  if ($dbc) {
    $query =
      "SELECT
      	n.id,
      	j.cliente
      FROM av_agenda_cnpjs AS n
      LEFT JOIN
      	(SELECT DISTINCT
      		SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1) AS cnpj,
      		SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) AS cliente
      	FROM lh_chat AS c
      	WHERE FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '2018-01-01' AND CURRENT_DATE()
      		AND NOT SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1) = ''
      		AND NOT SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) = ''
      		AND (SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) <> '' 			AND
      			SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) <> '.' 			AND
      			SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) <> ':' 			AND
      			SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) <> '>62' 			AND
      			SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) <> '(32) 3724-1228' 	AND
      			SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) <> '(37) 9802-7812' 	AND
      			SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) <> ',MERCADO VALOR DE SEROPEDICA' AND
      			SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) <> '1' AND
      			SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) <> '2' AND
      			SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) <> 'A' AND
      			SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) <> 'Aa' AND
      			SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) <> 'Aaa' AND
      			SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"nomeContato\"', c.additional_data)+ 29)),'\"',1) <> ',Edicelia')
      	ORDER BY SUBSTRING_INDEX(SUBSTR(c.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"', c.additional_data)+ 29)),'\"',1)) AS j
      ON j.cnpj = n.cnpj
      ORDER BY n.id, j.cliente";

      $resultado = mysqli_query($dbc, $query);

      $contador = 0;

      while ($linha = mysqli_fetch_array($resultado)) {
        $linha['cliente'] = strtolower(decodificaCaracteresJSON($linha['cliente']));

        $insert = "INSERT INTO av_agenda_contatos VALUES (null, {$linha['id']}, '{$linha['cliente']}')";

        echo $insert . ';' . '<br>';

        $contador++;
      }
      echo 'Total ' . $contador;
  }
