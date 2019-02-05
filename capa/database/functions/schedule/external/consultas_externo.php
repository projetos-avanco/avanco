<?php

/**
 * retorna os dados de um atendimento externo para a tela de edição
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do atendimento externo
 */
function retornaDadosDoAtendimentoExternoParaEdicao($db, $id) {
  $query =
    "SELECT
      r.razao_social,
      r.cnpj,
      c.conta_contrato,
      t.nome,
      f.fixo,
      m.movel,
      e.endereco
    FROM av_agenda_atendimentos_externos AS a
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
    $externo['tarefa']       = $linha['tarefa'];
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