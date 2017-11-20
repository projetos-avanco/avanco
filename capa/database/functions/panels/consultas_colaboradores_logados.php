<?php

/**
 * consulta a quantidade de clientes que estão sendo atendidos e que estão em espera
 * @param - array com os dados do painel de colaboradores logados
 * @param - objeto com uma conexão aberta
 */
function consultaAtendimentosDosColaboradoresLogados($painel, $db)
{
  # consultando clientes que estão em atendimento
  for ($i = 0; $i < count($painel); $i++) {

    $query =
      "SELECT
      	COUNT(c.id) AS em_atendimento
      FROM lh_chat AS c
      WHERE (c.dep_id = {$painel[$i]['departamento']})
      	AND (c.status = 1)
      	AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') = CURRENT_DATE())";

    if ($resultado = $db->query($query)) {

      $linha = mysqli_fetch_row($resultado);

      $painel[$i]['atendimento'] = $linha[0];

    }

  }

  # consultando clientes que estão em espera
  for ($i = 0; $i < count($painel); $i++) {

    $query =
      "SELECT
      	COUNT(c.id) AS em_espera
      FROM lh_chat AS c
      WHERE (c.dep_id = {$painel[$i]['departamento']})
      	AND (c.status = 0)
      	AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') = CURRENT_DATE())";

    if ($resultado = $db->query($query)) {

      $linha = mysqli_fetch_row($resultado);

      $painel[$i]['espera'] = $linha[0];

    }

  }

  return $painel;
}

/**
 * consulta id, departamento, nome e sobrenome dos colaboradores
 * @param - array com os dados do painel de colaboradores logados
 * @param - objeto com uma conexão aberta
 */
function consultaDadosDosColaboradores($painel, $db)
{
  $query =
    "SELECT DISTINCT
    	u.id AS colaborador,
    	d.id AS departamento,
    	u.name AS nome,
    	u.surname AS sobrenome,
    	CASE
    		WHEN (u.hide_online = 'false')
    			THEN 'Não'
    		WHEN (u.hide_online <> 'false')
    			THEN 'Sim'
    	END
    		AS oculto,
    	CASE
    		WHEN (s.last_activity = 0)
    			THEN 'Não'
    		WHEN (s.last_activity <> 0)
    			THEN 'Sim'
    	END
    		AS logado
    FROM lh_departament AS d
    INNER JOIN
    	(SELECT
    		u.id,
    		u.name,
    		u.surname,
    		u.email,
    		u.hide_online
    	FROM lh_users AS u
    	WHERE (disabled = 0)
    		AND NOT
          (u.id = 1 OR
          u.id = 2 OR
          u.id = 3 OR
          u.id = 4 OR
          u.id = 5 OR
          u.id = 6 OR
          u.id = 42 OR
          u.id = 44)) AS u
    ON u.email = d.email
    INNER JOIN lh_userdep AS s
    ON s.user_id = u.id
    WHERE (disabled = 0)
    	AND NOT
        (d.id = 1 OR
        d.id = 2 OR
        d.id = 3 OR
        d.id = 4 OR
        d.id = 5 OR
        d.id = 6 OR
        d.id = 7 OR
        d.id = 8 OR
        d.id = 9 OR
        d.id = 10 OR
        d.id = 11 OR
        d.id = 12 OR
        d.id = 15)
    ORDER BY nome";

    if ($resultado = $db->query($query)) {

      while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

        $painel[] = array(
          'colaborador'  => $registro['colaborador'],
          'departamento' => $registro['departamento'],
          'nome'         => $registro['nome'],
          'sobrenome'    => $registro['sobrenome'],
          'atendimento'  => 0,
          'espera'       => 0,
          'logado'       => $registro['logado'],
          'oculto'       => $registro['oculto']
        );

      }

      # chamando função que consulta a quantidade de clientes em atendimento e em espera
      $painel = consultaAtendimentosDosColaboradoresLogados($painel, $db);

    }

    return $painel;
}
