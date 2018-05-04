<?php

/**
 * remove acentos
 * @param - string com acentos e espacos
 */
function removeAcentos($string)
{
  # removendo acentos e trocando espaços por traço
  $tr = strtr($string, array (
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
        'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
        'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N',
        'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
        'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Ŕ' => 'R',
        'Þ' => 's', 'ß' => 'B', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
        'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
        'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
        'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y',
        'þ' => 'b', 'ÿ' => 'y', 'ŕ' => 'r')
  );

  return $tr;
}

/**
 * remove acentos e troca espaços ( ) por traço (-)
 * @param - string com acentos e espacos
 */
function removeAcentosTrocaEspacoPorTraco($string)
{
  # removendo acentos e trocando espaços por traço
  $tr = strtr($string, array (
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
        'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
        'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N',
        'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
        'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Ŕ' => 'R',
        'Þ' => 's', 'ß' => 'B', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
        'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
        'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
        'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y',
        'þ' => 'b', 'ÿ' => 'y', 'ŕ' => 'r', ' ' => '-')
  );

  return $tr;
}

/**
 * decodefica caracteres especiais JSON para UTF-8
 * @param - string com a cadeia de caracteres que será decodificada
 */
function decodificaCaracteresJSON($string)
{
  return json_decode('["'.$string.'"]')[0];
}

/*
 * gera um código de ticket com 6 dígitos
 */
function geraTicket()
{
  $ticket = NULL;

  # gerando código de ticket
  for ($i = 1; $i <= 6; $i++) {

    $ticket .= rand(1, 9);

  }

  return $ticket;
}

/**
 * redireciona o usuário para a página de edição de lançamentos
 * @param - objeto com uma conexão aberta
 * @param - string com o id da issue
 */
function redirecionaUsuarioParaEdicaoDeLancamentos($db, $issue)
{
  fecha_conexao($db);

  # redirecionando usuário
  header('Location: ' . BASE_URL . 'public/views/hours/edita_lancamentos.php?issue=' . $issue);

  exit;

}

/**
 * grava uma mensagem na sessão
 * @param - string com o tipo da mensagem (success, info, warning ou danger)
 * @param - booleno que informa se a mensagem deve ser exibe (true - exibe, false - não exibe)
 * @param - string com o texto que fica em negrito
 * @param - string com o texto que não fica em negrito
 */
function gravaMensagemNaSessao($tipo, $exibe, $primeiroTexto, $segundoTexto)
{
  $_SESSION['mensagens'] = array(

    'tipo'     => $tipo,
    'exibe'    => $exibe,
    'mensagem' => '<p class="text-center"><strong>' . $primeiroTexto . '!</strong> ' . $segundoTexto . '.</p>'

  );

}