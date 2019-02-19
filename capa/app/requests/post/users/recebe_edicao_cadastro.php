<?php

require_once '../../../../init.php';
require_once DIRETORIO_MODULES . 'users/usuario.php';
require_once DIRETORIO_HELPERS . 'diversas.php';

if (isset($_POST['submit']) && $_POST['submit'] == 'users') {
  $flag = false;
  
  $erros = array();

  $cadastro = array(
    'id_colaborador' => null,
    'id_portal' => $_POST['cadastro']['id-portal'],
    'nome' => $_POST['cadastro']['nome'],
    'sobrenome' => $_POST['cadastro']['sobrenome'],
    'time' => null,
    'target' => '',
    'senha' => null,
    'nivel' => null,
    'regime' => null,
    'contrato' => null,
    'ativo' => true,
    'ramal' => null,
    'admissao' => null
  );

  $opcoes = array(
    'produto' => array(),
    'modulo' => array()
  );

  /**
   * ---------------------------
   * validando dados de cadastro
   * ---------------------------
   */

  if (isset($_POST['cadastro']['colaborador']) && (!empty($_POST['cadastro']['colaborador']))) {
    if (is_numeric($_POST['cadastro']['colaborador'])) {
      $cadastro['id_colaborador'] = (int) $_POST['cadastro']['colaborador'];
    } else {
      $flag = true;
      $erros[] = 'ID do usuário deve conter números. Informe ao Wellington Felix!';
    }
  } else {
    $flag = true;
    $erros[] = 'ID do usuário não foi enviado. Informe ao Wellington Felix!';
  }

  if (isset($_POST['cadastro']['senha'])) {
    if (is_string($_POST['cadastro']['senha'])) {
      $senha1 = $_POST['cadastro']['senha'];
    } else {
      $flag = true;
      $erros[] = 'Senha só pode conter letras e números.';
    }
  } else {
      $senha1 = '';
  }

  if (isset($_POST['cadastro']['repita-senha'])) {
    if (is_string($_POST['cadastro']['repita-senha'])) {
      $senha2 = $_POST['cadastro']['repita-senha'];
    } else {
      $flag = true;
      $erros[] = 'Confirmação da senha só pode conter letras e números.';
    }
  } else {
      $senha2 = '';
  }

  if ((! empty($senha1)) && (! empty($senha2))) {
    if ($senha1 !== $senha2) {
      $flag = true;
      $erros[] = 'As senhas informadas são diferentes.';
    } else {
      $cadastro['senha'] = sha1($senha1);
    }
  }

  unset($senha1, $senha2);

  if (isset($_POST['cadastro']['nivel']) && (!empty($_POST['cadastro']['nivel'])) && $_POST['cadastro']['nivel'] > 0) {
    if (is_numeric($_POST['cadastro']['nivel'])) {
      $cadastro['nivel'] = (int) $_POST['cadastro']['nivel'];
    } else {
      $flag = true;
      $erros[] = 'Nível só pode ser números.';
    }
  } else {
    $flag = true;
    $erros[] = 'Selecione o nível de usuário.';
  }

  if (isset($_POST['cadastro']['admissao']) && (!empty($_POST['cadastro']['admissao']))) {
    if (is_string($_POST['cadastro']['admissao'])) {
      $cadastro['admissao'] = $_POST['cadastro']['admissao'];
    } else {
      $flag = true;
      $erros[] = 'Data de admissão está no formato incorreto.';
    }
  } else {
    $flag = true;
    $erros[] = 'Data de admissão não foi enviada.';
  }

  if (isset($_POST['cadastro']['ramal']) && (!empty($_POST['cadastro']['ramal']))) {
    if (is_numeric($_POST['cadastro']['ramal'])) {
      $cadastro['ramal'] = $_POST['cadastro']['ramal'];
    } else {
      $flag = true;
      $erros[] = 'Ramal só pode ser números.';
    }
  } else {
    $cadastro['ramal'] = '0';
  }

  if ($cadastro['nivel'] == 1 || $cadastro['nivel'] == 2) {
    $cadastro['regime'] = '1';
    $cadastro['contrato'] = '0';
  } elseif ($cadastro['nivel'] == 3) {
    $cadastro['regime'] = '2';

    if (isset($_POST['cadastro']['contrato']) && (!empty($_POST['cadastro']['contrato']))) {
      if (is_numeric($_POST['cadastro']['contrato'])) {
        $cadastro['contrato'] = $_POST['cadastro']['contrato'];
      }
    }
  }

  /**
   * ----------------------------
   * validando dados do dashboard
   * ----------------------------
   */

  if ($cadastro['nivel'] == 1 || $cadastro['nivel'] == 3) {
    if (isset($_POST['cadastro']['opcoes']) && count($_POST['cadastro']['opcoes']) >= 1) {
      foreach ($_POST['cadastro']['opcoes'] AS $chave => $valor) {
        array_push($opcoes['modulo'], (int) $chave);
        array_push($opcoes['produto'], (int) $valor);
      }
    } else {
      $flag = true;
      $erros[] = 'É necessário marcar pelo menos um módulo.';
    }
  }  

  if ($cadastro['nivel'] == 1 || $cadastro['nivel'] == 3) {
    if (isset($_POST['cadastro']['time']) && (!empty($_POST['cadastro']['time'])) && $_POST['cadastro']['time'] > 1) {
      if (is_numeric($_POST['cadastro']['time'])) {
        $cadastro['time'] = (int) $_POST['cadastro']['time'];
      } else {
        $flag = true;
        $erros[] = 'Time só pode ser número.';
      }
    } else {
      $flag = true;
      $erros[] = 'Não foi selecionado nenhum time.';
    }
  }  

  if ($cadastro['nivel'] == 1 || $cadastro['nivel'] == 3) {
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
      if (empty($flag)) {
        switch ($cadastro['time']) {
          case 2:
            $cadastro['target'] = '/var/www/html/avanco/dashboard/public/img/teams/os-templarios/';
              break;
          
          case 3:
            $cadastro['target'] = '/var/www/html/avanco/dashboard/public/img/teams/divergente/';
              break;
    
          case 4:
            $cadastro['target'] = '/var/www/html/avanco/dashboard/public/img/teams/gulliver/';
              break;
          
          case 5:
            $cadastro['target'] = '/var/www/html/avanco/dashboard/public/img/teams/avalanche/';
              break;
        }
    
        $cadastro['target'] .= strtolower($cadastro['nome']) . '_' . strtolower($cadastro['sobrenome']);
    
        if ($_FILES['foto']['type'] == 'image/png') {
          $cadastro['target'] .= '.png';      
        } else {
          $flag = true;
          $erros[] = 'A foto deve possuir extensão .png';
        }

        if ($_FILES['foto']['size'] <= 1048576) {
          $cadastro['target'] = removeAcentosTrocaEspacoPorTraco($cadastro['target']);                  
        } else {
          $flag = true;
          $erros[] = 'A foto deve possuir um tamanho de até 1MB.';
        }
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
    header('location:' . BASE_URL . 'public/views/users/edita_cadastro.php'); exit;
  } else {
    # verificando se o nível do usuário é administrador
    if ($cadastro['nivel'] == 2) {
      # chamando função responsável por editar um usuário de administrador
      recebeEdicaoDeCadastroDeAdministrador($cadastro);
    } else {
      # chamando função responsável por editar um usuário
      recebeEdicaoDeCadastroDeUsuario($cadastro, $opcoes);
    }    
  }  
}