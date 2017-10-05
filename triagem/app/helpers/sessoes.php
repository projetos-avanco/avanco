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
    'duvida'         => $array['duvida']
  );
}

/**
 * cria uma sessão com os dados dos colaboradores online no chat
 * @param - array com os dados dos colaboradores
 */
function criaSessaoDeColaboradores($array)
{
  $_SESSION['colaboradores'] = $array;
}

/**
 * cria uma sessão com o nome do departamento do colaborador online no chat que realizará o atendimento
 * @param - string com o nome do departamento
 */
function criaSessaoDeDepartamento($string)
{
  $_SESSION['departamento'] = $string;
}

/**
 * cria uma sessão com os dados dos documentos da base de conhecimento
 * @param - array com os dados dos colaboradores
 */
function criaSessaoDeDocumentos($array)
{
  $_SESSION['documentos'] = $array;
}
