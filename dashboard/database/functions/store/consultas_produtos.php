<?php 

/**
 * responsável por retornar as informações dos produtos da loja
 * @param - objeto com uma conexão aberta
 */
function consultaProdutosDaLojaAvancao($db, $produtos) 
{
  $query = "SELECT * FROM av_avancoins_produtos";

  if ($resultado = $db->query($query)) {

    while ($registro = $resultado->fetch_assoc()) {

      $produtos[] = array(

        'id'        => $registro['id'],
        'descricao' => $registro['descricao'],
        'valor'     => abs($registro['valor']),
        'imagem'    => $registro['imagem']

      );

    }

  }
  
  return $produtos;

}

/**
 * consulta a descrição do produto
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da compra
 */
function consultaNomeDoProduto($db, $id)
{
  $query = "SELECT descricao FROM av_avancoins_produtos WHERE (id = $id);";

  $produto = '';

  if ($resultado = $db->query($query)) {

    $produto = $resultado->fetch_row();
    $produto = $produto[0];

  }

  return $produto;

}

/*
 * consulta o nome do colaborador 
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da compra
 */
function consultaNomeDoColaborador($db, $id)
{
  $query = "SELECT name, surname FROM lh_users WHERE (id = $id);";

  $colaborador = '';
  
  if ($resultado = $db->query($query)) {

    $colaborador = $resultado->fetch_row();
    $colaborador = $colaborador[0] . ' ' . $colaborador[1];

  }

  return $colaborador;

}

/**
 * consulta se a quantidade de moedas que o colaborador possui pode realizar a compra do produto
 * @param - objeto com uma conexão aberta
 * @param - string com o id do produto
 * @param - string com o id do colaborador 
 */
function consultaQuantidadeDeMoedasParaCompra($db, $idProduto, $idColaborador)
{
  $query = "SELECT moedas FROM av_avancoins_carteiras WHERE (id = $idColaborador)";

  # verificando a quantidade de moedas que o colaborador possui
  if ($resultado = $db->query($query)) {

    $moedas = $resultado->fetch_row();
    $moedas = (int)$moedas[0];

  }

  $query = "SELECT valor FROM av_avancoins_produtos WHERE (id = $idProduto)";

  # verificando o preco do produto
  if ($resultado = $db->query($query)) {

    $preco = $resultado->fetch_row();
    $preco = abs((int)$preco[0]);

  }

  $retorno = false;

  # verificando se a quantidade de moedas e maior ou igual ao preco do produto
  if ($moedas >= $preco) {

    $retorno = true;

  }

  return $retorno;

}