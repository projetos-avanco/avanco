<?php 

/**
 * cria uma tabela de extrato com os totais das ações do colaborador
 * @param - array com os valores totais das ações diárias, mensais e esporádicas
 */
function criaTabelaDeTotais($valoresTotaisDasAcoes)
{
  $tabela = '';
  $linhas = '';

  $tabela .=
    "<h4>Resumo de Atividades</h4>
    <br>
    <table class='table'>
      <thead>
        <tr>
          <th class='text-center'>Total em Atividades Diárias</th>          
          <th class='text-center'>Total em Atividades Mensais</th>
          <th class='text-center'>Total em Atividades Esporádicas</th>
        </tr>
      </thead>

      <tbody>";

  $linhas .=
    "<tr>
      <td class='text-center' width='33.33%'>{$valoresTotaisDasAcoes['acoes_diarias']}</td>
      <td class='text-center' width='33.33%'>{$valoresTotaisDasAcoes['acoes_mensais']}</td>
      <td class='text-center' width='33.33%'>{$valoresTotaisDasAcoes['acoes_esporadicas']}</td>        
    </tr>";

  $total = 
    $valoresTotaisDasAcoes['acoes_diarias'] + 
    $valoresTotaisDasAcoes['acoes_mensais'] + 
    $valoresTotaisDasAcoes['acoes_esporadicas'];

  $linhas .=
      "<tr>        
        <td class='text-left destaque' width='20%'>Total em Moedas</td>
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
    "<h4 class='text-left'>Atividades Diárias</h4>
    <br>
    <table class='table'>
    <thead>
        <tr>
        <th class='text-left'>Data</th>
        <th class='text-left'>Horário</th>
        <th class='text-left'>Chat</th>
        <th class='text-left'>Atividade</th>
        <th class='text-left'>Valor</th>
        </tr>
    </thead>

    <tbody>";

  foreach ($acoesDiarias as $acaoDiaria) {

    $linhas .=
      "<tr>
        <td class='text-left' width='10%'>{$acaoDiaria['data_acao']}</td>
        <td class='text-left' width='10%'>{$acaoDiaria['horario_acao']}</td>
        <td class='text-left' width='10%'>{$acaoDiaria['id_chat']}</td>
        <td class='text-left' width='20%'>{$acaoDiaria['descricao']}</td>
        <td class='text-left' width='10%'>{$acaoDiaria['valor']}</td>
      </tr>";

  }

  $linhas .=
      "<tr>        
        <td class='text-left destaque' width='20%'>Total em Atividades Diárias</td>
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
    "<h4 class='text-left'>Atividades Mensais</h4>
    <br>
    <table class='table'>
      <thead>
        <tr>
          <th class='text-left'>Data</th>
          <th class='text-left'>Horário</th>          
          <th class='text-left'>Atividade</th>
          <th class='text-left'>Valor</th>
        </tr>
      </thead>

      <tbody>";

  foreach ($acoesMensais as $acaoMensal) {

    $linhas .=
      "<tr>
        <td class='text-left' width='10%'>{$acaoMensal['data_acao']}</td>
        <td class='text-left' width='10%'>{$acaoMensal['horario_acao']}</td>        
        <td class='text-left' width='20%'>{$acaoMensal['descricao']}</td>
        <td class='text-left' width='10%'>{$acaoMensal['valor']}</td>
      </tr>";

  }

  $linhas .=
      "<tr>        
        <td class='text-left destaque' width='20%'>Total em Atividades Mensais</td>
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
    "<h4 class='text-left'>Atividades Esporádicas</h4>
    <br>
    <table class='table'>
      <thead>
        <tr>
          <th class='text-left'>Data</th>
          <th class='text-left'>Horário</th>          
          <th class='text-left'>Supervisor</th>
          <th class='text-left'>Lançamento</th>
          <th class='text-left'>Observação</th>
          <th class='text-left'>Atividade</th>
          <th class='text-left'>Valor</th>
        </tr>
      </thead>

      <tbody>";

  foreach ($acoesEsporadicas as $acaoEsporadica) {

    $linhas .=
      "<tr>
        <td class='text-left' width='10%'>{$acaoEsporadica['data_acao']}</td>
        <td class='text-left' width='10%'>{$acaoEsporadica['horario_acao']}</td>        
        <td class='text-left' width='10%'>{$acaoEsporadica['supervisor']}</td>
        <td class='text-left' width='10%'>{$acaoEsporadica['data_registro']}</td>
        <td class='text-left' width='15%'>{$acaoEsporadica['observacao']}</td>
        <td class='text-left' width='20%'>{$acaoEsporadica['descricao']}</td>
        <td class='text-left' width='10%'>{$acaoEsporadica['valor']}</td>
      </tr>";

  }

  $linhas .=
      "<tr>        
        <td class='text-left destaque' width='20%'>Total em Atividades Esporádicas</td>
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