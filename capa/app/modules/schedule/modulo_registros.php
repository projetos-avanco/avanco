<?php

/**
 * responsável por solicitar a atualização de um registro
 * @param - array com os dados de um registro
 * @param - string com o tipo do registro
 */
function solicitaAtualizacaoDeRegistro($dados, $tipo)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/records/atualizacoes_registros.php';  

  $db = abre_conexao();

  $_SESSION['atividades']['exibe'] = true;

  switch ($tipo) {
    case 'folgas':
      $resultado = atualizaDadosDoRegistroDeFolga($db, $dados);

      if (!$resultado) {
        $_SESSION['atividades']['tipo'] = 'danger';
        $_SESSION['atividades']['mensagens'][] = 'Não foi possível editar o registro. Informe ao Wellington Felix.';
      } else {
        $_SESSION['atividades']['tipo'] = 'success';
        $_SESSION['atividades']['mensagens'][] = 'Registro editado com sucesso!';
      }

      header('location: ' . BASE_URL . 'public/views/schedule/edita_folgas.php?id=' . $dados['id']);
        break;

    case 'faltas':
      $resultado = atualizaDadosDoRegistroDeFalta($db, $dados);

      if (!$resultado) {
        $_SESSION['atividades']['tipo'] = 'danger';
        $_SESSION['atividades']['mensagens'][] = 'Não foi possível editar o registro. Informe ao Wellington Felix.';
      } else {
        $_SESSION['atividades']['tipo'] = 'success';
        $_SESSION['atividades']['mensagens'][] = 'Registro editado com sucesso!';
      }

      header('location: ' . BASE_URL . 'public/views/schedule/edita_faltas.php?id=' . $dados['id']);
        break;

    case 'atrasos':
      $resultado = atualizaDadosDoRegistroDeAtraso($db, $dados);

      if (!$resultado) {
        $_SESSION['atividades']['tipo'] = 'danger';
        $_SESSION['atividades']['mensagens'][] = 'Não foi possível editar o registro. Informe ao Wellington Felix.';
      } else {
        $_SESSION['atividades']['tipo'] = 'success';
        $_SESSION['atividades']['mensagens'][] = 'Registro editado com sucesso!';
      }

      header('location: ' . BASE_URL . 'public/views/schedule/edita_atrasos.php?id=' . $dados['id']);
        break;

    case 'extras':
      $resultado = atualizaDadosDoRegistroDeExtra($db, $dados);

      if (!$resultado) {
        $_SESSION['atividades']['tipo'] = 'danger';
        $_SESSION['atividades']['mensagens'][] = 'Não foi possível editar o registro. Informe ao Wellington Felix.';
      } else {
        $_SESSION['atividades']['tipo'] = 'success';
        $_SESSION['atividades']['mensagens'][] = 'Registro editado com sucesso!';
      }

      header('location: ' . BASE_URL . 'public/views/schedule/edita_extras.php?id=' . $dados['id']);
        break;
  }  
}

/**
 * responsável por consultar e retornar os dados do registro de folgas
 * @param - inteiro com o id da folga
 */
function retornaDadosDoRegistroDeFolga($id)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/records/consultas_registros.php';

  $db = abre_conexao();
  
  $dados = array();
  $dados = consultaDadosDoRegistroDeFolga($db, $id);

  return $dados;
}

/**
 * responsável por consultar e retornar os dados do registro de faltas
 * @param - inteiro com o id da falta
 */
function retornaDadosDoRegistroDeFalta($id)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/records/consultas_registros.php';

  $db = abre_conexao();
  
  $dados = array();
  $dados = consultaDadosDoRegistroDeFalta($db, $id);

  return $dados;
}

/**
 * responsável por consultar e retornar os dados do registro de atrasos
 * @param - inteiro com o id da atraso
 */
function retornaDadosDoRegistroDeAtraso($id)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/records/consultas_registros.php';

  $db = abre_conexao();
  
  $dados = array();
  $dados = consultaDadosDoRegistroDeAtraso($db, $id);

  return $dados;
}

/**
 * responsável por consultar e retornar os dados do registro de extras
 * @param - inteiro com o id da extra
 */
function retornaDadosDoRegistroDeExtra($id)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/records/consultas_registros.php';

  $db = abre_conexao();
  
  $dados = array();
  $dados = consultaDadosDoRegistroDeExtra($db, $id);

  return $dados;
}

/**
 * responsável por solicitar a deleção de um registro de folgas
 * @param - inteiro com o id da folga
 */
function solicitaDelecaoDeRegistroDeFolga($id)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/records/delecoes_registros.php';

  $db = abre_conexao();

  $resultado = deletaRegistroDeFolga($db, $id);

  if (!$resultado) {
    echo json_encode('Não foi possível deletar o registro. Informe ao Wellington Felix');
  } else {
    echo json_encode('Registro deletado com sucesso!');    
  }

  exit;
}

/**
 * responsável por solicitar a deleção de um registro de faltas
 * @param - inteiro com o id da falta
 */
function solicitaDelecaoDeRegistroDeFalta($id)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/records/delecoes_registros.php';

  $db = abre_conexao();

  $resultado = deletaRegistroDeFalta($db, $id);

  if (!$resultado) {
    echo json_encode('Não foi possível deletar o registro. Informe ao Wellington Felix');
  } else {
    echo json_encode('Registro deletado com sucesso!');    
  }

  exit;
}

/**
 * responsável por solicitar a deleção de um registro de atrasos
 * @param - inteiro com o id da atraso
 */
function solicitaDelecaoDeRegistroDeAtraso($id)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/records/delecoes_registros.php';

  $db = abre_conexao();

  $resultado = deletaRegistroDeAtraso($db, $id);

  if (!$resultado) {
    echo json_encode('Não foi possível deletar o registro. Informe ao Wellington Felix');
  } else {
    echo json_encode('Registro deletado com sucesso!');    
  }

  exit;
}

/**
 * responsável por solicitar a deleção de um registro de extras
 * @param - inteiro com o id da extra
 */
function solicitaDelecaoDeRegistroDeExtra($id)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/records/delecoes_registros.php';

  $db = abre_conexao();

  $resultado = deletaRegistroDeExtra($db, $id);

  if (!$resultado) {
    echo json_encode('Não foi possível deletar o registro. Informe ao Wellington Felix');
  } else {
    echo json_encode('Registro deletado com sucesso!');    
  }

  exit;
}

/**
 * responsável por receber e solicitar a inserção do dados de um registro de folgas
 * @param - array com os dados de um registro de folgas
 */
function recebeRegistroDeFolgas($folgas)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/records/insercoes_registros.php';

  $db = abre_conexao();

  $resultado = insereRegistroDeFolgas($db, $folgas);

  # abrindo sessão de validação
  $_SESSION['atividades'] = array(
    'tipo'      => null,
    'exibe'     => true,
    'mensagens' => null
  );

  $_SESSION['registro'] = $folgas['registro'];

  # verificando se o registro de extras não foi inserido
  if (empty($resultado)) {
    $_SESSION['atividades']['tipo'] = 'danger';
    $_SESSION['atividades']['mensagens'] = 'Erro ao inserir o registro. Informe ao Wellington Felix.';
  } else {
    $_SESSION['atividades']['tipo'] = 'success';
    $_SESSION['atividades']['mensagens'] = 'Registro gerado com sucesso.';
  }

  header('location: ' . BASE_URL . 'public/views/schedule/folgas.php');

  exit;
}

/**
 * responsável por receber e solicitar a inserção do dados de um registro de faltas
 * @param - array com os dados de um registro de faltas
 */
function recebeRegistroDeFaltas($faltas)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/records/insercoes_registros.php';

  $db = abre_conexao();

  $resultado = insereRegistroDeFaltas($db, $faltas);

  # abrindo sessão de validação
  $_SESSION['atividades'] = array(
    'tipo'      => null,
    'exibe'     => true,
    'mensagens' => null
  );

  $_SESSION['registro'] = $faltas['registro'];

  # verificando se o registro de extras não foi inserido
  if (empty($resultado)) {
    $_SESSION['atividades']['tipo'] = 'danger';
    $_SESSION['atividades']['mensagens'] = 'Erro ao inserir o registro. Informe ao Wellington Felix.';
  } else {
    $_SESSION['atividades']['tipo'] = 'success';
    $_SESSION['atividades']['mensagens'] = 'Registro gerado com sucesso.';
  }

  header('location: ' . BASE_URL . 'public/views/schedule/faltas.php');

  exit;
}

/**
 * responsável por receber e solicitar a inserção do dados de um registro de atrasos
 * @param - array com os dados de um registro de atrasos
 */
function recebeRegistroDeAtrasos($atrasos)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/records/insercoes_registros.php';

  $db = abre_conexao();

  $resultado = insereRegistroDeAtrasos($db, $atrasos);

  # abrindo sessão de validação
  $_SESSION['atividades'] = array(
    'tipo'      => null,
    'exibe'     => true,
    'mensagens' => null
  );

  $_SESSION['registro'] = $atrasos['registro'];

  # verificando se o registro de extras não foi inserido
  if (empty($resultado)) {
    $_SESSION['atividades']['tipo'] = 'danger';
    $_SESSION['atividades']['mensagens'] = 'Erro ao inserir o registro. Informe ao Wellington Felix.';
  } else {
    $_SESSION['atividades']['tipo'] = 'success';
    $_SESSION['atividades']['mensagens'] = 'Registro gerado com sucesso.';
  }

  header('location: ' . BASE_URL . 'public/views/schedule/atrasos.php');

  exit;
}

/**
 * responsável por receber e solicitar a inserção do dados de um registro de extras
 * @param - array com os dados de um registro de extras
 */
function recebeRegistroDeExtras($extras)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/records/insercoes_registros.php';

  $db = abre_conexao();

  $resultado = insereRegistroDeExtras($db, $extras);

  # abrindo sessão de validação
  $_SESSION['atividades'] = array(
    'tipo'      => null,
    'exibe'     => true,
    'mensagens' => null
  );

  $_SESSION['registro'] = $extras['registro'];

  # verificando se o registro de extras não foi inserido
  if (empty($resultado)) {
    $_SESSION['atividades']['tipo'] = 'danger';
    $_SESSION['atividades']['mensagens'] = 'Erro ao inserir o registro. Informe ao Wellington Felix.';
  } else {
    $_SESSION['atividades']['tipo'] = 'success';
    $_SESSION['atividades']['mensagens'] = 'Registro gerado com sucesso.';
  }

  header('location: ' . BASE_URL . 'public/views/schedule/extras.php');

  exit;
}
