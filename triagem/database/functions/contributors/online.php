<?php

/**
 * verificando se o colaborador responsável pelo agendamento está logado no chat
 * @param - array modelo de colaboradores
 * @param - objeto com uma conexão aberta
 */
function verificaColaboradorAgendadoOnlineNoChat($array, $db)
{
  $query =
    "SELECT DISTINCT
      u.user_id AS id,
      s.name AS nome,
      s.surname AS sobrenome,
      d.id AS id_departamento,
      d.name AS departamento
    FROM lh_departament AS d
    INNER JOIN lh_userdep AS u
      ON u.dep_id = d.id
    INNER JOIN lh_users AS s
      ON s.id = u.user_id
    WHERE NOT (d.id = 1 OR d.id = 2 OR d.id = 3 OR d.id = 4 OR d.id = 6 OR d.id = 7 OR d.id = 8 OR d.id = 9 OR d.id = 10 OR d.id = 11)
      AND (s.id = {$array[0]['id']})
      AND (s.hide_online = 'false')
      AND (d.disabled = 0)
      AND (s.disabled = 0)
      AND (u.last_activity > 0)
      AND (FROM_UNIXTIME(u.last_activity, '%Y-%m-%d') = CURRENT_DATE())
      AND (TIMEDIFF(CURRENT_TIME(), FROM_UNIXTIME(u.last_activity, '%H:%i:%s')) <= '00:05:00')
    ORDER BY id";

  if ($resultado = $db->query($query)) {

    if ($resultado->num_rows > 0) {

      $registro = $resultado->fetch_array(MYSQLI_ASSOC);

      $array[0]['id_departamento'] = $registro['id_departamento'];
      $array[0]['departamento']    = $registro['departamento'];

      return $array;

    } else {

      # retornando null para o portal avanço
      echo json_encode(NULL);

      exit;

    }

  } else {

    $msg = 'Erro ao executar a consulta de colaborador agendado online!';

    # retornando mensagem para o portal avanço
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);

    exit;

  }

}

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
      d.id AS id_departamento,
      d.name AS departamento
    FROM lh_departament AS d
    INNER JOIN lh_userdep AS u
      ON u.dep_id = d.id
    INNER JOIN lh_users AS s
      ON s.id = u.user_id
    WHERE NOT (d.id = 1 OR d.id = 2 OR d.id = 3 OR d.id = 4 OR d.id = 6 OR d.id = 7 OR d.id = 8 OR d.id = 9 OR d.id = 10 OR d.id = 11)
      AND (s.hide_online = 'false')
      AND (d.disabled = 0)
      AND (s.disabled = 0)
      AND (u.last_activity > 0)
      AND (s.id <> 5)
      AND (s.id <> 36)
      AND (s.id <> 37)
      AND (s.id <> 38)
      AND (s.id <> 39)
      AND (s.id <> 40)
      AND (s.id <> 41)
      AND (s.id <> 42)
      AND (s.id <> 43)
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

        $array[$posicao]['id']              = $registro['id'];
        $array[$posicao]['nome']            = $registro['nome'];
        $array[$posicao]['sobrenome']       = $registro['sobrenome'];
        $array[$posicao]['conhecimento']    = '0';
        $array[$posicao]['fila']            = '0';
        $array[$posicao]['id_departamento'] = $registro['id_departamento'];
        $array[$posicao]['departamento']    = $registro['departamento'];

        $posicao++;

      }

    } else {

      # retornando null para o portal avanço
      echo json_encode(NULL);

      exit;

    }

  } else {

    $msg = 'Erro ao executar a consulta de colaboradores logados!';

    # retornando mensagem para o portal avanço
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);

    exit;

  }

  return $array;
}
