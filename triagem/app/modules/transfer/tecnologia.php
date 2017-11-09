<?php

/*
 * responsável por chamar outras funções que consultam informações na base de dados do chat e redireciona o cliente
 */
function consultaChatTecnologia()
{
  # recuperando os dados do cliente que chamou no portal avanço
  $cliente = $_SESSION['cliente'];

  # indicando que o cliente não utiliza o novo ERP
  $cliente['novo_erp'] = '0';
  
  # chamando função que monta uma URL e redireciona o cliente para o departamento de tecnologia
  redirecionaClienteParaDepartamentoTecnologia($cliente);

  # eliminando array
  unset($cliente);
}
