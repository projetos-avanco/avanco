<?php

# verificando se houve requisição via método post
if (isset($_POST['submit']) && $_POST['submit'] == 'submit') {
  # requisitando script de configurações
  require_once '../../../../../init.php';
  
  # definindo array que será gravado em tabela
  $gestao = array(
    'id'           => 0,
    'id_cnpj'      => null,
    'id_issue'     => null,
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

  $gestao['registrado'] = date('Y-m-d H:i:s');

  # verificando se o tipo de atendimento é visita de relacionamento
  if ($gestao['tipo'] === '1') {
    $endereco = array(
      'logradouro'  => null,
      'distrito'    => null,
      'localidade'  => null,
      'uf'          => null,
      'tipo'        => null,
      'cep'         => null,
      'numero'      => null,
      'complemento' => null
    );
  
    $contato = array(
      'nome'   => null,
      'fixos'  => array(),
      'moveis' => array(),
      'emails' => array()
    );
  
    $copia = array();

    /**
     * ---------------------------
     * validando dados de endereço
     * ---------------------------
     */

    # verificando se o valor do campo logradouro foi enviado
    if (!empty($_POST['endereco']['logradouro'])) {
      # verificando se o valor do campo logradouro é uma string
      if (is_string($_POST['endereco']['logradouro'])) {
        $endereco['logradouro'] = mb_strtoupper($_POST['endereco']['logradouro'], 'utf-8');
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados da avenida não está correto.';
      }
    } else {
      $flag = true;
      $erros[] = 'O nome da avenida não foi informado.';
    }

    # verificando se o valor do campo distrito foi enviado
    if (!empty($_POST['endereco']['distrito'])) {
      # verificando se o valor do campo distrito é uma string
      if (is_string($_POST['endereco']['distrito'])) {
        $endereco['distrito'] = mb_strtoupper($_POST['endereco']['distrito'], 'utf-8');
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do bairro não está correto.';
      }
    } else {
      $flag = true;
      $erros[] = 'O nome do bairro não foi informado.';
    }

    # verificando se o valor do campo localidade foi enviado
    if (!empty($_POST['endereco']['localidade'])) {
      # verificando se o valor do campo localidade é uma string
      if (is_string($_POST['endereco']['localidade'])) {
        $endereco['localidade'] = mb_strtoupper($_POST['endereco']['localidade'], 'utf-8');
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados da cidade não está correto.';
      }
    } else {
      $flag = true;
      $erros[] = 'O nome da cidade não foi informado.';
    }

    # verificando se o valor do campo uf foi enviado
    if (!empty($_POST['endereco']['uf'])) {
      # verificando se o valor do campo uf é uma string
      if (is_string($_POST['endereco']['uf'])) {
        $endereco['uf'] = mb_strtoupper($_POST['endereco']['uf'], 'utf-8');
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do estado não está correto.';
      }
    } else {
      $flag = true;
      $erros[] = 'O nome do estado não foi informado.';
    }

    # verificando se o valor do campo tipo do endereço foi enviado
    if (!empty($_POST['endereco']['tipo'])) {
      # verificando se o valor do campo tipo do endereço é uma string
      if (is_string($_POST['endereco']['tipo'])) {
        $endereco['tipo'] = mb_strtoupper($_POST['endereco']['tipo'], 'utf-8');
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do campo tipo de endereço não está correto.';
      }
    } else {
      $flag = true;
      $erros[] = 'O tipo do endereço não foi informado.';
    }

    # verificando se o valor do campo cep foi enviado
    if (!empty($_POST['endereco']['cep'])) {
      # verificando se o valor do campo cep é uma string
      if (is_string($_POST['endereco']['cep'])) {
        $endereco['cep'] = $_POST['endereco']['cep'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do cep não está correto.';
      }
    } else {
      $flag = true;
      $erros[] = 'O cep não foi informado.';
    }

    # verificando se o valor do campo número foi enviado
    if (!empty($_POST['endereco']['numero'])) {
      # verificando se o valor do campo número é uma string
      if (is_string($_POST['endereco']['numero'])) {
        $endereco['numero'] = mb_strtoupper($_POST['endereco']['numero'], 'utf-8');
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do número não está correto.';
      }
    } else {
      $flag = true;
      $erros[] = 'O número do endereço não foi informado.';
    }

    # verificando se o valor do campo complemento foi enviado
    if (!empty($_POST['endereco']['complemento'])) {
      # verificando se o valor do campo complemento é uma string
      if (is_string($_POST['endereco']['complemento'])) {
        $endereco['complemento'] = mb_strtoupper($_POST['endereco']['complemento'], 'utf-8');      
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do complemento não está correto.';
      }
    } else {
      $endereco['complemento'] = '';
    }

    # verificando se o valor do campo referência foi enviado
    if (!empty($_POST['endereco']['referencia'])) {
      # verificando se o valor do campo complemento é uma string
      if (is_string($_POST['endereco']['referencia'])) {
        $endereco['referencia'] = mb_strtoupper($_POST['endereco']['referencia'], 'utf-8');
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados da referência não está correto.';
      }
    } else {
      $endereco['referencia'] = '';
    }

    /**
     * --------------------------
     * validando dados do contato
     * --------------------------
     */

    # verificando se o nome do contato foi enviado
    if (isset($_POST['contato']['nome-contato']) && (!empty($_POST['contato']['nome-contato']))) {
      # verificando se o nome do contato é uma string
      if (is_string($_POST['contato']['nome-contato'])) {
        $contato['nome'] = ucwords(mb_strtolower($_POST['contato']['nome-contato'], 'utf-8'));
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do nome do contato não está correto.';
      }
    } else {
      $flag = true;
      $erros[] = 'Nenhum contato foi selecionado.';
    }

    # verificando se o contato possui números fixos
    if (isset($contato['nome']) && (!empty($contato['nome']))) {
      # adicionando um - ao final de cada número fixo na string
      $str = str_replace(' (', ' - (', $_POST['contato']['fixo-contato']);

      # separando cada número fixo em uma posição do array
      $str = explode('- ', $str);

      # gravando número(s) fixo(s) no array contato
      for ($i = 0; $i < count($str); $i++) {
        # verificando se cada posição do array não está vazia
        if (!empty($str[$i])) {
          array_push($contato['fixos'], trim($str[$i]));
        }       
      }

      # verificando se o contato possui pelo menos um número fixo
      if (count($contato['fixos']) < 1) {
        $flag = true;
        $erros[] = 'O contato selecionado não possui nenhum número fixo.';
      }
    }

    # verificando se o contato possui números móveis
    if (isset($contato['nome']) && (!empty($contato['nome']))) {
      # adicionando um - ao final de cada número móvel na string
      $str = str_replace(' (', ' - (', $_POST['contato']['movel-contato']);

      # separando cada número móvel em uma posição do array
      $str = explode('- ', $str);

      # gravando número(s) móvel(eis) no array contato
      for ($i = 0; $i < count($str); $i++) {
        # verificando se cada posição do array não está vazia
        if (!empty($str[$i])) {
          array_push($contato['moveis'], trim($str[$i]));
        }    
      }

      # verificando se o contato possui pelo menos um número móvel
      if (count($contato['moveis']) < 1) {
        $flag = true;
        $erros[] = 'O contato selecionado não possui nenhum número móvel.';
      }
    }

    # verificando se o contato possui endereços de e-mail
    if (isset($contato['nome']) && (!empty($contato['nome']))) {
      # separando cada endereço de e-mail em uma posição do array
      $str = explode(' ', $_POST['contato']['email-contato']);

      # gravando endereço(s) de e-mail(s) no array contato
      for ($i = 0; $i < count($str); $i++) {
        # verificando se cada posição do array não está vazia
        if (!empty($str[$i])) {
          array_push($contato['emails'], mb_strtolower(trim($str[$i]), 'utf-8'));
        }    
      }

      # verificando se o contato possui pelo menos um endereço de e-mail
      if (count($contato['emails']) < 1) {
        $flag = true;
        $erros[] = 'O contato selecionado não possui nenhum endereço de e-mail.';
      }    
    }

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

    # redirecionando usuário para página de atendimento remoto
    header('location:' . BASE_URL . 'public/views/schedule/atendimento_gestao_clientes.php'); exit;
  } else {
    # requisitando script
    require_once DIRETORIO_MODULES . 'schedule/modulo_gestao.php';
    
    # verificando qual função será chamada
    if ($gestao['tipo'] === '1') {
      # chamando função responsável por gravar um atendimento remoto
      recebeAtendimentoGestaoVisitaRelacionamento($gestao, $endereco, $contato, $copia);
    } else {
      # chamando função responsável por gravar um atendimento remoto
      recebeAtendimentoGestao($gestao);
    }    
  }
}
