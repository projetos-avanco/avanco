<?php

/*
 * confirma o envio dos dados do cliente
 */
function confirmaEnvioDosDadosDoCliente()
{
  # verificando se os dados do cliente foram enviados
  if (
    ! empty($_POST['cliente']['nome'])           AND
    ! empty($_POST['cliente']['nome_usuario'])   AND
    ! empty($_POST['cliente']['cnpj'])           AND
    ! empty($_POST['cliente']['conta_contrato']) AND
    ! empty($_POST['cliente']['razao_social'])   AND
    ! empty($_POST['cliente']['telefone'])) {

      return true;

    }

  return false;

}

/*
 * confirma o envio dos dados da demanda
 */
function confirmaEnvioDosDadosDaDemanda()
{
  # verificando se os dados da demanda foram enviados
  if (! empty($_POST['cliente']['produto']) AND ! empty($_POST['cliente']['modulo']) AND ! empty($_POST['cliente']['duvida'])) {

    return true;

  }

  return false;

}

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

      $array['nome']           = ucwords($valor['nome']);
      $array['nome_usuario']   = ucwords($valor['nome_usuario']);
      $array['cnpj']           = $valor['cnpj'];
      $array['conta_contrato'] = $valor['conta_contrato'];
      $array['razao_social']   = strtoupper($valor['razao_social']);
      $array['produto']        = $valor['produto'];
      $array['modulo']         = $valor['modulo'];
      $array['duvida']         = ucwords($valor['duvida']);
      $array['telefone']       = $valor['telefone'];

      break;

    }

    # chamando função que grava os dados do cliente em uma sessão
    criaSessaoDeCliente($array);
  }
}
