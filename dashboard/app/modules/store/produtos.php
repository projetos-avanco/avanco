<?php

/*
 * responsável por retornar as informações dos produtos da loja
 */
function retornaProdutosDaLojaAvancao() 
{
  require DIRETORIO_MODELS    . 'store/produtos.php';
  require DIRETORIO_FUNCTIONS . 'store/consultas_produtos.php';

  # chamando função que cria um modelo para receber os dados dos produtos
  $produtos = criaModeloDeProdutos();

  $db = abre_conexao();

  # chamando função que retorna as informações dos produtos da loja
  $produtos = consultaProdutosDaLojaAvancao($db, $produtos);

  return $produtos;

}