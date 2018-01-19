<?php

/**
 * cria uma tabela de extrato com os totais das ações do colaborador
 * @param - array com os valores totais das ações diárias, mensais e esporádicas
 */
function criaTabelaDeTotais($valoresTotaisDasAcoes, $nivel, $nome = null, $sobrenome = null)
{
  $tabela = '';
  $linhas = '';

  # verificando se a tabela foi solicitada por um usuário nível 1 ou 2
  if ($nivel == 1) {

    $tabela .=
      "<br><h4 class='text-left'>Resumo de Atividades</h4><br>
      <table class='table'>
        <thead>
          <tr>
            <th class='text-left' width='45%'>Total em Atividades Diárias</th>
            <th class='text-left' width='35%'>Total em Atividades Mensais</th>
            <th class='text-left' width='20%'>Total em Atividades Esporádicas</th>
          </tr>
        </thead>

        <tbody>";

  } else {

    $tabela .=
      "<br><h4 class='text-left'>Resumo de Atividades da {$nome} {$sobrenome}</h4><br>
      <table class='table'>
        <thead>
          <tr>
            <th class='text-left' width='45%'>Total em Atividades Diárias</th>
            <th class='text-left' width='35%'>Total em Atividades Mensais</th>
            <th class='text-left' width='20%'>Total em Atividades Esporádicas</th>
          </tr>
        </thead>

        <tbody>";

  }

  $linhas .=
    "<tr>
      <td class='text-left'>{$valoresTotaisDasAcoes['acoes_diarias']}</td>
      <td class='text-left'>{$valoresTotaisDasAcoes['acoes_mensais']}</td>
      <td class='text-left'>{$valoresTotaisDasAcoes['acoes_esporadicas']}</td>
    </tr>";

  $total =
    $valoresTotaisDasAcoes['acoes_diarias'] +
    $valoresTotaisDasAcoes['acoes_mensais'] +
    $valoresTotaisDasAcoes['acoes_esporadicas'];

  $linhas .=
      "<tr>
        <td class='text-left destaque' width='15%'>Total em Moedas</td>
        <td class='text-left' width='10%'>{$total} Moedas</td>
        <td class='text-left'></td>
      </tr>";

  $tabela .= $linhas;

  $tabela .=
    "</tbody>
  </table>";

  return $tabela;

}

/**
 * cria uma tabela de extrato com o detalhamento e o total das ações diárias do colaborador
 * @param - array com as ações diárias do colaborador
 */
function criaTabelaDeAcoesDiarias($acoesDiarias, $valorTotalAcao)
{
  $tabela = '';
  $linhas = '';

  $tabela .=
    "<br><h4 class='text-left'>Atividades Diárias</h4><br>
    <table class='table'>
    <thead>
        <tr>
        <th class='text-left' width='10%'>Data</th>
        <th class='text-left' width='5%'>Horário</th>
        <th class='text-left' width='10%'>Chat</th>
        <th class='text-left' width='60%'>Atividade</th>
        <th class='text-left' width='15%'>Valor</th>
        </tr>
    </thead>

    <tbody>";

  foreach ($acoesDiarias as $acaoDiaria) {

    $linhas .=
      "<tr>
        <td class='text-left'>{$acaoDiaria['data_acao']}</td>
        <td class='text-left'>{$acaoDiaria['horario_acao']}</td>
        <td class='text-left'>{$acaoDiaria['id_chat']}</td>
        <td class='text-left'>{$acaoDiaria['descricao']}</td>
        <td class='text-left'>{$acaoDiaria['valor']}</td>
      </tr>";

  }

  $linhas .=
      "<tr>
        <td class='text-left destaque' width='15%'>Total em Atividades Diárias</td>
        <td class='text-left' width='10%'>{$valorTotalAcao} Moedas</td>
        <td class='text-left'></td>
        <td class='text-left'></td>        
        <td class='text-left'></td>        
      </tr>";

  $tabela .= $linhas;

  $tabela .=
    "</tbody>
  </table>";

  return $tabela;

}

/**
 * cria uma tabela de extrato com o detalhamento e o total das ações mensais do colaborador
 * @param - array com as ações mensais do colaborador
 */
function criaTabelaDeAcoesMensais($acoesMensais, $valorTotalAcao)
{
  $tabela = '';
  $linhas = '';

  $tabela .=
    "<br><h4 class='text-left'>Atividades Mensais</h4><br>
    <table class='table'>
      <thead>
        <tr>
          <th class='text-left' width='10%'>Data</th>
          <th class='text-left' width='5%'>Horário</th>
          <th class='text-left' width='70%'>Atividade</th>
          <th class='text-left' width='15%'>Valor</th>
        </tr>
      </thead>

      <tbody>";

  foreach ($acoesMensais as $acaoMensal) {

    $linhas .=
      "<tr>
        <td class='text-left'>{$acaoMensal['data_acao']}</td>
        <td class='text-left'>{$acaoMensal['horario_acao']}</td>
        <td class='text-left'>{$acaoMensal['descricao']}</td>
        <td class='text-left'>{$acaoMensal['valor']}</td>
      </tr>";

  }

  $linhas .=
      "<tr>
        <td class='text-left destaque' width='15%'>Total em Atividades Mensais</td>
        <td class='text-left' width='10%'>{$valorTotalAcao} Moedas</td>
        <td class='text-left'></td>
        <td class='text-left'></td>
      </tr>";

  $tabela .= $linhas;

  $tabela .=
    "</tbody>
  </table>";

  return $tabela;

}

/**
 * cria uma tabela de extrato com o detalhamento e o total das ações esporádicas do colaborador
 * @param - array com as ações esporádicas do colaborador
 */
function criaTabelaDeAcoesEsporadicas($acoesEsporadicas, $valorTotalAcao)
{
  $tabela = '';
  $linhas = '';

  $tabela .=
    "<br><h4 class='text-left'>Atividades Esporádicas</h4><br>
    <table class='table'>
      <thead>
        <tr>
          <th class='text-left' width='10%'>Data</th>
          <th class='text-left' width='5%'>Horário</th>
          <th class='text-left' width='10%'>Supervisor</th>
          <th class='text-left' width='10%'>Lançamento</th>
          <th class='text-left' width='25%'>Observação</th>
          <th class='text-left' width='25%'>Atividade</th>
          <th class='text-left' width='15%'>Valor</th>
        </tr>
      </thead>

      <tbody>";

  foreach ($acoesEsporadicas as $acaoEsporadica) {

    $linhas .=
      "<tr>
        <td class='text-left esporadica'>{$acaoEsporadica['data_acao']}</td>
        <td class='text-left esporadica'>{$acaoEsporadica['horario_acao']}</td>
        <td class='text-left esporadica'>{$acaoEsporadica['supervisor']}</td>
        <td class='text-left esporadica'>{$acaoEsporadica['data_registro']}</td>
        <td class='text-left esporadica'>{$acaoEsporadica['observacao']}</td>
        <td class='text-left esporadica'>{$acaoEsporadica['descricao']}</td>
        <td class='text-left esporadica'>{$acaoEsporadica['valor']}</td>
      </tr>";

  }

  $linhas .=
      "<tr>
        <td class='text-left destaque' width='15%'>Total em Atividades Esporádicas</td>
        <td class='text-left' width='10%'>{$valorTotalAcao} Moedas</td>
        <td class='text-left'></td>
        <td class='text-left'></td>
        <td class='text-left'></td>
        <td class='text-left'></td>
        <td class='text-left'></td>
      </tr>";

  $tabela .= $linhas;

  $tabela .=
    "</tbody>
  </table>";

  return $tabela;

}
