<?php

# verificando se houve requisição via método post
if (isset($_POST['submit']) && $_POST['submit'] == 'submit') {
  # requisitando script de configurações
  require_once '../../../../../init.php';
  
  # definindo array que será gravado em tabela
  $gestao = array(
    'id'           => 0,
    'id_cnpj'      => null,
    'id_contato'   => null,
    'registro'     => null,
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

  $flag = false;

  $erros = array();

  /**
   * -------------------------------------
   * validando dados do atendimento externo
   * -------------------------------------
   */

  # verificando se o id do cnpj da empresa foi enviado
  if (!empty($_POST['gestao']['id-cnpj'])) {
    # verificando se o id do cnpj da empresa é uma string numérica
    if (is_numeric($_POST['gestao']['id-cnpj'])) {
      $gestao['id_cnpj'] = (int)$_POST['gestao']['id-cnpj'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do código da Empresa não está correto.';
    }   
  } else {
    $flag = true;
    $erros[] = 'Nenhuma empresa foi selecionada.';
  }

  # verificando se o id do contato foi enviado
  if (!empty($_POST['contato']['id-contato'])) {
    # verificando se o id do contato é uma string numérica
    if (is_numeric($_POST['contato']['id-contato'])) {
      $gestao['id_contato'] = (int) $_POST['contato']['id-contato'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do id do contato não está correto';
    }
  } else {
    $flag = true;
    $erros[] = 'O id do contato não foi enviado.';
  }
  
  # verificando se a situação do atendimento foi enviado
  if (!empty($_POST['gestao']['situacao'])) {
    # verificando se o tipo de atendimento é uma string numérica
    if (is_numeric($_POST['gestao']['situacao'])) {
      # verificando se a situação do atendimento não está confirmada
      if ($_POST['gestao']['situacao'] == '1') {
        $gestao['status'] = '1';
      } elseif ($_POST['gestao']['situacao'] == '2') {
        $gestao['status'] = '2';
      } else {
        $gestao['status'] = '3';
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
  if (!empty($_POST['gestao']['tipo-atendimento'])) {
    # verificando se o tipo de atendimento é uma string numérica
    if (is_numeric($_POST['gestao']['tipo-atendimento'])) {
      $gestao['tipo'] = $_POST['gestao']['tipo-atendimento'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do tipo de atendimento não está correto';
    }
  } else {
    $flag = true;
    $erros[] = 'O tipo de atendimento não foi selecionado.';
  }

  # verificando se o id do supervisor foi enviado
  if (!empty($_POST['gestao']['supervisor'])) {
    # verificando se o id do supervisor é uma string numérica
    if (is_numeric($_POST['gestao']['supervisor'])) {
      $gestao['supervisor'] = (int)$_POST['gestao']['supervisor'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do id do supervisor não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'Não foi possível recuperar os dados do supervisor logado.';
  }

  # verificando se o id do colaborador foi enviado
  if (!empty($_POST['gestao']['colaborador'])) {
    # verificando se o id do colaborador é uma string numérica
    if (is_numeric($_POST['gestao']['colaborador'])) {
      $gestao['colaborador'] = (int)$_POST['gestao']['colaborador'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do id do colaborador não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'Nenhum colaborador foi selecionado.';
  }

  # verificando se a data inicial do atendimento foi enviada
  if (!empty($_POST['gestao']['data-inicial'])) {
    # verificando se a data do atendimento é uma string
    if (is_string($_POST['gestao']['data-inicial'])) {
      $gestao['data_inicial'] = $_POST['gestao']['data-inicial'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados da data inicial do atendimento não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'A data inicial do atendimento não foi informada.';
  }

  # verificando se a data final do atendimento foi enviada
  if (!empty($_POST['gestao']['data-final'])) {
    # verificando se a data do atendimento é uma string
    if (is_string($_POST['gestao']['data-final'])) {
      $gestao['data_final'] = $_POST['gestao']['data-final'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados da data final do atendimento não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'A data final do atendimento não foi informada.';
  }

  # verificando se o horário do atendimento foi enviado
  if (!empty($_POST['gestao']['horario'])) {
    # verificando se o horário do atendimento é uma string
    if (is_string($_POST['gestao']['horario'])) {
      $gestao['horario'] = $_POST['gestao']['horario'] . ':00';
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do horário do atendimento não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'O horário do atendimento não foi informado.';
  }

  # verificando se o código do produto foi enviado
  if (!empty($_POST['gestao']['produto'])) {
    # verificando se o código do produto é uma string numérica
    if (is_numeric($_POST['gestao']['produto'])) {
      $gestao['produto'] = $_POST['gestao']['produto'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do produto não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'Nenhum produto foi selecionado.';
  }

  # verificando se o código do módulo foi enviado
  if (!empty($_POST['gestao']['modulo'])) {
    # verificando se o código do módulo é uma string numérica
    if (is_numeric($_POST['gestao']['modulo'])) {
      $gestao['modulo'] = $_POST['gestao']['modulo'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do código do módulo não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'Nenhum módulo foi selecionado.';
  }

  # verificando se a observação foi enviada
  if (!empty($_POST['gestao']['observacao'])) {
    # verificando se a observação é uma string
    if (is_string($_POST['gestao']['observacao'])) {
      $gestao['observacao'] = $_POST['gestao']['observacao'];
      $gestao['observacao'] = addslashes(mb_strtolower($gestao['observacao'], 'utf-8'));
      $gestao['observacao'] = trim(str_replace("\r\n", ' ', $gestao['observacao']));
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados da observação não está correto.';
    }
  } else {
    $gestao['observacao'] = '';
  }

  # verificando se o valor do campo faturado foi enviado
  if (!empty($_POST['gestao']['faturado'])) {
    # verificando se o valor do campo faturado é uma string numérica
    if (is_numeric($_POST['gestao']['faturado'])) {
      $gestao['faturado'] = (int)$_POST['gestao']['faturado'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do valor do campo faturado não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'Não foi informado se o atendimento é faturado ou não.';
  }

  # verificando se o valor do campo cobrança foi enviado
  if (isset($_POST['gestao']['cobranca']) && (!empty($_POST['gestao']['cobranca']))) {
    # verificando se o tipo de dados do valor do campo cobrança é uma string numérica
    if (is_numeric($_POST['gestao']['cobranca'])) {
      $gestao['cobranca'] = $_POST['gestao']['cobranca'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados da cobrança não está correto.';
    }    
  }

  # verificando se o valor da cobrança foi enviado
  if (isset($_POST['gestao']['valor']) && (!empty($_POST['gestao']['valor']))) {
    # verificando se o tipo de dados do valor é uma string numérica e se a cobrança foi definida
    if (is_numeric($_POST['gestao']['valor']) && isset($gestao['cobranca'])) {
      # verificando se o pedido é faturado e se o valor é maior que 0
      if ($gestao['faturado'] == 1 && $_POST['gestao']['valor'] > '0.00') {
        $valor = $_POST['gestao']['valor'];
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
  if ($gestao['faturado'] == 1) {
    # verificando se a cobrança e o valor foram definidos
    if (isset($gestao['cobranca']) && isset($valor)) {
      # verificando se a cobrança é por hora
      if ($gestao['cobranca'] == '1') {
        $gestao['valor_hora'] = (float)$valor;        
      } else {
        $gestao['valor_pacote'] = (float)$valor;        
      }
    }
  } else {
    $gestao['faturado'] = 0;
  }
  
  # verificando se o valor do campo despesa foi enviado
  if (!empty($_POST['gestao']['despesa'])) {
    # verificando se o valor do campo despesa é uma string numérica
    if (is_numeric($_POST['gestao']['despesa'])) {
      $gestao['despesa'] = (int)$_POST['gestao']['despesa'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do valor do campo despesa não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'Não foi informado se o atendimento possui despesas ou não.';
  }

  # verificando se não existe despesa, alterando o valor para 0
  if ($gestao['despesa'] == 2) {
    $gestao['despesa'] = 0;
  }

  $gestao['registrado'] = date('Y-m-d H:i:s');

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

    # redirecionando usuário para página de atendimento remoto
    header('location:' . BASE_URL . 'public/views/schedule/atendimento_clientes.php'); exit;
  } else {
    # requisitando script
    require_once DIRETORIO_MODULES . 'schedule/modulo_gestao.php';
    
    # chamando função responsável por gravar um atendimento remoto
    recebeAtendimentoGestao($gestao);
  }
}
