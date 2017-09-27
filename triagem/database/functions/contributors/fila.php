<?php

/**
 * verifica a quantidade de fila dos colaboradores
 * @param - array com os dados dos colaboradores online
 * @param - inteiro com a quantidade de colaboradores online
 * @param - objeto com uma conexão aberta
 */
function verificaFilaDosColaboradoresOlineQuePossuemConhecimento($array, $quantidade, $db)
{
  $posicao = 0;

  # executando a query para todos os colaboradores do array
  while ($posicao < $quantidade) {

    $query =
      "SELECT
      	COUNT(c.id) AS fila
      FROM lh_chat AS c
      WHERE (c.status = 1)
      	AND (c.user_id = {$array[$posicao]['id']})";

    # verificando se a query pode ser executada
    if ($resultado = $db->query($query)) {

      # recuperando a quantidade de fila
      while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

        $array[$posicao]['fila'] = $registro['fila'];

      }

    } else {

      # chamando função que grava um log
      gravaLog('erro na consulta de quantidade de fila, no script fila.php', 'error');

    }

    $posicao++;

  }

  return $array;
}
