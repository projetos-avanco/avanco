<?php

/**
 * consulta e retorna um array com id, nome e sobrenome dos colaboradores existentes no chat
 * @param - string vazia que receberá os dados
 * @param - objeto com uma conexão aberta
 */
function consultaColaboradores($options, $db)
{
  $query =
    "SELECT
    	id,
    	name AS nome,
    	surname AS sobrenome
    FROM lh_users
    WHERE (disabled = 0)
    	AND NOT (id = 1 OR id = 2 OR id = 3 OR id = 4 OR id = 5 OR id = 6 OR id = 42 OR id = 43 OR id = 44)
    ORDER BY nome";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $options .= '<option value="0" selected>Selecione um Colaborador</option>';

    while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

      $options .= "<option value='{$registro['id']}'>{$registro['nome']} {$registro['sobrenome']}</option>";

    }

  } else {

    #erro durante a execução da consulta
    echo 'erro';

  }

  $db->close();

  return $options;
}

/**
 * consulta e retorna um array com razão social, cnpj e conta contrato dos clientes
 * @param - string com cnpj ou razão social do cliente desejado
 * @param - string com o tipo de dado que será pesquisado ($tipo = true -> cnpj ou $tipo = false -> razão social)
 * @param - string vazia que receberá as linhas para a tabela dinâmica de clientes
 * @param - objeto com uma conexão aberta
 */
function consultaDadosCadastraisDosClientes($pesquisa, $tipo, $tabela, $db)
{
  require '../../../app/helpers/diversas.php';

  if ($tipo) {

    $query =
      "SELECT DISTINCT
      	SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',lh_chat.additional_data)+ 29)),'\"',1) AS cnpj,
      	SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"contaContratoContato\"',lh_chat.additional_data)+ 38)),'\"',1) AS conta_contrato,
      	UPPER(SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"empresaContato\"',lh_chat.additional_data)+ 32)),'\"',1)) AS razao_social
      FROM lh_chat
      WHERE (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '2017-07-01' AND CURRENT_DATE())
      	AND (SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',lh_chat.additional_data)+ 29)),'\"',1) LIKE '$pesquisa%')
      ORDER BY razao_social";

  } else {

    $pesquisa = strtoupper(removeAcentos($pesquisa));

    $query =
      "SELECT DISTINCT
      	SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"cnpjEmpresa\"',lh_chat.additional_data)+ 29)),'\"',1) AS cnpj,
      	SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"contaContratoContato\"',lh_chat.additional_data)+ 38)),'\"',1) AS conta_contrato,
      	UPPER(SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"empresaContato\"',lh_chat.additional_data)+ 32)),'\"',1)) AS razao_social
      FROM lh_chat
      WHERE (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '2017-07-01' AND CURRENT_DATE())
      	AND (SUBSTRING_INDEX(SUBSTR(lh_chat.additional_data,(LOCATE('\"key\":\"empresaContato\"',lh_chat.additional_data)+ 32)),'\"',1) LIKE '%$pesquisa%')
      ORDER BY razao_social";

  }

  if ($resultado = $db->query($query)) {

    $tabela .=
      "<table class='table' id='tabela'>
        <thead>
          <tr>
            <th class='text-center'>CNPJ</th>
            <th class='text-center'>Conta Contrato</th>
            <th class='text-center'>Razão Social</th>
            <th class='text-center'>Selecione</th>
          </tr>
        </thead>

        <tbody>";

    $linhas = '';

    while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

      $linhas .=
        "<tr>
          <td class='text-center' data-cnpj='{$registro['cnpj']}'>{$registro['cnpj']}</td>
          <td class='text-center' data-conta='{$registro['conta_contrato']}'>{$registro['conta_contrato']}</td>
          <td class='text-left'   data-razao='{$registro['razao_social']}'>{$registro['razao_social']}</td>
          <td class='text-right'>
            <button class='btn btn-xs btn-default btn-block' type='button'>
              <span class='glyphicon glyphicon-ok'></span>
            </button>
          </td>
        </tr>";

    }

    $tabela .= $linhas;
    $tabela .=
      "</tbody>
    </table>";

  } else {

    # erro durante a execução da consulta
    echo 'erro';

  }

  $db->close();

  return $tabela;
}

/**
 * verifica se o novo código de ticket gerado já existe no banco de dados, caso exista, gera um novo código de ticket
 * @param - string com o código de ticket gerado pelo módulo de ticket
 * @param - objeto com uma conexão aberta
 */
function verificaTicketDuplicado($ticket, $db)
{
  $query =
    "SELECT
    	id
    FROM av_tickets
    WHERE ticket = $ticket;";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    # verificando se o código de ticket gerado já existe no banco de dados
    if ($resultado->num_rows > 0) {

      $ticket = NULL;

      # gerando novo código de ticket
      $ticket = geraTicket();

      # chamando a função novamente para confirmar se o novo código gerado também não existe no banco de dados
      verificaTicketDuplicado($ticket, $db);

    }

  }

  return $ticket;

}

/**
 * insere os dados do formulário da tela de novo ticket no banco de dados
 * @param - array com os dados do formulário da tela de novo ticket
 * @param - objeto com uma conexão aberta
 */
function insereDadosDoFormularioNovoTicket($dados, $db)
{
  require DIRETORIO_MODELS . 'sessao.php';

  # chamando função que verifica se o código de ticket gerado já existe no banco de dados
  $dados['ticket'] = verificaTicketDuplicado($dados['ticket'], $db);

  $colunas = NULL;
  $valores = NULL;

  # montando colunas e valores para a consulta
  foreach ($dados as $chave => $valor) {

    $colunas .= trim($chave, "'") . ", ";
    $valores .= "'$valor', ";

  }

  # retirando a últimas vírgula das colunas e dos valores
  $colunas = rtrim($colunas, ', ');
  $valores = rtrim($valores, ', ');

  # montando consulta
  $query = "INSERT INTO av_tickets " . "($colunas)" . " VALUES " . "($valores);";

  if ($resultado = $db->query($query)) {

    $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Tudo Certo!</strong> O Ticket foi gerado com sucesso.</p>';
    $_SESSION['mensagens']['tipo']     = 'success';
    $_SESSION['mensagens']['exibe']    = true;

    $_SESSION['ticket'] = $dados['ticket'];

  } else {

    $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Ops!</strong> O Ticket não foi gerado.</p>';
    $_SESSION['mensagens']['tipo']     = 'danger';
    $_SESSION['mensagens']['exibe']    = true;

  }

  $db->close();

}
