<?php

/**
 * recupera dados contidos nos arrays superglobais
 * @param - array com o modelo de dados
 * @param - string com o nome do formulário
 * @param - string com o método de envio de requisição
 */
function recuperaDadosDosArraysSuperGlobais($modelo, $formulario, $requisicao)
{
  # verificando qual formulário foi enviado
  if ($formulario == 'ticket') {

    # verificando o método de envio de requisicão
    switch ($requisicao) {

      case 'POST':

        # verificando se existe dados no array super global POST
        if (isset($_POST['form']) AND (count($_POST['form']) == 11)) {

          # recuperando dados          
          $modelo['agendado']       = $_POST['form']['data'] . ' '. $_POST['form']['horario'] . ':00';
          $modelo['contato']        = $_POST['form']['contato'];
          $modelo['cnpj']           = $_POST['form']['cnpj'];
          $modelo['conta_contrato'] = $_POST['form']['conta-contrato'];
          $modelo['razao_social']   = $_POST['form']['razao-social'];
          $modelo['telefone']       = $_POST['form']['telefone'];
          $modelo['colaborador']    = $_POST['form']['colaborador'];
          $modelo['produto']        = $_POST['form']['produto'];
          $modelo['modulo']         = $_POST['form']['modulo'];
          $modelo['assunto']        = $_POST['form']['assunto'];          

        }

        return $modelo;

          break;

    }

  }

}
