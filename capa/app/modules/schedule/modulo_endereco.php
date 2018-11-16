<?php

/**
 * responsável por atualizar o endereço nas tabelas de estados, cidades, bairros e endereços
 * @param - array com os dados do endereço
 */
function recebeNovoEnderecoParaEdicao($endereco)
{
  require DIRETORIO_FUNCTIONS . 'schedule/address/consultas_endereco.php';
  require DIRETORIO_FUNCTIONS . 'schedule/address/atualizacoes_endereco.php';
  require DIRETORIO_FUNCTIONS . 'schedule/address/insercoes_endereco.php';

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
  atualizaEnderecoExistente($db, $endereco, $idDistrito);

  $_SESSION['atividades']['tipo'] = 'success';
  $_SESSION['atividades']['exibe'] = true;
  $_SESSION['atividades']['mensagens'][] = 'Endereço editado com sucesso. Feche essa aba e na página de Atendimento selecione a Empresa novamente.';

  header('Location:' . BASE_URL . 'public/views/schedule/address/edita_endereco.php?id=' . $endereco['id_cnpj']); exit;
}

/**
 * responsável por solicitar a inserção dos dados do endereço nas tabelas de estados, cidades, bairros e endereços
 * @param - array com os dados do endereço
 */
function recebeNovoEndereco($endereco)
{
  require DIRETORIO_FUNCTIONS . 'schedule/address/consultas_endereco.php';
  require DIRETORIO_FUNCTIONS . 'schedule/address/insercoes_endereco.php';

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
  $_SESSION['atividades']['mensagens'][] = 'Endereço cadastrado com sucesso. Feche essa aba e na página de Atendimento selecione a Empresa novamente.';

  header('Location:' . BASE_URL . 'public/views/schedule/address/endereco.php?id=' . $endereco['id']); exit;
}

/**
 * responsável por retornar um endereço de um cnpj
 * @param - string com o id do cnpj
 */
function consultaEnderecoAjax($id)
{
  require DIRETORIO_FUNCTIONS . 'schedule/address/consultas_endereco.php';

  $db = abre_conexao();

  # chamando função que retorna um endereço completo de um cnpj
  $endereco = retornaEnderecoAjax($db, $id);

  echo json_encode($endereco);
}
