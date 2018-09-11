<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require '../../../init.php';
  #exit(var_dump($_POST));
  $endereco = array();

  if (! empty($_POST['endereco']['id-cnpj']) && is_numeric($_POST['endereco']['id-cnpj'])) {
    $endereco['id'] = $_POST['endereco']['id-cnpj'];
  }

  if (! empty($_POST['endereco']['tipo']) && is_numeric($_POST['endereco']['tipo'])) {
    $endereco['tipo'] = $_POST['endereco']['tipo'];
  }

  if (! empty($_POST['endereco']['logradouro']) && is_string($_POST['endereco']['logradouro'])) {
    $endereco['logradouro'] = $_POST['endereco']['logradouro'];
  }

  if (! empty($_POST['endereco']['complemento'])) {
    $endereco['complemento'] = $_POST['endereco']['complemento'];
  } else {
    $endereco['complemento'] = '';
  }

  if (! empty($_POST['endereco']['numero']) && is_numeric($_POST['endereco']['numero'])) {
    $endereco['numero'] = $_POST['endereco']['numero'];
  }

  if (! empty($_POST['endereco']['cep']) && is_string($_POST['endereco']['cep'])) {
    $endereco['cep'] = $_POST['endereco']['cep'];
  }

  if (! empty($_POST['endereco']['referencia'])) {
    $endereco['referencia'] = $_POST['endereco']['referencia'];
  } else {
    $endereco['referencia'] = '';
  }

  if (! empty($_POST['endereco']['distrito'])) {
    $endereco['distrito'] = $_POST['endereco']['distrito'];
  }

  if (! empty($_POST['endereco']['localidade'])) {
    $endereco['localidade'] = $_POST['endereco']['localidade'];
  }

  if (! empty($_POST['endereco']['uf'])) {
    $endereco['uf'] = $_POST['endereco']['uf'];
  }

  exit(var_dump($endereco));
}
