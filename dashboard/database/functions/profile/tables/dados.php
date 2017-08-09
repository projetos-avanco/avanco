<?php

require ABS_PATH . 'app/helpers/query.php';

/**
 * analisa se os dados do colaborador serão inseridos ou atualizados na tabela
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function analisaDadosDoColaborador($objeto, $modelo)
{
  # verificando se foi informado um nome de usuário existente no chat, no momento da requisição da página (?usuario=nome-sobrenome)
  if ($modelo['pessoal']['id'] != 0) {

    # instrução que verifica se existe ou não um registro do usuário na tabela (0 - insere || 1 - atualiza)
    $query =
      "SELECT
      	nome
      FROM av_dashboard_colaborador
      WHERE id = {$modelo['pessoal']['id']}";

    $resultado = mysqli_query($objeto, $query);

    # verificando se os dados do usuário serão inseridos ou atualizados na tabela
    if ($resultado->num_rows == 0) {

      # chamando função que retira do array modelo de colaborador as colunas e os valores e retorna a query de INSERT
      $query = criaQueryDeColaborador($modelo, $resultado->num_rows);

    } else {

      # chamando função que retira do array modelo de colaborador as colunas e os valores e retorna a query de UPDATE
      $query = criaQueryDeColaborador($modelo, $resultado->num_rows);

    }

    # emitindo instrução (query) na base de dados (INSERT ou UPDATE)
    $resultado = mysqli_query($objeto, $query);

    # verificando se a emissão da instrução foi realizada
    if ($resultado) {

      # emissão realizada, criando sessão com o id do colaborador que requisitou a página
      $_SESSION['colaborador'] = array(
        'id'       => $modelo['pessoal']['id'],
        'tipo'     => '1',
        'mensagem' => 'query executada!'
      );

    } else {

      # emissão não realizada, criando sessão com o id 0
      $_SESSION['colaborador'] = array(
        'id'       => '0',
        'tipo'     => '2',
        'mensagem' => 'query não executada!'
      );

    }

  } else {

    # usuário não existente no chat, criando sessão com id 0
    $_SESSION['colaborador'] = array(
      'id'       => '0',
      'tipo'     => '3',
      'mensagem' => 'usuário não existente na base de dados do chat!'
    );

  }

  # eliminando array modelo do colaborador
  unset($modelo);

  # fechando conexao com a base de dados
  fecha_conexao($objeto);
}
