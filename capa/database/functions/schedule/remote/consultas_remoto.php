<?php

/**
 * retorna os dados de um atendimento remoto para a tela de edição
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do atendimento remoto
 */
function retornaDadosDoAtendimentoRemotoParaEdicao($db, $id) {
  $query =
    "SELECT
      r.razao_social,
      r.cnpj,
      c.conta_contrato,
      t.nome,
      f.fixo,
      m.movel,
      e.endereco
    FROM av_agenda_atendimentos_remotos AS a
    INNER JOIN av_agenda_cnpjs AS r
      ON r.id = a.id_cnpj
    INNER JOIN av_agenda_contratos AS c
      ON c.id = r.id_contrato
    INNER JOIN av_agenda_contatos AS t
      ON t.id = a.id_contato
    INNER JOIN av_agenda_emails AS e
      ON e.id_contato = t.id
    INNER JOIN av_agenda_telefones_fixos AS f
      ON f.id_contato = t.id
    INNER JOIN av_agenda_telefones_moveis AS m
      ON m.id_contato = t.id
    WHERE a.id = $id";

  $resultado = mysqli_query($db, $query);

  $dados = array();

  while ($linha = mysqli_fetch_array($resultado)) {
    $linha['cnpj']     = substr($linha['cnpj'], 0, 2) . '.'. substr($linha['cnpj'], 2, 3) . '.' . substr($linha['cnpj'], 5, 3) . '/' . substr($linha['cnpj'], 8, 4) . '-' . substr($linha['cnpj'], 12, 2);

    $linha['conta_contrato'] = substr($linha['conta_contrato'], 0, 4) . '-' . substr($linha['conta_contrato'], 4, 3);
    $linha['razao_social']   = strtoupper($linha['razao_social']);
    $linha['nome']           = strtoupper($linha['nome']);
    $linha['endereco']       = strtoupper($linha['endereco']);

    $dados['razao_social']   = $linha['razao_social'];
    $dados['cnpj']           = $linha['cnpj'];
    $dados['conta_contrato'] = $linha['conta_contrato'];
    $dados['nome']           = $linha['nome'];
    $dados['fixo']           = $linha['fixo'];
    $dados['movel']          = $linha['movel'];
    $dados['endereco']       = $linha['endereco'];
  }

  return $dados;
}

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