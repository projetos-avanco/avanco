<?php

/**
 * cria o hash da senha utilizando criptografia SHA1
 * @param - senha informada no formulário de login
 */
function criaCodigoHash($senha)
{
  return sha1($senha);
}

/**
 * verifica se o usuário está logado
 */
function verificaUsuarioLogado($pagina)
{
  require DIRETORIO_MODELS . 'sessao.php';

  $mensagem = isset($_SESSION['mensagens']['mensagem']) ? $_SESSION['mensagens']['mensagem'] : '';

  # verificando se a sessão de mensagem contém a mensagem de nível de usuário
  if ($mensagem == '<p class="text-center"><strong>Sinto Muito!</strong> Seu nível de usuário não permite acessar esse módulo.</p>') {

    # chamando função que cria o modelo de mensagem para limpar a mensagem existente na sessão
    criaModeloDeSessaoParaMensagens();

  }

  # verificando se não existem as variáveis de sessão do usuário
  if (! isset($_SESSION['usuario']['logado']) OR $_SESSION['usuario']['logado'] !== true) {

    $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Ops!</strong> Faça o login para acessar o sistema.</p>';
    $_SESSION['mensagens']['tipo']     = 'warning';
    $_SESSION['mensagens']['exibe']    = true;

    return false;

  }

  # recuperando o nível de acesso do usuário
  $nivel = $_SESSION['usuario']['nivel'];

  # verificando se o usuário possui nível de acesso para acessar as páginas do sistema
  switch ($nivel) {

    case 1:

      # páginas que usuários de nível 1 possuem permissão para acessar
      if ($pagina == 'consulta_tickets.php'      OR
          $pagina == 'colaboradores_logados.php' OR
          $pagina == 'extrato.php'               OR
          $pagina == 'conta.php'                 OR
          $pagina == 'loja.php') {

        return true;

      }

      # páginas que usuários de nível 1 não possuem permissão para acessar
      if ($pagina == 'nova_atividade.php' OR
          $pagina == 'registro_horas.php') {

        $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Sinto Muito!</strong> Seu nível de usuário não permite acessar esse módulo.</p>';
        $_SESSION['mensagens']['tipo']     = 'danger';
        $_SESSION['mensagens']['exibe']    = true;

        return false;

      }

      break;

    case 2:

      # páginas que usuários de nível 2 possuem permissão para acessar
      if
        ($pagina == 'colaboradores_logados.php' OR
         $pagina == 'consulta_tickets.php'      OR
         $pagina == 'nova_atividade.php'        OR
         $pagina == 'extrato.php'               OR
         $pagina == 'conta.php'                 OR
         $pagina == 'loja.php'                  OR
         $pagina == 'registro_horas.php') {

        return true;

      }

      break;

    default:

      return false;

      break;

  }

}
