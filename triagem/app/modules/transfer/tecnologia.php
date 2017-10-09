<?php

/*
 * responsável por chamar outras funções que consultam informações na base de dados do chat e redireciona o cliente
 */
function consultaChatTecnologia()
{
  # recuperando os dados do cliente que chamou no portal avanço
  $cliente = $_SESSION['cliente'];

  # chamando função que monta uma URL e redireciona o cliente para o departamento de tecnologia
  redirecionaClienteParaDepartamentoTecnologia($cliente);
}
