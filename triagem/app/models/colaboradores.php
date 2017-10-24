<?php

/*
 * cria um array modelo para receber os dados dos colaboradores
 */
function criaModeloDeColaboradores()
{
  $colaboradores = array(
    array(
      'id'              => '',
      'nome'            => '',
      'sobrenome'       => '',
      'conhecimento'    => '0',
      'fila'            => '0',
      'id_departamento' => '0',
      'departamento'    => ''
    )
  );

  return $colaboradores;
}
