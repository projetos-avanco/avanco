<?php

/**
 * consulta id, nome e sobrenome dos colaboradores do atendimento
 * @param - objeto com uma conexão ativa
 */
function consultaDadosPessoaisDosColaboradores($db)
{
  $query = 
    "SELECT
      u.id,
      u.name AS nome,
      u.surname AS sobrenome,
      c.moedas
    FROM lh_users AS u
    INNER JOIN av_avancoins_carteiras AS c
      ON c.id = u.id
    WHERE NOT(u.id = 1  OR
              u.id = 2  OR
              u.id = 3  OR
              u.id = 4  OR
              u.id = 5  OR
              u.id = 6  OR
              u.id = 36 OR
              u.id = 37 OR
              u.id = 38 OR
              u.id = 39 OR
              u.id = 40 OR
              u.id = 41 OR
              u.id = 42 OR
              u.id = 44 OR
              u.id = 61)
      AND (u.disabled = 0)
    ORDER BY u.name;";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $dados = array();

    # recuperando dados
    while ($registro = $resultado->fetch_assoc()) {

      $dados[] = array(

        'id'        => $registro['id'],
        'nome'      => $registro['nome'],
        'sobrenome' => $registro['sobrenome'],
        'moedas'    => $registro['moedas']

      );

    }

  }

  return $dados;

}