<?php

/**
 * responsável por solicitar a inserção dos dados de um contato nas tabelas de contatos, emails, telefones fixos e móveis
 * @param - string com o id do cnpj da empresa
 * @param - string com o nome do contato
 * @param - array com o(s) telefone(s) fixo(s)
 * @param - array com o(s) telefone(s) movel(éis)
 * @param - array com o(s) endereço(s) de email(s)
 */
function recebeContato($id, $nome, $fixos, $moveis, $emails)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/insercoes_contato.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/consultas_contato.php';

  $db = abre_conexao();

  # chamando função que insere o nome de um contato
  $resultado = insereNomeDoContato($db, $id, $nome);

  # verificando se o nome do contato foi inserido
  if ($resultado) {
    # chamando função que retorna o id do novo contato
    $idContato = retornaIdDoContato($db, $id, $nome);    
  }

  # verificando se o id do novo contato foi adicionado
  if ($idContato) {
    # chamando função que insere o(s) telefone(s) fixo(s)    
    insereTelefonesFixos($db, $idContato, $fixos);

    # chamando função que insere o(s) telefone(s) movél(eis)
    insereTelefonesMoveis($db, $idContato, $moveis);

    # chamando função que insere o(s) email(s)
    insereEmails($db, $idContato, $emails);
  }

  fecha_conexao($db);
  
}

/**
 * responsável por retornar todos os contatos de um cnpj 
 * @param - string com o id do cnpj da empresa
 */
function retornaContatos($id)
{
  require DIRETORIO_FUNCTIONS . 'schedule/consultas_contato.php';

  $db = abre_conexao();

  $table = consultaContatos($db, $id);

  echo $table;

  fecha_conexao($db);
}
