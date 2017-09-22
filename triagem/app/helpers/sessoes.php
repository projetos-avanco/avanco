<?php

/**
 * cria uma sessão com os dados do cliente enviados pelo Portal Avanço
 * @param - array com os dados do cliente
 */
function criaSessaoDeCliente($array)
{
  $_SESSION['cliente'] = array(
    'nome'           => $array['nome'],
    'nome_usuario'   => $array['nome_usuario'],
    'cnpj'           => $array['cnpj'],
    'conta_contrato' => $array['conta_contrato'],
    'razao_social'   => $array['razao_social'],
    'produto'        => $array['produto'],
    'modulo'         => $array['modulo'],
    'duvida'         => $array['duvida'],
    'departamento'   => $array['departamento']
  );
}
