<?php

# verificando se houve requisição via método post
if (isset($_POST['submit']) && $_POST['submit'] == 'submit') {
  # requisitando script de configurações
  require_once '../../../../../init.php';
  
  # definindo array que será gravado em tabela
  $remoto = array(
    'id'           => 0,
    'id_cnpj'      => null,
    'id_issue'     => null,
    'id_contato'   => null,
    'registro'     => null,
    'tipo'         => null,
    'supervisor'   => null,
    'colaborador'  => null,
    'status'       => null,
    'data'         => null,
    'horario'      => null,
    'produto'      => null,
    'modulo'       => null,
    'tarefa'       => null,
    'observacao'   => null,
    'faturado'     => null,
    'valor_hora'   => 0.0,
    'valor_pacote' => 0.0,
    'registrado'   => null
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
   * validando dados do atendimento remoto
   * -------------------------------------
   */

  # verificando se o id do cnpj da empresa foi enviado
  if (!empty($_POST['remoto']['id-cnpj'])) {
    # verificando se o id do cnpj da empresa é uma string numérica
    if (is_numeric($_POST['remoto']['id-cnpj'])) {
      $remoto['id_cnpj'] = (int)$_POST['remoto']['id-cnpj'];
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
      $remoto['id_contato'] = (int) $_POST['contato']['id-contato'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do id do contato não está correto';
    }
  } else {
    $flag = true;
    $erros[] = 'O id do contato não foi enviado.';
  }

  # verificando se a situação do atendimento foi enviado
  if (!empty($_POST['remoto']['situacao'])) {
    # verificando se a situação do atendimento é uma string numérica
    if (is_numeric($_POST['remoto']['situacao'])) {
      # verificando se a situação do atendimento não está confirmada
      if ($_POST['remoto']['situacao'] == '1') {
        $remoto['status'] = '1';
      } elseif ($_POST['remoto']['situacao'] == '2') {
        $remoto['status'] = '2';
      } else {
        $remoto['status'] = '3';
      }
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados da situação do atendimento não está correto';
    }
  } else {
    $flag = true;
    $erros[] = 'A situação do atendimento não foi selecionado';
  }

  # verificando se o tipo de atendimento foi enviado
  if (!empty($_POST['remoto']['tipo'])) {
    # verificando se o tipo de atendimento é uma string numérica
    if (is_numeric($_POST['remoto']['tipo'])) {
      $remoto['tipo'] = $_POST['remoto']['tipo'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do tipo de atendimento não está correto';
    }
  } else {
    $flag = true;
    $erros[] = 'O tipo de atendimento não foi selecionado';
  }

  # verificando se o id do supervisor foi enviado
  if (!empty($_POST['remoto']['supervisor'])) {
    # verificando se o id do supervisor é uma string numérica
    if (is_numeric($_POST['remoto']['supervisor'])) {
      $remoto['supervisor'] = (int)$_POST['remoto']['supervisor'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do id do supervisor não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'O id do supervisor não foi enviado.';
  }

  # verificando se o id do colaborador foi enviado
  if (!empty($_POST['remoto']['colaborador'])) {
    # verificando se o id do colaborador é uma string numérica
    if (is_numeric($_POST['remoto']['colaborador'])) {
      $remoto['colaborador'] = (int)$_POST['remoto']['colaborador'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do id do colaborador não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'O id do colaborador não foi enviado.';
  }

  # verificando se a data do atendimento foi enviada
  if (!empty($_POST['remoto']['data'])) {
    # verificando se a data do atendimento é uma string
    if (is_string($_POST['remoto']['data'])) {
      $remoto['data'] = $_POST['remoto']['data'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados da data do atendimento não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'A data do atendimento não foi informada.';
  }

  # verificando se o horário do atendimento foi enviado
  if (!empty($_POST['remoto']['horario'])) {
    # verificando se o horário do atendimento é uma string
    if (is_string($_POST['remoto']['horario'])) {
      $remoto['horario'] = $_POST['remoto']['horario'] . ':00';
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do horário do atendimento não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'O horário do atendimento não foi informado.';
  }

  # verificando se o código do produto foi enviado
  if (!empty($_POST['remoto']['produto'])) {
    # verificando se o código do produto é uma string numérica
    if (is_numeric($_POST['remoto']['produto'])) {
      $remoto['produto'] = $_POST['remoto']['produto'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do produto não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'Nenhum produto foi selecionado.';
  }

  # verificando se o código do módulo foi enviado
  if (!empty($_POST['remoto']['modulo'])) {
    # verificando se o código do módulo é uma string numérica
    if (is_numeric($_POST['remoto']['modulo'])) {
      $remoto['modulo'] = $_POST['remoto']['modulo'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do código do módulo não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'Nenhum módulo foi selecionado.';
  }

  # verificando se o código do módulo foi enviado
  if (!empty($_POST['remoto']['tarefa'])) {
    # verificando se o código do módulo é uma string numérica
    if (is_string($_POST['remoto']['tarefa'])) {
      $remoto['tarefa'] = $_POST['remoto']['tarefa'];
      $remoto['tarefa'] = addslashes(mb_strtolower($remoto['tarefa'], 'utf-8'));
      $remoto['tarefa'] = trim(str_replace("\r\n", ' ', $remoto['tarefa']));
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do tarefa a ser realizado não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'Não foi informado o tarefa a ser realizado.';
  }

  # verificando se a observação foi enviada
  if (!empty($_POST['remoto']['observacao'])) {
    # verificando se a observação é uma string
    if (is_string($_POST['remoto']['observacao'])) {
      $remoto['observacao'] = $_POST['remoto']['observacao'];
      $remoto['observacao'] = addslashes(mb_strtolower($remoto['observacao'], 'utf-8'));
      $remoto['observacao'] = trim(str_replace("\r\n", ' ', $remoto['observacao']));
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados da observação não está correto.';
    }
  } else {
    $remoto['observacao'] = '';
  }

  # verificando se o valor do campo faturado foi enviado
  if (!empty($_POST['remoto']['faturado'])) {
    # verificando se o valor do campo faturado é uma string numérica
    if (is_numeric($_POST['remoto']['faturado'])) {
      $remoto['faturado'] = (int)$_POST['remoto']['faturado'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do valor do campo faturado não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'Não foi informado se o atendimento é faturado ou não.';
  }

  # verificando se foi enviado algum arquivo em anexo
  if (isset($_FILES['remoto']) && $_FILES['remoto']['error']['anexo'] == 0) {          
    # verificando se o tamanho do arquivo em anexo é maior que 2MB
    if ($_FILES['remoto']['size']['anexo'] > 2097152) {
      $flag = true;
      $erros['mensagens'][] = 'O arquivo em anexo deve ter o tamanho máximo de 2MB.';      
    }
  }

  # verificando se o valor do campo cobrança foi enviado
  if (isset($_POST['remoto']['cobranca']) && (!empty($_POST['remoto']['cobranca']))) {
    # verificando se o tipo de dados do valor do campo cobrança é uma string numérica
    if (is_numeric($_POST['remoto']['cobranca'])) {
      $remoto['cobranca'] = $_POST['remoto']['cobranca'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados da cobrança não está correto.';
    }
  }

  # verificando se o valor da cobrança foi enviado
  if (isset($_POST['remoto']['valor']) && (!empty($_POST['remoto']['valor']))) {
    # verificando se o tipo de dados do valor é uma string numérica e se a cobrança foi definida
    if (is_numeric($_POST['remoto']['valor']) && isset($remoto['cobranca'])) {
      # verificando se o pedido é faturado e se o valor é maior que 0
      if ($remoto['faturado'] == 1 && $_POST['remoto']['valor'] > '0.00') {
        $valor = $_POST['remoto']['valor'];
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
  if ($remoto['faturado'] == 1) {
    # verificando se a cobrança e o valor foram definidos
    if (isset($remoto['cobranca']) && isset($valor)) {
      # verificando se a cobrança é por hora
      if ($remoto['cobranca'] == '1') {
        $remoto['valor_hora'] = (float)$valor;
      } else {
        $remoto['valor_pacote'] = (float)$valor;
      }
    }
  } else {
    $remoto['faturado'] = 0;
  }

  $remoto['registrado'] = date('Y-m-d H:i:s');

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
    header('location:' . BASE_URL . 'public/views/schedule/atendimento_remoto.php'); exit;
  } else {
    # requisitando script
    require_once DIRETORIO_MODULES . 'schedule/modulo_remoto.php';
    
    # chamando função responsável por gravar um atendimento remoto
    recebeAtendimentoRemoto($remoto, $contato, $copia);
  }
}
