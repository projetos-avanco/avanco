<?php 

/*
 * cria um array modelo para receber os dados dos produtos da loja avanção
 */
function criaModeloDeProdutos()
{
  $produtos = array();

  return $produtos;
}


/*
 * cria um array modelo para receber os dados da compra
 */
function criaArrayModeloDeCompra()
{
  $compra = array(
    'id'             => null,
    'id_colaborador' => '',
    'id_produto'     => '',
    'data_compra'    => '',
    'horario_compra' => '',
    'email'          => '',
    'envio_email'    => ''
  );

  return $compra;
  
}