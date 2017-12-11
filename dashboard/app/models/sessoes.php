<?php

/*
 * cria uma sessão para usuário (utilizado para gravar os dados do usuário que está logando no sistema)
 */
function criaSessaoDeUsuario()
{
  $_SESSION['usuario'] = array(
    'id' => '0',
    'nome' => '',
    'sobrenome' => '',
    'usuario' => '',
    'nivel' => 0,
    'logado' => false,
    'tipo' => 0,
    'mensagem' => ''
  );
}

/*
 * cria uma sessão para colaborador (utilizado para gravar o retorno da consultas de INSERT ou UPDATE dos dados do colaborador)
 */
function criaSessaoDeColaborador()
{
  $_SESSION['colaborador'] = array(
    'id' => '0',
    'tipo' => 0,
    'mensagem' => ''
  );
}

/*
 * cria uma sessão para colaboradores (utilizado para montar o select da página de administrador)
 */
function criaSessaoDeColaboradores()
{
  $_SESSION['colaboradores'] = array(
    'options' => array(),
  );
}

/*
 * cria uma sessão para os percentuais que serão usados para gerar os gráficos
 */
function criaSessaoDeGraficos()
{
  $_SESSION['graficos'] = array(
    'integral' => array(
      'materiais' => '',
      'fiscal' => '',
      'financeiro' => '',
      'contabil' => '',
      'cotacao' => '',
      'tnfe' => '',
      'wms' => ''
    ),

    'frente_de_loja' => array(
      'frente_windows' => '',
      'frente_linux' => '',
      'supervisor' => '',
      'scanntech' => '',
      'sitef' => '',
      'comandas' => ''
    ),

    'gestor' => array(
      'instalacao' => '',
      'cadastro' => '',
      'movimento' => '',
      'contabil' => '',
      'fiscal' => ''
    ),

    'novo_erp' => array(
      'instalacao' => '',
      'pessoas' => '',
      'produtos' => '',
      'fiscal' => '',
      'financeiro' => '',
      'lancamentos' => '',
      'relatorios_e_graficos' => '',
      'importacao_e_exportacao' => '',
      'configuracoes_pdv' => '',
      'minha_conta' => ''
    )
  );
}

/*
 * cria uma sessão para mensagens
 */
function criaSessaoDeMensagens()
{
  $_SESSION['mensagens'] = array(
    'alteracao_senha' => array(
      'tipo' => 0,
      'mensagem' => ''
    )
  );
}
