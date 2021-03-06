<?php

/**
 * responsável por atualizar os dados de um contato nas tabelas de telefones fixos, telefones móveis e e-mails
 * @param - string com o id do contato
 * @param - array com o(s) telefone(s) fixo(s)
 * @param - array com o(s) telefone(s) movel(éis)
 * @param - array com o(s) endereço(s) de email(s) 
 */
function recebeContatoParaEdicao($id, $nome, $fixos, $moveis, $emails)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/contact/insercoes_contato.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/contact/atualizacoes_contato.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/contact/delecoes_contato.php';

  $db = abre_conexao();

  $resultados = array();

  # chamando função que atualiza o nome do contato
  atualizaNomeDeUmContato($db, $id, $nome);
  
  # chamando funções que deletam os números fixos, móveis e e-mails do contato
  $resultados['fixos']  = deletaFixos($db, $id);
  $resultados['moveis'] = deletaMoveis($db, $id);
  $resultados['emails'] = deletaEmails($db, $id);

  $_SESSION['atividades']['exibe'] = true;

  # verificando se números fixos, móveis e e-mails do contato foram deletados
  if ($resultados['fixos'] && $resultados['moveis'] && $resultados['emails']) {
    # chamando funções para inserir os novos números fixos, móveis e e-mails do contato
    insereTelefonesFixos($db, $id, $fixos);
    insereTelefonesMoveis($db, $id, $moveis);
    insereEmails($db, $id, $emails);

    $_SESSION['atividades']['tipo'] = 'success';
    $_SESSION['atividades']['mensagens'][] = 'Os dados do contato foram editados com sucesso. Feche essa aba e na página de Atendimento selecione a Empresa novamente';

    # redirecionando usuário para página de edição de contato
    header('location:' . BASE_URL . 'public/views/schedule/contact/edita_contato.php?id=' . $id); exit;
  } else {
    $_SESSION['atividades']['tipo'] = 'danger';
    $_SESSION['atividades']['mensagens'][] = 'Os dados do contato não foram editados.';
  }
}

/**
 * responsável por solicitar a busca dos dados de um contato e retornar via json
 * @param - string com o id do contato
 */
function recebeContatoParaBusca($id)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/contact/consultas_contato.php';

  $db = abre_conexao();

  # chamando função que retorna todos os dados de um contato
  $contato = consultaDadosDeUmContato($db, $id);

  echo json_encode($contato); exit;
}

/**
 * responsável por deletar um contato das tabelas de contatos, emails, telefones fixos e movéis
 * @param - string com o id do contato
 */
function recebeContatoParaDelecao($id)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/contact/delecoes_contato.php';

  $db = abre_conexao();

  # chamando função que deleta os dados do contato
  $resultados = deletaContato($db, $id);

  # verificando se todos os dados do contato foram deletados
  if ($resultados['email'] && $resultados['fixo'] && $resultados['movel'] && $resultados['contato']) {
    echo json_encode('Dados do contato deletados com sucesso! Selecione a empresa novamente.');
  } else {
    echo json_encode('Erro ao deletar os dados do contato! Informe ao Wellington Felix');
  }

  exit;
}

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
  require_once DIRETORIO_FUNCTIONS . 'schedule/contact/insercoes_contato.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/contact/consultas_contato.php';

  $erros = array();

  $db = abre_conexao();

  # chamando função que insere o nome de um contato
  $resultado = insereNomeDoContato($db, $id, $nome);

  # verificando se o nome do contato foi inserido
  if ($resultado) {
    # chamando função que retorna o id do novo contato
    $idContato = retornaIdDoContato($db, $id, $nome);    
  } else {
    $erros[] = 'Erro ao inserir o Nome do Contato. Procure por Wellington Felix!';
  }

  # verificando se o id do novo contato foi adicionado
  if ($idContato) {
    # chamando função que insere o(s) telefone(s) fixo(s)    
    insereTelefonesFixos($db, $idContato, $fixos);

    # chamando função que insere o(s) telefone(s) movél(eis)
    insereTelefonesMoveis($db, $idContato, $moveis);

    # chamando função que insere o(s) email(s)
    insereEmails($db, $idContato, $emails);
  } else {
    $erros[] = 'ID do Contato não foi recuperado. Procure por Wellington Felix!';
  }

  $_SESSION['atividades']['exibe'] = true;

  # verificando se houveram erros durante a inserções dos dados do contato
  if ($erros) {
    # repassando mensagens de erros para sessão
    for ($i = 0; $i < count($validacao['erros']); $i++) {
      $_SESSION['atividades']['mensagens'][] = $validacao['erros'][$i];
    }
  } else {
    $_SESSION['atividades']['tipo'] = 'success';
    $_SESSION['atividades']['mensagens'][] = 'Contato cadastrado com sucesso. Feche essa aba e na página de Atendimento selecione a Empresa novamente.';
  }

  # redirecionando usuário para página de contato
  header('Location:' . BASE_URL . 'public/views/schedule/contact/contato.php?id=' . $id);

  fecha_conexao($db);
  
}

/**
 * responsável por retornar todos os contatos de um cnpj 
 * @param - string com o id do cnpj da empresa
 */
function retornaContatos($id)
{
  require DIRETORIO_FUNCTIONS . 'schedule/contact/consultas_contato.php';

  $db = abre_conexao();

  $table = consultaContatos($db, $id);

  echo $table;

  fecha_conexao($db);
}
