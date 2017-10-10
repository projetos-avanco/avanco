<?php

/**
 * verifica a quantidade de fila dos colaboradores
 * @param - array com os dados dos colaboradores online
 * @param - inteiro com a quantidade de colaboradores online
 * @param - objeto com uma conexão aberta
 */
function verificaFilaDosColaboradores($array, $quantidade, $db)
{
  $posicao = 0;

  # executando a query para todos os colaboradores do array
  while ($posicao < $quantidade) {

    $query =
      "SELECT
      	COUNT(c.id) AS fila
      FROM lh_chat AS c
      WHERE (c.status = 0 OR c.status = 1)
      	AND (c.dep_id = {$array[$posicao]['id_departamento']})";

    # verificando se a query pode ser executada
    if ($resultado = $db->query($query)) {

      # recuperando a quantidade de fila
      while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

        $array[$posicao]['fila'] = $registro['fila'];

      }

    } else {

      $msg = 'Erro ao executar a consulta de quantidade de fila!';

      # retornando mensagem para o portal avanço
      echo json_encode($msg, JSON_UNESCAPED_UNICODE);

      exit;

    }

    $posicao++;

  }

  return $array;
}
