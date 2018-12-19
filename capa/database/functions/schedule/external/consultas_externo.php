<?php

/**
 * consulta os dados de um atendimento externo
 * @param - inteiro com o id do atendimento externo
 */
function retornaDadosDoAtendimentoExterno($db, $id)
{
  $query = "SELECT * FROM av_agenda_atendimentos_externos WHERE id = $id";

  $resultado = mysqli_query($db, $query);

  $externo = array();

  while ($linha = mysqli_fetch_array($resultado)) {    
    $externo['id']           = (int) $linha['id'];
    $externo['id_cnpj']      = (int) $linha['id_cnpj'];
    $externo['id_issue']     = (int) $linha['id_issue'];
    $externo['id_contato']   = (int) $linha['id_contato'];
    $externo['registro']     = (int) $linha['registro'];
    $externo['tipo']         = $linha['tipo'];
    $externo['supervisor']   = (int) $linha['supervisor'];
    $externo['colaborador']  = (int) $linha['colaborador'];
    $externo['status']       = $linha['status'];
    $externo['data_inicial'] = $linha['data_inicial'];
    $externo['data_final']   = $linha['data_final'];
    $externo['horario']      = $linha['horario'];
    $externo['produto']      = $linha['produto'];
    $externo['modulo']       = $linha['modulo'];
    $externo['observacao']   = $linha['observacao'];
    $externo['faturado']     = (int) $linha['faturado'];
    $externo['valor_hora']   = (float) $linha['valor_hora'];
    $externo['valor_pacote'] = (float) $linha['valor_pacote'];
    $externo['despesa']      = (int) $linha['despesa'];
    $externo['registrado']   = $linha['registrado'];
  }

  return $externo;
}

/**
 * consulta o id de um atendimento externo
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o número do registro
 */
function consultaIdDoAtendimentoExterno($db, $registro)
{
  $query = "SELECT id FROM av_agenda_atendimentos_externos WHERE registro = $registro";

  $resultado = mysqli_query($db, $query);

  $id = mysqli_fetch_row($resultado);

  return (int)$id[0];
}