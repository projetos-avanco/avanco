<?php

/**
 * responsável por solicitar a inserção dos dados do endereço nas tabelas de estados, cidades, bairros e endereços
 * @param - array com o dados do endereço
 */
function recebeNovoEndereco($endereco)
{
  require DIRETORIO_FUNCTIONS . 'schedule/consultas_endereco.php';
  require DIRETORIO_FUNCTIONS . 'schedule/insercoes_endereco.php';

  $db = abre_conexao();

  # chamando função que verifica se a cidade já esta cadastrada na tabela de cidades
  $idLocalidade = verificaLocalidadeCadastrada($db, $endereco['uf'], $endereco['localidade']);

  # verificando se a cidade ainda não está cadastrada na tabela de cidades
  if ((! isset($idLocalidade))) {
    # chamando função que insere um registro na tabela de cidades
    insereNovaLocalidade($db, $endereco['uf'], $endereco['localidade']);

    # chamando novamente a função para recuperar o id da cidade inserido
    $idLocalidade = verificaLocalidadeCadastrada($db, $endereco['uf'], $endereco['localidade']);
  }

  # chamando função que verifica se o bairro já está cadastrado na tabela de bairros
  $idDistrito = verificaDistritoCadastrado($db, $idLocalidade, $endereco['distrito']);

  # verificando se o bairro ainda não está cadastrado na tabela de bairros
  if ((! isset($idDistrito))) {
    # chamando função que insere um registro na tabela de bairros
    insereNovoDistrito($db, $idLocalidade, $endereco['distrito']);

    # chamando novamente a função para recuperar o id do bairro inserido
    $idDistrito = verificaDistritoCadastrado($db, $idLocalidade, $endereco['distrito']);
  }

  # chamando função que insere um registro na tabela de endereços
  insereNovoEndereco($db, $endereco, $idDistrito);

  $_SESSION['atividades']['tipo'] = 'success';
  $_SESSION['atividades']['exibe'] = true;
  $_SESSION['atividades']['mensagens'][] = 'Endereço cadastrado com sucesso. Volte para página de Atendimento Externo e pesquisa a Empresa novamente.';

  header('Location:' . BASE_URL . 'public/views/schedule/endereco.php?id=' . $endereco['id']);
  exit;
}

/**
 * responsável por retornar um endereço de um cnpj
 * @param - string com o id do cnpj
 */
function consultaEnderecoAjax($id)
{
  require DIRETORIO_FUNCTIONS . 'schedule/consultas_endereco.php';

  $db = abre_conexao();

  $endereco = retornaEnderecoAjax($db, $id);

  echo json_encode($endereco);
}
