<?php

/**
 * edita os dados da tabela de cadastro
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da tabela de issues
 */
function editaDadosDaTabelaDeIssues($db, $issues)
{
  $query =
    "UPDATE av_registro_horas_issues
      SET
        issue          = '{$issues['issue']}',
        tipo           = '{$issues['tipo']}',
        cnpj           = '{$issues['cnpj']}',
        conta_contrato = '{$issues['conta_contrato']}',
        razao_social   = '{$issues['razao_social']}',
        supervisor     =  {$issues['supervisor']},
        colaborador    =  {$issues['colaborador']}
    WHERE (id = {$issues['id']});";

  $resultado = $db->query($query);

  return $resultado;

}

/**
 * edita os dados da tabela de despesas
 * @param - objeto com uma conexão aberta
 * @param - string com o id da issue
 * @param - array com os dados da tabela de issues
 */
function editaDadosDaTabelaDeDespesas($db, $id, $despesas)
{
  $query = "SELECT * FROM av_registro_horas_despesas WHERE (id_issue = $id);";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    # verificando se existe registro de despesas para o id informado
    if ($resultado->num_rows > 0) {

        $query =
          "UPDATE av_registro_horas_despesas
            SET
              deslocamento = {$despesas['deslocamento']},
              alimentacao  = {$despesas['alimentacao']},
              hospedagem   = {$despesas['hospedagem']},
              total        = {$despesas['total']}
          WHERE (id_issue = $id);";

        # atualizando despesas
        $resultado = $db->query($query);

    } else {

      $query =
        "INSERT INTO av_registro_horas_despesas
          VALUES
            (null,
            $id,
            {$despesas['deslocamento']},
            {$despesas['alimentacao']},
            {$despesas['hospedagem']},
            {$despesas['total']})";

      # inserindo despesas
      $resultado = $db->query($query);

    }

  }

  return $resultado;

}

/**
 * edita os dados da tabela de lançamentos
 * @param - objeto com uma conexão aberta
 * @param - string com o id da issue
 * @param - array com os dados da tabela de issues
 */
function editaDadosDaTabelaDeLancamentos($db, $id, $lancamentos)
{ 
  # chamando função que deleta todos os lançamentos interligados ao id da issue informada
  $resultado = deletaLancamentos($db, $id);

  # verificando se todos os lançamentos foram deletados
  if ($resultado) {

    # chamando fuçnão que insere os novos lançamentos
    $resultado = insereRegistroDeLancamentos($db, $lancamentos, $id);

  } else {

    # gravando mensagem de erro
    gravaMensagemNaSessao('danger', true, 'Ops', 'Erro ao deletar os lançamentos');

    redirecionaUsuarioParaEdicaoDeLancamentos();

  }

  return $resultado;

}
