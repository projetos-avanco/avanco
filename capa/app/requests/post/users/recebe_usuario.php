<?php

require_once '../../../../init.php';
require_once DIRETORIO_MODULES . 'users/usuario.php';
require_once DIRETORIO_HELPERS . 'datas.php';
require_once DIRETORIO_HELPERS . 'diversas.php';

if (isset($_POST['submit']) && $_POST['submit'] == 'users') {
  $flag = false;

  $erros = array();

  $cadastro = array(
    'id' => 0,
    'id_colaborador' => null,
    'nome' => null,
    'sobrenome' => null,
    'usuario' => null,    
    'senha' => null,
    'email' => null,
    'nivel' => null,
    'regime' => null,
    'contrato' => null,
    'ativo' => true,
    'ramal' => null,
    'admissao' => null,
    'cadastro' => null
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

  if (isset($_POST['cadastro']['id']) && (!empty($_POST['cadastro']['id']))) {
    if (is_numeric($_POST['cadastro']['id'])) {
      $cadastro['id_colaborador'] = (int) $_POST['cadastro']['id'];
    } else {
      $flag = true;
      $erros[] = 'ID do usuário deve conter números. Informe ao Wellington Felix!';
    }
  } else {
    $flag = true;
    $erros[] = 'ID do usuário não foi enviado. Informe ao Wellington Felix!';
  }

  if (isset($_POST['cadastro']['nome']) && (!empty($_POST['cadastro']['nome']))) {
    if (is_string($_POST['cadastro']['nome'])) {
      $cadastro['nome'] = ucwords(strtolower($_POST['cadastro']['nome']));
    } else {
      $flag = true;
      $erros[] = 'Nome só pode conter letras.';
    }
  } else {
    $flag = true;
    $erros[] = 'Nome não foi enviado.';
  }

  if (isset($_POST['cadastro']['sobrenome']) && (!empty($_POST['cadastro']['sobrenome']))) {
    if (is_string($_POST['cadastro']['sobrenome'])) {
      $cadastro['sobrenome'] = ucwords(strtolower($_POST['cadastro']['sobrenome']));
    } else {
      $flag = true;
      $erros[] = 'Sobrenome só pode conter letras.';
    }
  } else {
      $flag = true;
      $erros[] = 'Sobrenome não foi enviado.';
  }

  if (isset($_POST['cadastro']['usuario']) && (!empty($_POST['cadastro']['usuario']))) {
    if (is_string($_POST['cadastro']['usuario'])) {
      $cadastro['usuario'] = strtolower($_POST['cadastro']['usuario']);
    } else {
      $flag = true;
      $erros[] = 'Usuário só pode conter letras.';
    }
  } else {
      $flag = true;
      $erros[] = 'Usuário não foi enviado.';
  }

  if (isset($_POST['cadastro']['senha']) && (!empty($_POST['cadastro']['senha']))) {
    if (is_string($_POST['cadastro']['senha'])) {
      $senha1 = $_POST['cadastro']['senha'];
    } else {
      $flag = true;
      $erros[] = 'Senha só pode conter letras e números.';
    }
  } else {
      $flag = true;
      $erros[] = 'Senha não foi enviada.';
  }

  if (isset($_POST['cadastro']['repita-senha']) && (!empty($_POST['cadastro']['repita-senha']))) {
    if (is_string($_POST['cadastro']['repita-senha'])) {
      $senha2 = $_POST['cadastro']['repita-senha'];
    } else {
      $flag = true;
      $erros[] = 'Confirmação da senha só pode conter letras e números.';
    }
  } else {
      $flag = true;
      $erros[] = 'Confirmação da senha não foi enviada.';
  }

  if ($senha1 !== $senha2) {
    $flag = true;
    $erros[] = 'As senhas informadas são diferentes.';
  } else {
    $cadastro['senha'] = sha1($senha1);
  }

  unset($senha1, $senha2);

  if (isset($_POST['cadastro']['email']) && (!empty($_POST['cadastro']['email']))) {
    $email = filter_var($_POST['cadastro']['email'], FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $cadastro['email'] = $email;
    }
  }

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
      $cadastro['admissao'] = formataDataUnicaParaMysql($_POST['cadastro']['admissao']);
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

  $cadastro['cadastro'] = date('Y-m-d H:i:s');

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
        $time = (int) $_POST['cadastro']['time'];
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
        switch ($time) {
          case 2:
            $target = '/var/www/html/avanco/dashboard/public/img/teams/os-templarios/';
              break;
          
          case 3:
            $target = '/var/www/html/avanco/dashboard/public/img/teams/divergente/';
              break;
    
          case 4:
            $target = '/var/www/html/avanco/dashboard/public/img/teams/gulliver/';
              break;
          
          case 5:
            $target = '/var/www/html/avanco/dashboard/public/img/teams/avalanche/';
              break;
        }
    
        $target .= strtolower($cadastro['nome']) . '_' . strtolower($cadastro['sobrenome']);
    
        if ($_FILES['foto']['type'] == 'image/png') {
          $target .= '.png';      
        } else {
          $flag = true;
          $erros[] = 'A foto deve possuir extensão .png';
        }

        if ($_FILES['foto']['size'] <= 1048576) {
          $target = removeAcentosTrocaEspacoPorTraco($target);                  
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
    header('location:' . BASE_URL . 'public/views/users/cadastro.php'); exit;
  } else {
    
    if ($cadastro['nivel'] == 2) {
      # chamando função responsável por fazer o cadastro
      recebeCadastroDeUsuario($cadastro);
    } else {

      # verificando se a foto foi enviada
      if (isset($target)) {
        # chamando função responsável por fazer o cadastro
        recebeCadastroDeUsuario($cadastro, $target, $time, $opcoes);
      } else {
        $target = '';
        
        # chamando função responsável por fazer o cadastro
        recebeCadastroDeUsuario($cadastro, $target, $time, $opcoes);
      }
    }    
  }  
}