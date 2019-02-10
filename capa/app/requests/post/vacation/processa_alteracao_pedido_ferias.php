<?php

require_once '../../../../init.php';
require_once DIRETORIO_MODULES . 'vacation/modulo_pedido.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $pedido = array(
    'id' => 0,
    'id_exercicio' => null,
    'registro' => null,
    'situacao' => '1',
    'registrado' => null
  );

  # verificando se o array com o pedido existe e não está vazio
  if (isset($_POST['pedido']) && (!empty($_POST['pedido']))) {
    # verificando se o id do exercício de férias existe e não está vazio
    if (isset($_POST['pedido']['id']) && (!empty($_POST['pedido']['id']))) {
      # verificando se o id do exercício de férias é uma string numérica
      if (is_numeric($_POST['pedido']['id'])) {
        $pedido['id_exercicio'] = (int) $_POST['pedido']['id'];
      }
    }

    # verificando se o id do colaborador existe e não está vazio
    if (isset($_POST['colaborador']) && (!empty($_POST['colaborador']))) {
      # verificando se o id do colaborador é uma string numérica
      if (is_numeric($_POST['colaborador'])) {
        $pedido['id_colaborador'] = (int) $_POST['colaborador'];
      }
    }

    # verificando se o tipo do periodo do pedido existe e é uma string numérica
    if (isset($_POST['pedido']['periodo']) && is_numeric($_POST['pedido']['periodo'])) {
      # verificando qual foi o tipo do periodo selecionado pelo usuário
      switch ($_POST['pedido']['periodo']) {
        case '1':
        case '6':
          # verificando se a data inicial do período 1 foi enviada e não está vazia
          if (isset($_POST['pedido']['periodo1']['dataInicial']) && (!empty($_POST['pedido']['periodo1']['dataInicial']))) {
            # verificando se a data inicial do período 1 é uma string numérica
            if (is_string($_POST['pedido']['periodo1']['dataInicial'])) {
              $pedido['data_inicial'] = $_POST['pedido']['periodo1']['dataInicial'];
            }            
          }

          # verificando se a data final do período 1 foi enviada e não está vazia
          if (isset($_POST['pedido']['periodo1']['dataFinal']) && (!empty($_POST['pedido']['periodo1']['dataFinal']))) {
            # verificando se a data final do período 1 é uma string numérica
            if (is_string($_POST['pedido']['periodo1']['dataFinal'])) {
              $pedido['data_final'] = $_POST['pedido']['periodo1']['dataFinal'];
            }            
          }

          # verificando se o total de dias do período 1 foi enviado e não está vazio
          if (isset($_POST['pedido']['periodo1']['totalDias']) && (!empty($_POST['pedido']['periodo1']['totalDias']))) {
            # verificando se o total de dias do período 1 é uma string numérica
            if (is_numeric($_POST['pedido']['periodo1']['totalDias'])) {
              $pedido['dias'] = (int) $_POST['pedido']['periodo1']['totalDias'];
            }
          }
        break;
  
        case '2':
          /*
           * ---------
           * período 1
           * ---------
           */

          # verificando se a data inicial do período 1 foi enviada e não está vazia
          if (isset($_POST['pedido']['periodo1']['dataInicial']) && (!empty($_POST['pedido']['periodo1']['dataInicial']))) {
            # verificando se a data inicial do período 1 é uma string numérica
            if (is_string($_POST['pedido']['periodo1']['dataInicial'])) {
              $pedido['periodo1']['data_inicial'] = $_POST['pedido']['periodo1']['dataInicial'];
            }            
          }

          # verificando se a data final do período 1 foi enviada e não está vazia
          if (isset($_POST['pedido']['periodo1']['dataFinal']) && (!empty($_POST['pedido']['periodo1']['dataFinal']))) {
            # verificando se a data final do período 1 é uma string numérica
            if (is_string($_POST['pedido']['periodo1']['dataFinal'])) {
              $pedido['periodo1']['data_final'] = $_POST['pedido']['periodo1']['dataFinal'];
            }            
          }

          # verificando se o total de dias do período 1 foi enviado e não está vazio
          if (isset($_POST['pedido']['periodo1']['totalDias']) && (!empty($_POST['pedido']['periodo1']['totalDias']))) {
            # verificando se o total de dias do período 1 é uma string numérica
            if (is_numeric($_POST['pedido']['periodo1']['totalDias'])) {
              $pedido['periodo1']['dias'] = (int) $_POST['pedido']['periodo1']['totalDias'];
            }
          }

          /*
           * ---------
           * período 2
           * ---------
           */

          # verificando se a data inicial do período 2 foi enviada e não está vazia
          if (isset($_POST['pedido']['periodo2']['dataInicial']) && (!empty($_POST['pedido']['periodo2']['dataInicial']))) {
            # verificando se a data inicial do período 2 é uma string numérica
            if (is_string($_POST['pedido']['periodo2']['dataInicial'])) {
              $pedido['periodo2']['data_inicial'] = $_POST['pedido']['periodo2']['dataInicial'];
            }            
          }

          # verificando se a data final do período 2 foi enviada e não está vazia
          if (isset($_POST['pedido']['periodo2']['dataFinal']) && (!empty($_POST['pedido']['periodo2']['dataFinal']))) {
            # verificando se a data final do período 2 é uma string numérica
            if (is_string($_POST['pedido']['periodo2']['dataFinal'])) {
              $pedido['periodo2']['data_final'] = $_POST['pedido']['periodo2']['dataFinal'];
            }            
          }

          # verificando se o total de dias do período 2 foi enviado e não está vazio
          if (isset($_POST['pedido']['periodo2']['totalDias']) && (!empty($_POST['pedido']['periodo2']['totalDias']))) {
            # verificando se o total de dias do período 2 é uma string numérica
            if (is_numeric($_POST['pedido']['periodo2']['totalDias'])) {
              $pedido['periodo2']['dias'] = (int) $_POST['pedido']['periodo2']['totalDias'];
            }
          }
        break;
  
        case '3':
          /*
           * ---------
           * período 1
           * ---------
           */

          # verificando se a data inicial do período 1 foi enviada e não está vazia
          if (isset($_POST['pedido']['periodo1']['dataInicial']) && (!empty($_POST['pedido']['periodo1']['dataInicial']))) {
            # verificando se a data inicial do período 1 é uma string numérica
            if (is_string($_POST['pedido']['periodo1']['dataInicial'])) {
              $pedido['periodo1']['data_inicial'] = $_POST['pedido']['periodo1']['dataInicial'];
            }            
          }

          # verificando se a data final do período 1 foi enviada e não está vazia
          if (isset($_POST['pedido']['periodo1']['dataFinal']) && (!empty($_POST['pedido']['periodo1']['dataFinal']))) {
            # verificando se a data final do período 1 é uma string numérica
            if (is_string($_POST['pedido']['periodo1']['dataFinal'])) {
              $pedido['periodo1']['data_final'] = $_POST['pedido']['periodo1']['dataFinal'];
            }            
          }

          # verificando se o total de dias do período 1 foi enviado e não está vazio
          if (isset($_POST['pedido']['periodo1']['totalDias']) && (!empty($_POST['pedido']['periodo1']['totalDias']))) {
            # verificando se o total de dias do período 1 é uma string numérica
            if (is_numeric($_POST['pedido']['periodo1']['totalDias'])) {
              $pedido['periodo1']['dias'] = (int) $_POST['pedido']['periodo1']['totalDias'];
            }
          }

          /*
           * ---------
           * período 2
           * ---------
           */

          # verificando se a data inicial do período 2 foi enviada e não está vazia
          if (isset($_POST['pedido']['periodo2']['dataInicial']) && (!empty($_POST['pedido']['periodo2']['dataInicial']))) {
            # verificando se a data inicial do período 2 é uma string numérica
            if (is_string($_POST['pedido']['periodo2']['dataInicial'])) {
              $pedido['periodo2']['data_inicial'] = $_POST['pedido']['periodo2']['dataInicial'];
            }            
          }

          # verificando se a data final do período 2 foi enviada e não está vazia
          if (isset($_POST['pedido']['periodo2']['dataFinal']) && (!empty($_POST['pedido']['periodo2']['dataFinal']))) {
            # verificando se a data final do período 2 é uma string numérica
            if (is_string($_POST['pedido']['periodo2']['dataFinal'])) {
              $pedido['periodo2']['data_final'] = $_POST['pedido']['periodo2']['dataFinal'];
            }            
          }

          # verificando se o total de dias do período 2 foi enviado e não está vazio
          if (isset($_POST['pedido']['periodo2']['totalDias']) && (!empty($_POST['pedido']['periodo2']['totalDias']))) {
            # verificando se o total de dias do período 2 é uma string numérica
            if (is_numeric($_POST['pedido']['periodo2']['totalDias'])) {
              $pedido['periodo2']['dias'] = (int) $_POST['pedido']['periodo2']['totalDias'];
            }
          }

          /*
           * ---------
           * período 3
           * ---------
           */

          # verificando se a data inicial do período 3 foi enviada e não está vazia
          if (isset($_POST['pedido']['periodo3']['dataInicial']) && (!empty($_POST['pedido']['periodo3']['dataInicial']))) {
            # verificando se a data inicial do período 3 é uma string numérica
            if (is_string($_POST['pedido']['periodo3']['dataInicial'])) {
              $pedido['periodo3']['data_inicial'] = $_POST['pedido']['periodo3']['dataInicial'];
            }            
          }

          # verificando se a data final do período 3 foi enviada e não está vazia
          if (isset($_POST['pedido']['periodo3']['dataFinal']) && (!empty($_POST['pedido']['periodo3']['dataFinal']))) {
            # verificando se a data final do período 3 é uma string numérica
            if (is_string($_POST['pedido']['periodo3']['dataFinal'])) {
              $pedido['periodo3']['data_final'] = $_POST['pedido']['periodo3']['dataFinal'];
            }            
          }

          # verificando se o total de dias do período 3 foi enviado e não está vazio
          if (isset($_POST['pedido']['periodo3']['totalDias']) && (!empty($_POST['pedido']['periodo3']['totalDias']))) {
            # verificando se o total de dias do período 3 é uma string numérica
            if (is_numeric($_POST['pedido']['periodo3']['totalDias'])) {
              $pedido['periodo3']['dias'] = (int) $_POST['pedido']['periodo3']['totalDias'];
            }
          }
        break;

        case '4':
        case '5':
          /*
           * ---------
           * período 1
           * ---------
           */

          # verificando se a data inicial do período 1 foi enviada e não está vazia
          if (isset($_POST['pedido']['periodo1']['dataInicial']) && (!empty($_POST['pedido']['periodo1']['dataInicial']))) {
            # verificando se a data inicial do período 1 é uma string numérica
            if (is_string($_POST['pedido']['periodo1']['dataInicial'])) {
              $pedido['periodo1']['data_inicial'] = $_POST['pedido']['periodo1']['dataInicial'];
            }            
          }

          # verificando se a data final do período 1 foi enviada e não está vazia
          if (isset($_POST['pedido']['periodo1']['dataFinal']) && (!empty($_POST['pedido']['periodo1']['dataFinal']))) {
            # verificando se a data final do período 1 é uma string numérica
            if (is_string($_POST['pedido']['periodo1']['dataFinal'])) {
              $pedido['periodo1']['data_final'] = $_POST['pedido']['periodo1']['dataFinal'];
            }            
          }

          # verificando se o total de dias do período 1 foi enviado e não está vazio
          if (isset($_POST['pedido']['periodo1']['totalDias']) && (!empty($_POST['pedido']['periodo1']['totalDias']))) {
            # verificando se o total de dias do período 1 é uma string numérica
            if (is_numeric($_POST['pedido']['periodo1']['totalDias'])) {
              $pedido['periodo1']['dias'] = (int) $_POST['pedido']['periodo1']['totalDias'];
            }
          }

          /*
           * ---------
           * período 2
           * ---------
           */

          # verificando se a data inicial do período 2 foi enviada e não está vazia
          if (isset($_POST['pedido']['periodo2']['dataInicial']) && (!empty($_POST['pedido']['periodo2']['dataInicial']))) {
            # verificando se a data inicial do período 2 é uma string numérica
            if (is_string($_POST['pedido']['periodo2']['dataInicial'])) {
              $pedido['periodo2']['data_inicial'] = $_POST['pedido']['periodo2']['dataInicial'];
            }            
          }

          # verificando se a data final do período 2 foi enviada e não está vazia
          if (isset($_POST['pedido']['periodo2']['dataFinal']) && (!empty($_POST['pedido']['periodo2']['dataFinal']))) {
            # verificando se a data final do período 2 é uma string numérica
            if (is_string($_POST['pedido']['periodo2']['dataFinal'])) {
              $pedido['periodo2']['data_final'] = $_POST['pedido']['periodo2']['dataFinal'];
            }            
          }

          # verificando se o total de dias do período 2 foi enviado e não está vazio
          if (isset($_POST['pedido']['periodo2']['totalDias']) && (!empty($_POST['pedido']['periodo2']['totalDias']))) {
            # verificando se o total de dias do período 2 é uma string numérica
            if (is_numeric($_POST['pedido']['periodo2']['totalDias'])) {
              $pedido['periodo2']['dias'] = (int) $_POST['pedido']['periodo2']['totalDias'];
            }
          }
        break;
      }

      $pedido['registrado'] = date('Y-m-d H:i:s');

      recebeAlteracaoDePedidoDeFerias($pedido, $_POST['pedido']['periodo']);
    }
  }
}