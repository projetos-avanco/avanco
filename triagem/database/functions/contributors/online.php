<?php

/**
 * verificando se existem colaboradores logados no chat
 * @param - array modelo de colaboradores
 * @param - objeto com uma conexão aberta
 */
function verificaColaboradoresOnlineNoChat($array, $db)
{
  $query =
    "SELECT DISTINCT
    	u.user_id AS id,
    	s.name AS nome,
    	s.surname AS sobrenome,
    	d.id AS departamento
    FROM lh_departament AS d
    INNER JOIN lh_userdep AS u
    	ON u.dep_id = d.id
    INNER JOIN lh_users AS s
    	ON s.id = u.user_id
    WHERE (s.id <> 42)
    	AND (s.id <> 43)
    	AND (d.disabled = 0)
    	AND (s.disabled = 0)
    	AND (u.last_activity > 0)
    	AND (FROM_UNIXTIME(u.last_activity, '%Y-%m-%d') = CURRENT_DATE())
    	AND (TIMEDIFF(CURRENT_TIME(), FROM_UNIXTIME(u.last_activity, '%H:%i:%s')) <= '00:05:00')
    ORDER BY id";

  # verificando se a query pode ser executada
  if ($resultado = $db->query($query)) {

    # recuperando a quantidade de colaboradores online
    $online = $resultado->num_rows;

    # verificando se a quantidade de colaboradores online é maior que zero
    if ($online > 0) {

      $posicao = 0;

      # recuperando os dados dos colaboradores online
      while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

        $array[$posicao]['id']           = $registro['id'];
        $array[$posicao]['nome']         = $registro['nome'];
        $array[$posicao]['sobrenome']    = $registro['sobrenome'];
        $array[$posicao]['conhecimento'] = '0';
        $array[$posicao]['fila']         = '0';
        $array[$posicao]['departamento'] = $registro['departamento'];

        $posicao++;

      }

    } else {

      # parando a execução do código por 2 minutos
      sleep(10);

      # não existem colaboradores online, retornando array nulo
      return $array = NULL;

    }

  } else {

    # chamando função que grava um log
    gravaLog('erro na consulta de colaboradores logados, no script online.php', 'error');

  }

  return $array;
}
