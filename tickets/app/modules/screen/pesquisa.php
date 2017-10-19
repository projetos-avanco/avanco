<?php

require '../../../init.php';

require DIRETORIO_FUNCTIONS . '/screen/instrucoes.php';

/**
 * responsável por criar as linhas da tabela dinâmica de clientes
 * @param - string com o cnpj ou razão social do cliente desejado
 */
function criaLinhasParaTabelaDinamicaDeClientes($pesquisa)
{
  $db = abre_conexao();
  
  $linhas = '';

  # verificando se está sendo pesquisado um cnpj ou uma razão social ($tipo = true -> cnpj ou $tipo = false -> razão social)
  $tipo = is_numeric($pesquisa);

  # chamando função que consulta os atendimentos do chat e retorna as linhas da tabela dinâmica de clientes para o formulário de novo ticket
  $linhas = consultaDadosCadastraisDosClientes($pesquisa, $tipo, $linhas, $db);

  echo $linhas;
}
