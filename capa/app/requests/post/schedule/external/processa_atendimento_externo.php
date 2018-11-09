<?php

# verificando se houve requisição via método post
if (isset($_POST['submit']) && $_POST['submit'] == 'submit') {
  # requisitando script de configurações
  require_once '../../../../../init.php';

  # requisitando script
  require_once DIRETORIO_HELPERS . 'datas.php';

  # definindo array que será gravado em tabela
  $externo = array(
    'id'           => 0,
    'id_cnpj'      => null,
    'id_issue'     => null,
    'registro'     => null,
    'tipo'         => null,
    'supervisor'   => null,
    'colaborador'  => null,
    'status'       => '1',
    'data_inicial' => null,
    'data_final'   => null,
    'horario'      => null,
    'produto'      => null,
    'modulo'       => null,
    'observacao'   => null,
    'faturado'     => null,
    'valor_hora'   => 0.0,
    'valor_pacote' => 0.0,
    'registrado'   => null
  );

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

  $flag = false;

  $erros = array();

  /**
   * -------------------------------------
   * validando dados do atendimento externo
   * -------------------------------------
   */

  # verificando se o id do cnpj da empresa foi enviado
  if (!empty($_POST['externo']['id-cnpj'])) {
    # verificando se o id do cnpj da empresa é uma string numérica
    if (is_numeric($_POST['externo']['id-cnpj'])) {
      $externo['id_cnpj'] = (int)$_POST['externo']['id-cnpj'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do código da Empresa não está correto.';
    }   
  } else {
    $flag = true;
    $erros[] = 'Nenhuma empresa foi selecionada.';
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
      $externo['data_inicial'] = formataDataUnicaParaMysql($_POST['externo']['data-inicial']);
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
      $externo['data_final'] = formataDataUnicaParaMysql($_POST['externo']['data-final']);
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

  # verificando se o valor do campo cobrança foi enviado
  if (isset($_POST['externo']['cobranca']) && (!empty($_POST['externo']['cobranca']))) {
    # verificando se o tipo de dados do valor do campo cobrança é uma string numérica
    if (is_numeric($_POST['externo']['cobranca'])) {
      $cobranca = $_POST['externo']['cobranca'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados da cobrança não está correto.';
    }    
  }

  # verificando se o valor da cobrança foi enviado
  if (isset($_POST['externo']['valor']) && (!empty($_POST['externo']['valor']))) {
    # verificando se o tipo de dados do valor é uma string numérica e se a cobrança foi definida
    if (is_numeric($_POST['externo']['valor']) && isset($cobranca)) {
      $valor = $_POST['externo']['valor'];      
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do valor não está correto ou a cobrança não foi confirmada.';
    }
  }

  # verificando se o atendimento é faturado
  if ($externo['faturado'] == 1) {
    # verificando se a cobrança e o valor foram definidos
    if (isset($cobranca) && isset($valor)) {
      # verificando se a cobrança é por hora
      if ($cobranca == '1') {
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
    header('location:' . BASE_URL . 'public/views/schedule/atendimento_externo.php'); exit;
  } else {
    # requisitando script
    require_once DIRETORIO_MODULES . 'schedule/modulo_externo.php';
        
    # chamando função responsável por gravar um atendimento remoto
    recebeAtendimentoExterno($externo, $endereco, $contato, $copia);
  }
}
