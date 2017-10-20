<?php

/*
 * cria um array modelo para receber os dados do formulário de novo ticket
 */
function criaModeloParaFormularioNovoTicket()
{
  $formulario = array(
    'data_hora'      => '',
    'ticket'         => 0,
    'validade'       => true,
    'contato'        => '',
    'cnpj'           => '',
    'conta_contrato' => '',
    'razao_social'   => '',
    'supervisor'     => 0,
    'colaborador'    => 0,
    'produto'        => 0,
    'modulo'         => 0,
    'assunto'        => ''
  );

  return $formulario;
}
