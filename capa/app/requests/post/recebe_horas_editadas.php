<?php require '../../../init.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <title>Portal Avanção - Erros</title>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap_3.3.7.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/fontes.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/home.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/sidebar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/hours/validacao.css">

   <!-- dispositivos com largura máxima de 769px (por exemplo tablets) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbartablet.css" type="text/css" media="screen and (max-width: 769px)" />
  <!-- dispositivos com largura máxima de 450px (por exemplo smartphones) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbarsmart.css" type="text/css" media="screen and (max-width:450px)" />
</head>

<body>

  <div class="row">
    <div class="col-sm-6 col-sm-offset-3">
      <?php

      # verificando se existe requisição via método POST
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        # verficando se todas as informações da tabela issues foram enviadas
        if (isset($_POST['issues']) && count($_POST['issues']) == 8) {
          
          $issues = array(

            'id' => '',
            'issue' => '',
            'tipo' => '',
            'cnpj' => '',
            'conta_contrato' => '',
            'razao_social' => '',
            'supervisor' => '',
            'colaborador' => '',

          );

          # validando o id da issue
          if (isset($_POST['issues']['id']) && is_numeric($_POST['issues']['id'])) {

            $issues['id'] = $_POST['issues']['id'];
            
          } else {

            echo '
              <p class="alert alert-danger" role="alert">O id da issue não pode ser uma string!</p>
              <p>
                <a class="btn btn-default" href="/avanco/capa/public/views/hours/edita_lancamentos.php?issue='.$_POST['issues']['issue'].'">
                  <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
                </a>
              </p>';

            exit;

          }

          # validando o id do supervisor
          if (isset($_POST['issues']['supervisor']) && is_numeric($_POST['issues']['supervisor'])) {
            
            $issues['supervisor'] = $_POST['issues']['supervisor'];

          } else {

            echo '
              <p class="alert alert-danger" role="alert">O id do supervisor não pode ser uma string!</p>
              <p>
                <a class="btn btn-default" href="/avanco/capa/public/views/hours/edita_lancamentos.php?issue='.$_POST['issues']['issue'].'">
                  <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
                </a>
              </p>';

            exit;

          }

          # validando o id do colaborador
          if (isset($_POST['issues']['colaborador']) && is_numeric($_POST['issues']['colaborador'])) {

            $issues['colaborador'] = $_POST['issues']['colaborador'];

          } else {

            echo '
              <p class="alert alert-danger" role="alert">O id do colaborador não pode ser uma string!</p>
              <p>
                <a class="btn btn-default" href="/avanco/capa/public/views/hours/edita_lancamentos.php?issue='.$_POST['issues']['issue'].'">
                  <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
                </a>
              </p>';

            exit;

          }

          $issues['issue']           = isset($_POST['issues']['issue']) ? $_POST['issues']['issue'] : '';
          $issues['tipo']            = isset($_POST['issues']['tipo']) ? $_POST['issues']['tipo'] : '';
          $issues['cnpj']            = isset($_POST['issues']['cnpj']) ? $_POST['issues']['cnpj'] : '';
          $issues['conta_contrato']  = isset($_POST['issues']['conta_contrato']) ? $_POST['issues']['conta_contrato'] : '';
          $issues['razao_social']    = isset($_POST['issues']['razao_social']) ? $_POST['issues']['razao_social'] : '';
          
          $issues['issue'] = strtoupper($issues['issue']);
          
        } else {

          echo '          
            <p class="alert alert-danger" role="alert">Não foram enviadas todas as informações da tabela de issues!</p>
            <p>
              <a class="btn btn-default" href="/avanco/capa/public/views/hours/edita_lancamentos.php?issue='.$_POST['issues']['issue'].'">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
              </a>
            </p>';

          exit;

        }

        # verificando se todas as informações da tabela despesas foram enviadas
        if (isset($_POST['despesas']) && count($_POST['despesas']) == 4) {
          
          $despesas = array(

            'deslocamento' => '',
            'alimentacao'  => '',
            'hospedagem'   => '',
            'total'        => '',

          );

          # validando o valor do deslocamento
          if (isset($_POST['despesas']['deslocamento']) && is_numeric($_POST['despesas']['deslocamento'])) {

            $despesas['deslocamento'] = $_POST['despesas']['deslocamento'];

          } else {

            echo '
              <p class="alert alert-warning" role="alert">O valor do deslocamento deve ser somente números!</p>
              <p>
                <a class="btn btn-default" href="/avanco/capa/public/views/hours/edita_lancamentos.php?issue='.$_POST['issues']['issue'].'">
                  <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
                </a>
              </p>';

            exit;

          }

          # validando o valor da alimentação
          if (isset($_POST['despesas']['alimentacao']) && is_numeric($_POST['despesas']['alimentacao'])) {

            $despesas['alimentacao'] = $_POST['despesas']['alimentacao'];

          } else {

            echo '
              <p class="alert alert-warning" role="alert">O valor da alimentação deve ser somente números!</p>
              <p>
                <a class="btn btn-default" href="/avanco/capa/public/views/hours/edita_lancamentos.php?issue='.$_POST['issues']['issue'].'">
                  <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
                </a>
              </p>';

            exit;

          }

          # validando o valor da hospedagem
          if (isset($_POST['despesas']['hospedagem']) && is_numeric($_POST['despesas']['hospedagem'])) {

            $despesas['hospedagem'] = $_POST['despesas']['hospedagem'];

          } else {

            echo '
              <p class="alert alert-warning" role="alert">O valor da hospedagem deve ser somente números!</p>
              <p>
                <a class="btn btn-default" href="/avanco/capa/public/views/hours/edita_lancamentos.php?issue='.$_POST['issues']['issue'].'">
                  <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
                </a>
              </p>';

            exit;

          }

          $despesas['total'] = isset($_POST['despesas']['total-despesas']) ? $_POST['despesas']['total-despesas'] : '';
          
        } else {

          echo '
            <p class="alert alert-warning" role="alert">Não foram enviadas todas as informações da tabela de despesas!</p>
            <p>
              <a class="btn btn-default" href="/avanco/capa/public/views/hours/edita_lancamentos.php?issue='.$_POST['issues']['issue'].'">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
              </a>
            </p>';

          exit;

        }

        $lancamentos = array();

        # flag
        $bandeira = true;

        # verificando se existem lançamentos para serem inseridos na tabela de lançamentos
        if (isset($_POST['lancamentos']) && count($_POST['lancamentos']) > 0) {

          # verificando se o tipo de issue é in-loco (somente in-loco possui despesas)
          if ($issues['tipo'] == 'in-loco') {

            # reordenando os índices do array de lançamentos
            $_POST['lancamentos'] = array_values($_POST['lancamentos']);
            
            $contador = 0;

            # validando os dados de todos os lançamentos
            foreach ($_POST['lancamentos'] as $chave => $valor) {

              # validando data
              if ($valor['data'] == '') {
                echo 
                  '<p class="alert alert-warning" role="alert">A data do <b>lançamento</b> ' . $contador . ' está vazia!</p>';
                $bandeira = false;
              }          
              
              # validando produto
              if ($valor['produto'] == '0') {          
                echo 
                  '<p class="alert alert-warning" role="alert">Nenhum produto foi selecionado no <b>lançamento</b> ' . $contador . '!</p>';
                $bandeira = false;
              }          
              
              # validando horas trabalhadas
              if ($valor['horas-trabalhadas'] == '') {          
                echo 
                  '<p class="alert alert-warning" role="alert">Não foi informado a quantidade de horas trabalhadas no <b>lançamento</b> ' . $contador . '!</p>';
                $bandeira = false;
              }          

              # validando horas faturadas
              if ($valor['horas-faturadas'] == '') {          
                echo 
                  '<p class="alert alert-warning" role="alert">Não foi informado a quantidade de horas faturadas no <b>lançamento</b> ' . $contador . '!</p>';
                $bandeira = false;
              }          

              # validando valor da hora
              if ($valor['valor-horas'] == '0') {          
                echo 
                  '<p class="alert alert-warning" role="alert">Não foi informado o valor da hora no <b>lançamento</b> ' . $contador . '!</p>';
                $bandeira = false;
              }          

              # validando total
              if ($valor['valor-total'] == '0') {        
                echo 
                  '<p class="alert alert-warning" role="alert">Não foi informado o valor total no <b>lançamento</b> ' . $contador . '!</p>';
                $bandeira = false;
              }          
              
              $contador++;

            }

            # recuperando os lançamentos
            $lancamentos = $_POST['lancamentos'];

          } else {

            # eliminando os lançamentos (o tipo é remoto)
            unset ($_POST['lancamentos']);

          }

          # verificando se não houve erros na validação dos lançamentos
          if ($bandeira) {

            # chamar a função do módulo
            print_r($issues);
            echo '<br>';
            print_r($despesas);
            echo '<br>';
            print_r($lancamentos);

          } else {

            # tentar exibir um botão voltar
            echo 
              '<p>
                <a class="btn btn-default" href="/avanco/capa/public/views/hours/edita_lancamentos.php?issue='.$_POST['issues']['issue'].'">
                  <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
                </a>
              </p>';

            exit;

          }

        }
        
      }

      ?>
    </div>
  </div>

</body>
</html>