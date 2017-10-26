<?php

mysqli_report(MYSQLI_REPORT_STRICT);

/**
 * abre uma conexão com a base de dados MYSQL
 */
function abre_conexao()
{
  try {

    $conexao = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    $conexao->set_charset('utf8');

    return $conexao;

  } catch(Exception $e) {

      echo $e->getMessage();

      return null;

  }
}
