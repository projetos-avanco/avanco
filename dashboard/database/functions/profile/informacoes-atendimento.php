<?php

/**
 * retorna as informações dos atendimentos do colaborador
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo de colaborador
 * @param - array com a data inicial e data final de um período ou específica
 */
function retornaInformacoesDosAtendimentosDoColaborador($conexao, $colaborador, $datas)
{
  $sql =
    "SELECT
    	id,
    	name,
    	surname
    FROM lh_users
    WHERE username = '$usuario'";

  $resultado = mysqli_query($conexao, $sql);

  while ($registro = mysqli_fetch_assoc($resultado)) {

    $colaborador['informacoes_pessoais']['id']        = $registro['id'];
    $colaborador['informacoes_pessoais']['nome']      = $registro['name'];
    $colaborador['informacoes_pessoais']['sobrenome'] = $registro['surname'];

  }

  return $colaborador;
}
