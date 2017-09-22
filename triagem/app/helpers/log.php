<?php

/**
 * grava logs em um arquivo
 * @param - string com uma mensagem
 * @param - string com o tipo de log (info, warning ou error)
 * @param - string com o nome do arquivo de log
 */
function gravaLog($mensagem, $tipo = 'info', $arquivo = 'main.log')
{
  $tipoStr = '';

  switch ($tipo) {

    case 'info':
      $tipoStr = 'INFO';
        break;

    case 'warning':
      $tipoStr = 'WARNING';
        break;

    case 'error':
      $tipoStr = 'ERROR';
        break;

  }

  $data = date('d-m-Y H:i:s');

  $mensagem = sprintf("[%s] [%s]: %s%s", $data, $tipoStr, $mensagem, PHP_EOL);

  file_put_contents($arquivo, $mensagem, FILE_APPEND);
}
