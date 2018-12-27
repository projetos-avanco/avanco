<?php

# verificando se houve requisição via método post
if (isset($_POST['submit']) && $_POST['submit'] == 'submit') {
  # requisitando script de configurações
  require_once '../../../../../init.php';
  
  # definindo array que será gravado em tabela
  $externo = array(
    'id'           => 0,
    'tipo'         => null,
    'supervisor'   => null,
    'colaborador'  => null,
    'status'       => null,
    'data_inicial' => null,
    'data_final'   => null,
    'horario'      => null,
    'produto'      => null,
    'modulo'       => null,
    'observacao'   => null,
    'faturado'     => null,
    'valor_hora'   => 0.0,
    'valor_pacote' => 0.0,
    'despesa'      => null,
    'registrado'   => null
  );

  $copia = array();

  $flag = false;

  $erros = array();

  /**
   * -------------------------------------
   * validando dados do atendimento externo
   * -------------------------------------
   */

  # verificando se o id do atendimento externo foi enviado
  if (!empty($_POST['externo']['id'])) {
    # verificando se o id do atendimento externo é uma string numérica
    if (is_numeric($_POST['externo']['id'])) {
      $externo['id'] = (int)$_POST['externo']['id'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do atendimento externo não está correto.';
    }   
  } else {
    $flag = true;
    $erros[] = 'O id do atendimento externo não foi enviado.';
  }

  # verificando se a situação do atendimento foi enviado
  if (!empty($_POST['externo']['situacao'])) {
    # verificando se o tipo de atendimento é uma string numérica
    if (is_numeric($_POST['externo']['situacao'])) {
      # verificando se a situação do atendimento não está confirmada
      if ($_POST['externo']['situacao'] == '1') {
        $externo['status'] = '1';
      } elseif ($_POST['externo']['situacao'] == '2') {
        $externo['status'] = '2';
      } else {
        $externo['status'] = '3';
      }
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados da situação do atendimento não está correto';
    }
  } else {
    $flag = true;
    $erros[] = 'A situção do atendimento não foi selecionado.';
  }

  # verificando se o tipo de atendimento foi enviado
  if (!empty($_POST['externo']['tipo-atendimento'])) {
    # verificando se o tipo de atendimento é uma string numérica
    if (is_numeric($_POST['externo']['tipo-atendimento'])) {
      $externo['tipo'] = $_POST['externo']['tipo-atendimento'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do tipo de atendimento não está correto';
    }
  } else {
    $flag = true;
    $erros[] = 'O tipo de atendimento não foi selecionado.';
  }

  # verificando se o id do supervisor foi enviado
  if (!empty($_POST['externo']['supervisor'])) {
    # verificando se o id do supervisor é uma string numérica
    if (is_numeric($_POST['externo']['supervisor'])) {
      $externo['supervisor'] = (int)$_POST['externo']['supervisor'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do id do supervisor não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'Não foi possível recuperar os dados do supervisor logado.';
  }

  # verificando se o id do colaborador foi enviado
  if (!empty($_POST['externo']['colaborador'])) {
    # verificando se o id do colaborador é uma string numérica
    if (is_numeric($_POST['externo']['colaborador'])) {
      $externo['colaborador'] = (int)$_POST['externo']['colaborador'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do id do colaborador não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'Nenhum colaborador foi selecionado.';
  }

  # verificando se a data inicial do atendimento foi enviada
  if (!empty($_POST['externo']['data-inicial'])) {
    # verificando se a data do atendimento é uma string
    if (is_string($_POST['externo']['data-inicial'])) {
      $externo['data_inicial'] = $_POST['externo']['data-inicial'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados da data inicial do atendimento não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'A data inicial do atendimento não foi informada.';
  }

  # verificando se a data final do atendimento foi enviada
  if (!empty($_POST['externo']['data-final'])) {
    # verificando se a data do atendimento é uma string
    if (is_string($_POST['externo']['data-final'])) {
      $externo['data_final'] = $_POST['externo']['data-final'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados da data final do atendimento não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'A data final do atendimento não foi informada.';
  }

  # verificando se o horário do atendimento foi enviado
  if (!empty($_POST['externo']['horario'])) {
    # verificando se o horário do atendimento é uma string
    if (is_string($_POST['externo']['horario'])) {
      $externo['horario'] = $_POST['externo']['horario'] . ':00';
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do horário do atendimento não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'O horário do atendimento não foi informado.';
  }

  # verificando se o código do produto foi enviado
  if (!empty($_POST['externo']['produto'])) {
    # verificando se o código do produto é uma string numérica
    if (is_numeric($_POST['externo']['produto'])) {
      $externo['produto'] = $_POST['externo']['produto'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do produto não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'Nenhum produto foi selecionado.';
  }

  # verificando se o código do módulo foi enviado
  if (!empty($_POST['externo']['modulo'])) {
    # verificando se o código do módulo é uma string numérica
    if (is_numeric($_POST['externo']['modulo'])) {
      $externo['modulo'] = $_POST['externo']['modulo'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do código do módulo não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'Nenhum módulo foi selecionado.';
  }

  # verificando se a observação foi enviada
  if (!empty($_POST['externo']['observacao'])) {
    # verificando se a observação é uma string
    if (is_string($_POST['externo']['observacao'])) {
      $externo['observacao'] = $_POST['externo']['observacao'];
      $externo['observacao'] = addslashes(mb_strtolower($externo['observacao'], 'utf-8'));
      $externo['observacao'] = trim(str_replace("\r\n", ' ', $externo['observacao']));
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados da observação não está correto.';
    }
  } else {
    $externo['observacao'] = '';
  }

  # verificando se o valor do campo faturado foi enviado
  if (!empty($_POST['externo']['faturado'])) {
    # verificando se o valor do campo faturado é uma string numérica
    if (is_numeric($_POST['externo']['faturado'])) {
      $externo['faturado'] = (int)$_POST['externo']['faturado'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do valor do campo faturado não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'Não foi informado se o atendimento é faturado ou não.';
  }

  # verificando se foi enviado algum arquivo em anexo
  if (isset($_FILES['externo']) && $_FILES['externo']['error']['anexo'] == 0) {          
    # verificando se o tamanho do arquivo em anexo é maior que 2MB
    if ($_FILES['externo']['size']['anexo'] > 2097152) {
      $flag = true;
      $erros['mensagens'][] = 'O arquivo em anexo deve ter o tamanho máximo de 2MB.';      
    }
  }

  # verificando se o valor do campo cobrança foi enviado
  if (isset($_POST['externo']['cobranca']) && (!empty($_POST['externo']['cobranca']))) {
    # verificando se o tipo de dados do valor do campo cobrança é uma string numérica
    if (is_numeric($_POST['externo']['cobranca'])) {
      $externo['cobranca'] = $_POST['externo']['cobranca'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados da cobrança não está correto.';
    }    
  }

  # verificando se o valor da cobrança foi enviado
  if (isset($_POST['externo']['valor']) && (!empty($_POST['externo']['valor']))) {
    # verificando se o tipo de dados do valor é uma string numérica e se a cobrança foi definida
    if (is_numeric($_POST['externo']['valor']) && isset($externo['cobranca'])) {
      # verificando se o pedido é faturado e se o valor é maior que 0
      if ($externo['faturado'] == 1 && $_POST['externo']['valor'] > '0.00') {
        $valor = $_POST['externo']['valor'];
      } else {
        $flag = true;
        $erros[] = 'Não foi informado o valor a ser cobrado.';
      }
    } else {
      $flag = true;
      $erros[] = 'Não foi informado se o pedido possui cobrança ou o tipo de dados do valor não está correto.';
    }
  }

  # verificando se o atendimento é faturado
  if ($externo['faturado'] == 1) {
    # verificando se a cobrança e o valor foram definidos
    if (isset($externo['cobranca']) && isset($valor)) {
      # verificando se a cobrança é por hora
      if ($externo['cobranca'] == '1') {
        $externo['valor_hora'] = (float)$valor;        
      } else {
        $externo['valor_pacote'] = (float)$valor;        
      }
    }
  } else {
    $externo['faturado'] = 0;
  }
  
  # verificando se o valor do campo despesa foi enviado
  if (!empty($_POST['externo']['despesa'])) {
    # verificando se o valor do campo despesa é uma string numérica
    if (is_numeric($_POST['externo']['despesa'])) {
      $externo['despesa'] = (int)$_POST['externo']['despesa'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do valor do campo despesa não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'Não foi informado se o atendimento possui despesas ou não.';
  }

  # verificando se não existe despesa, alterando o valor para 0
  if ($externo['despesa'] == 2) {
    $externo['despesa'] = 0;
  }

  $externo['registrado'] = date('Y-m-d H:i:s');
  
  /**
   * -----------------------------------
   * validando dados dos e-mails em cópia
   * -----------------------------------
   */

  # verificando se foram enviados os id's do contatos em cópia
  if (isset($_POST['copia']) && (!empty($_POST['copia']))) {    
    # recuperando os id's dos contatos em cópia
    for ($i = 0; $i < count($_POST['copia']); $i++) {
      array_push($copia, $_POST['copia'][$i]);
    }
  }

  # abrindo sessão de validação
  $_SESSION['atividades'] = array(
    'tipo'      => 'danger',
    'exibe'     => false,
    'mensagens' => array()
  );

  # verificando se houveram erros de validação
  if ($flag) {
    $_SESSION['atividades']['exibe'] = true;

    # repassando mensagens de erros para sessão
    for ($i = 0; $i < count($erros); $i++) {
      $_SESSION['atividades']['mensagens'][] = $erros[$i];
    }

    # redirecionando usuário para página de edição de atendimento externo
    header('location:' . BASE_URL . 'public/views/schedule/edita_atendimento_externo.php?id=' . $_POST['externo']['id']); exit;
  } else {
    # requisitando script
    require_once DIRETORIO_MODULES . 'schedule/modulo_alteracao.php';
    
    # chamando função responsável por alterar um atendimento externo e solicitar o envio de e-mail
    recebeAlteracaoDeAtendimentoExterno($externo, $copia);
  }
}
