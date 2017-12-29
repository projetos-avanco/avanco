<?php

/*
 * cria um array modelo para receber as mensagens de erro ou sucesso
 */
function criaModeloDeSessaoParaMensagens()
{
  $_SESSION['mensagens'] = array(

    'mensagem' => '',
    'tipo' => '',
    'exibe' => false

  );

}

/*
 * cria um array modelo para receber os dados do módulo avancoins
 */
function criaModeloDeSessaoParaAvancoins()
{
  # verificando se existem dados na sessão do módulo avnacoins
  if (isset($_SESSION['avancoins'])) {

    unset($_SESSION['avancoins']);

  }

  $_SESSION['avancoins'] = array('extrato' => '');

}

/**
 * grava os dados do módulo avancoins na sessão
 * @param - array com as ações diárias do colaborador
 * @param - array com as ações mensais do colaborador
 * @param - array com as ações esporádicas do colaborador
 * @param - array com os valores totais das ações do colaborador
 */
function gravaModeloDeSessaoAvancoins($tabela)
{
  $_SESSION['avancoins']['extrato'] = $tabela;
}
