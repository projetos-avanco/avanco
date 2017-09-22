<?php

/**
 * recupera dados que estão nos array super-global $_POST
 * @param - array modelo que receberá os dados do cliente
 * @param - string com o tipo do método que foram enviados os dados
 */
function recuperaDados($array, $metodo)
{
  # verificando se os dados foram enviados via método POST
  if ($metodo === 'POST') {

    # recuperando dados que estão no array super-global $_POST
    foreach ($_POST as $chave => $valor) {

      $array['nome']           = $valor['nome'];
      $array['nome_usuario']   = $valor['nome_usuario'];
      $array['cnpj']           = $valor['cnpj'];
      $array['conta_contrato'] = $valor['conta_contrato'];
      $array['razao_social']   = $valor['razao_social'];
      $array['produto']        = $valor['produto'];
      $array['modulo']         = $valor['modulo'];
      $array['duvida']         = $valor['duvida'];

      break;

    }

    # chamando função que grava os dados do cliente em uma sessão
    criaSessaoDeCliente($array);
  }
}
