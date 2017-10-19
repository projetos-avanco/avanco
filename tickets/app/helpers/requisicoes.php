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
        if (isset($_POST['form']) AND (count($_POST['form']) == 8)) {

          # recuperando dados
          foreach ($_POST as $form) {

            $modelo['contato']        = $form['contato'];
            $modelo['cnpj']           = $form['cnpj'];
            $modelo['conta_contrato'] = $form['conta-contrato'];
            $modelo['razao_social']   = $form['razao-social'];
            $modelo['colaborador']    = $form['colaborador'];
            $modelo['produto']        = $form['produto'];
            $modelo['modulo']         = $form['modulo'];
            $modelo['assunto']        = $form['assunto'];

          }

        }

        return $modelo;

          break;

    }

  }

}
