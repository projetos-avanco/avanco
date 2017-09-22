<?php

/*
 * cria um array modelo para receber os dados do cliente
 */
function criaModeloDeCliente()
{
  $cliente = array(
    'nome'           => '',
    'nome_usuario'   => '',
    'cnpj'           => '',
    'conta_contrato' => '',
    'razao_social'   => '',
    'produto'        => '',
    'modulo'         => '',
    'duvida'         => '',
    'departamento'   => '0'
  );

  return $cliente;
}
