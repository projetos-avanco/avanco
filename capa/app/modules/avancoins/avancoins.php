<?php

/**
 * responsável por gravar uma nova atividade esporádica na tabela de ações esporádicas
 * @param - array com os dados do formulário de nova atividade
 */
function gravaNovaAtividadeEsporadica($form)
{
  require DIRETORIO_FUNCTIONS . 'avancoins/atividades.php';

  # abrindo conexão com a base de dados
  $db = abre_conexao();

  # chamando função que insere uma nova atividade na tabela de ações esporádicas
  $resultado = insereNovaAtividadeEsporadica($db, $form);

  # verificando se a consulta foi executada
  if ($resultado == true) {

    # gerando mensagem de sucesso
    $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Tudo Certo!</strong> A atividade foi cadastrada com sucesso.</p>';
    $_SESSION['mensagens']['tipo']     = 'success';
    $_SESSION['mensagens']['exibe']    = true;

  } else {

    # gerando mensagem de erro
    $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Ops!</strong> A atividade não foi cadastrada! Houve erro de SQL.</p>';
    $_SESSION['mensagens']['tipo']     = 'danger';
    $_SESSION['mensagens']['exibe']    = true;

  }

  fecha_conexao($db);

  # redirecionando usuário para página de nova atividade
  header ('Location: ' . BASE_URL . '../capa/public/views/avancoins/nova_atividade.php');

}

/**
 * responsável por gerar o extrato avancoins (simples ou detalhado)
 * @param - array com os dados do formulário de nova atividade
 */
function geraExtratoAvancoins($form)
{
  require DIRETORIO_FUNCTIONS . 'avancoins/relatorio_simplificado.php';
  require DIRETORIO_FUNCTIONS . 'avancoins/relatorio_detalhado.php';
  require DIRETORIO_MODELS    . 'sessao.php';

  $acoesDiarias     = array();
  $acoesMensais     = array();
  $acoesEsporadicas = array();

  $valoresTotaisDasAcoes = array(
    'acoes_diarias'     => 0,
    'acoes_mensais'     => 0,
    'acoes_esporadicas' => 0
  );

  $tabela = '';
  $linhas = '';

  # abrindo conexão com a base de dados
  $db = abre_conexao();

  # verificando se o usuário solicitou um relatório simples ou detalhado (1 - Simples 2 - Detalhado)
  if ($form['tipo'] == 1) {

    # gera um extrato avancoins simples
    geraExtratoAvancoinsSimples($db, $form, $acoesDiarias, $acoesMensais, $acoesEsporadicas);

  } elseif ($form['tipo'] == 2) {

    # chamando funções que geram extratos das ações registradas nas tabelas de logs
    $acoesDiarias     = geraExtratoDeAcoesDiariasDetalhado($db, $form);
    $acoesMensais     = geraExtratoDeAcoesMensaisDetalhado($db, $form);
    $acoesEsporadicas = geraExtratoDeAcoesEsporadicasDetalhado($db, $form);

    # chamando função que soma os valores das ações registradas nas tabelas de logs
    $valoresTotaisDasAcoes['acoes_diarias']     = somaValoresDasAcoes($acoesDiarias);
    $valoresTotaisDasAcoes['acoes_mensais']     = somaValoresDasAcoes($acoesMensais);
    $valoresTotaisDasAcoes['acoes_esporadicas'] = somaValoresDasAcoes($acoesEsporadicas);

    $tabela .=
      "<table class='table'>
        <thead>
          <tr>
            <th class='text-center'>data_acao</th>
            <th class='text-center'>horario_acao</th>
            <th class='text-center'>id_chat</th>
            <th class='text-center'>descricao</th>
            <th class='text-center'>valor</th>
          </tr>
        </thead>

        <tbody>";

    foreach ($acoesDiarias as $acaoDiaria) {

      $linhas .=
        "<tr>
          <td class='text-center' width='10%'>{$acaoDiaria['data_acao']}</td>
          <td class='text-center'>{$acaoDiaria['horario_acao']}</td>
          <td class='text-center'>{$acaoDiaria['id_chat']}</td>
          <td class='text-center' width='20%'>{$acaoDiaria['descricao']}</td>
          <td class='text-center'>{$acaoDiaria['valor']}</td>
        </tr>";

    }

    $tabela .= $linhas;

    $tabela .=
      "</tbody>
    </table>";

    criaModeloDeSessaoParaAvancoins();

    gravaModeloDeSessaoAvancoins($tabela);

  }

  fecha_conexao($db);

  header('Location: ' . BASE_URL . 'public/views/avancoins/extrato.php');

}
