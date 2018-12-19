<?php

/**
 * consulta os dados de um atendimento remoto
 * @param - inteiro com o id do atendimento remoto
 */
function retornaDadosDoAtendimentoRemoto($db, $id)
{
  $query = "SELECT * FROM av_agenda_atendimentos_remotos WHERE id = $id";

  $resultado = mysqli_query($db, $query);

  $remoto = array();

  while ($linha = mysqli_fetch_array($resultado)) {    
    $remoto['id']           = (int) $linha['id'];
    $remoto['id_cnpj']      = (int) $linha['id_cnpj'];
    $remoto['id_issue']     = (int) $linha['id_issue'];
    $remoto['id_contato']   = (int) $linha['id_contato'];
    $remoto['registro']     = (int) $linha['registro'];
    $remoto['tipo']         = $linha['tipo'];
    $remoto['supervisor']   = (int) $linha['supervisor'];
    $remoto['colaborador']  = (int) $linha['colaborador'];
    $remoto['status']       = $linha['status'];
    $remoto['data']         = $linha['data'];    
    $remoto['horario']      = $linha['horario'];
    $remoto['produto']      = $linha['produto'];
    $remoto['modulo']       = $linha['modulo'];
    $remoto['observacao']   = $linha['observacao'];
    $remoto['faturado']     = (int) $linha['faturado'];
    $remoto['valor_hora']   = (float) $linha['valor_hora'];
    $remoto['valor_pacote'] = (float) $linha['valor_pacote'];    
    $remoto['registrado']   = $linha['registrado'];
  }

  return $remoto;
}