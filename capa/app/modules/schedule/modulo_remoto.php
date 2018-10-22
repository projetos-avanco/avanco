<?php

/**
 * responsável por preparar os dados e solicitar a gravação de um registro de horas
 * @param - objeto com uma conexão aberta
 * @param - array com os dados de um atendimento remoto
 */
function solicitaGravacaoDeRegistroDeHoras($db, $remoto)
{
  $issue = array(
    'id'             => 0,
    'issue'          => '',
    'tipo'           => 'remoto',
    'status'         => '1',
    'cnpj'           => null,
    'conta_contrato' => null,
    'razao_social'   => null,
    'supervisor'     => $remoto['supervisor'],
    'colaborador'    => $remoto['colaborador'],
    'observacao'     => 'relatório pendente referente ao registro'
  );
}

/**
 * responsável por gravar um atendimento remoto
 * @param - array com os dados de um atendimento remoto
 * @param - array com os dados de um contato
 */
function recebeAtendimentoRemoto($remoto, $contato)
{
  require DIRETORIO_HELPERS . 'diversas.php';
  require DIRETORIO_MODULES . 'hours/horas.php';

  $db = abre_conexao();

  $remoto['registro'] = geraRegistro($db, 'av_agenda_atendimentos_remotos');

  var_dump($remoto); exit;
}