<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('pesquisa_externa.php')) : ?>

<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {    
    require_once DIRETORIO_MODULES . 'schedule/modulo_pesquisa.php';

    $db = abre_conexao();

    $pesquisa = array(
      'id' => null,
      'supervisor' => null,
      'status' => 2,
      'qualidade' => null,
      'entrega' => null,
      'consideracoes' => null,    
      'registrado' => null
    );

    $flag = false;

    $erros = array(
      'exibe' => false,
      'tipo' => 'success',
      'mensagens' => array()
    );

    if (!empty($_POST['pesquisa']['id'])) {
      if (is_numeric($_POST['pesquisa']['id'])) {
        $pesquisa['id'] = (int)$_POST['pesquisa']['id'];
      } else {
        $flag = true;
        $erros['mensagens'][] = 'O tipo de dados do id da pesquisa está incorreto.';
      }
    } else {
      $flag = true;
      $erros['mensagens'][] = 'O id da pesquisa não foi enviado. Informe ao Wellington Felix.';
    }

    if (!empty($_POST['pesquisa']['supervisor'])) {
      if (is_numeric($_POST['pesquisa']['supervisor'])) {
        $pesquisa['supervisor'] = (int)$_POST['pesquisa']['supervisor'];
      } else {
        $flag = true;
        $erros['mensagens'][] = 'O tipo de dados do código do supervisor está incorreto.';
      }
    } else {
      $flag = true;
      $erros['mensagens'][] = 'O código do supervisor não foi enviado. Informe ao Wellington Felix.';
    }

    if (!empty($_POST['pesquisa']['qualidade'])) {
      if (is_numeric($_POST['pesquisa']['qualidade'])) {
        $pesquisa['qualidade'] = $_POST['pesquisa']['qualidade'];
      } else {
        $flag = true;
        $erros['mensagens'][] = 'O tipo de dados da qualidade do serviço está incorreto.';
      }
    } else {
      $flag = true;
      $erros['mensagens'][] = 'O nível de qualidade do serviço prestado não foi enviado.';
    }

    if (!empty($_POST['pesquisa']['entrega'])) {
      if (is_numeric($_POST['pesquisa']['entrega'])) {
        $pesquisa['entrega'] = $_POST['pesquisa']['entrega'];
      } else {
        $flag = true;
        $erros['mensagens'][] = 'O tipo de dados da entrega está incorreto.';
      }
    } else {
      $flag = true;
      $erros['mensagens'][] = 'Não foi informado se a demanda do cliente foi resolvida.';
    }

    if (!empty($_POST['pesquisa']['consideracoes'])) {
      if (is_string($_POST['pesquisa']['consideracoes'])) {
        $pesquisa['consideracoes'] = addslashes(mb_strtolower($_POST['pesquisa']['consideracoes'], 'utf-8'));
        $pesquisa['consideracoes'] = trim(str_replace("\r\n", ' ', $pesquisa['consideracoes']));
      } else {
        $flag = true;
        $erros['mensagens'][] = 'O tipo de dados das considerações está incorreto.';
      }
    } else {
      $pesquisa['observacao'] = '';
    }

    $pesquisa['registrado'] = date('Y-m-d H:i:s');

    if ($flag) {
      $erros['exibe'] = true;
      $erros['tipo'] = 'danger';
    } else {
      
      # chamando função responsável por receber e atualizar os dados da pesquisa
      recebePesquisaExterna($pesquisa);
    }
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Pesquisa Externa</title>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap_3.3.7.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/fontes.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/home.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/sidebar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbar.css">

  <!-- dispositivos com largura máxima de 769px (por exemplo tablets) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbartablet.css" type="text/css" media="screen and (max-width: 769px)" />
  <!-- dispositivos com largura máxima de 450px (por exemplo smartphones) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbarsmart.css" type="text/css" media="screen and (max-width:450px)" />

  <style>
    .erro {
      border: 2px solid red;
    }

    h5 {
      font-size: 1.1em;
    }
  </style>
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <h2>Pesquisa Externa</h2>
              <hr>
            </div>
          </div>
        </div>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

          <div class="row"><!-- linha principal -->
            <div class="col-sm-8 col-sm-offset-2"><!-- primeira coluna principal -->

              <div class="panel panel-info"><!-- panel -->
                <div class="panel-heading">
                  <div class="text-left">
                    <strong>Pesquisa</strong>
                  </div>
                </div>

                <div class="panel-body"><!-- panel-body -->                
                  <div class="row">
                    <div class="col-sm-12">
                      <h5>Clareza e objetividade, atenção no serviço prestado (Qualidade do Serviço):</h5>

                      <div class="form-group">                        
                        <label class="sr-only" for="qualidade">Qualidade do Serviço</label>
                        <div class="radio">
                          <label>
                            <input id="qualidade" type="radio" name="pesquisa[qualidade]" value="1" checked>
                            1
                          </label>
                        </div>

                        <div class="radio">
                          <label>
                            <input id="qualidade" type="radio" name="pesquisa[qualidade]" value="2">
                            2
                          </label>
                        </div>

                        <div class="radio">
                          <label>
                            <input id="qualidade" type="radio" name="pesquisa[qualidade]" value="3">
                            3
                          </label>
                        </div>

                        <div class="radio">
                          <label>
                            <input id="qualidade" type="radio" name="pesquisa[qualidade]" value="4">
                            4
                          </label>
                        </div>

                        <div class="radio">
                          <label>
                            <input id="qualidade" type="radio" name="pesquisa[qualidade]" value="5">
                            5
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <h5>O objetivo da visita foi atendido? Sua questão foi resolvida? (Entrega - Foi Resolvido?):</h5>

                      <div class="form-group">                        
                        <label class="sr-only" for="entrega">Entrega</label>
                        <div class="radio">
                          <label>
                            <input id="entrega" type="radio" name="pesquisa[entrega]" value="1" checked>
                            Sim
                          </label>
                        </div>

                        <div class="radio">
                          <label>
                            <input id="entrega" type="radio" name="pesquisa[entrega]" value="2">
                            Não
                          </label>
                        </div>

                        <div class="radio">
                          <label>
                            <input id="entrega" type="radio" name="pesquisa[entrega]" value="3">
                            Em Partes
                          </label>
                        </div>                        
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <h5>Deixe abaixo suas considerações ou sugestões e nos ajude a melhorar a qualidade dos nossos serviços externos:</h5><br>

                      <div class="form-group">
                        <label class="sr-only" for="consideracoes">Considerações</label>
                        <textarea class="form-control required" id="consideracoes" name="pesquisa[consideracoes]" rows="4" cols="30" placeholder="Sua resposta..."></textarea>
                      </div>
                    </div>
                  </div>
                </div><!-- panel-body -->
              </div><!-- panel -->

              <!-- recuperando o id da pesquisa externa -->
              <input type="hidden" name="pesquisa[id]" value="<?php echo $_GET['id']; ?>">

              <!-- recuperando o id do supervisor que está logado -->
              <input type="hidden" name="pesquisa[supervisor]" value="<?php echo $_SESSION['usuario']['id']; ?>">

              <div class="row">
                <div class="col-sm-3 col-sm-offset-6">
                  <div class="form-group">
                    <button class="btn btn-block btn-default btn-sm" id="btn-voltar" type="reset">
                      <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
                      Voltar
                    </button>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <button class="btn btn-block btn-success btn-sm" type="submit">
                      <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
                      Gravar
                    </button>
                  </div>
                </div>
              </div>

            </div><!-- primeira coluna principal -->
          </div><!-- linha principal -->

        </form>

        <?php if ((!empty($erros['mensagens'])) && $erros['exibe'] == true) : ?>

          <?php for ($i = 0; $i < count($erros['mensagens']); $i++) : ?>
            <div class="row">
              <div class="col-sm-12">
                <div class="text-center">
                  <div class="alert alert-<?php echo $erros['tipo']; ?>" role="alert">
                      <?php if ($erros['tipo'] == 'danger') : ?>
                        <strong>Ops!</strong>
                      <?php else : ?>
                        <strong>Tudo Certo!</strong>
                      <?php endif; ?>

                      <?php echo $erros['mensagens'][$i]; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endfor; ?>

      <?php endif; ?>

      <?php if ((!empty($_SESSION['atividades']['mensagens'])) && $_SESSION['atividades']['exibe'] == true) : ?>

        <div class="row">
          <div class="col-sm-12">
            <div class="text-center">
              <div class="alert alert-<?php echo $_SESSION['atividades']['tipo']; ?>" role="alert">
                  <?php if ($_SESSION['atividades']['tipo'] == 'danger') : ?>
                    <strong>Ops!</strong>
                  <?php else : ?>
                    <strong>Tudo Certo!</strong>
                  <?php endif; ?>

                  <?php echo $_SESSION['atividades']['mensagens']; ?>
              </div>
            </div>
          </div>
        </div>

      <?php endif; ?>

      <?php unset($_SESSION['atividades'], $_SESSION['registro']); ?>

      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/avancoins/colaboradores.js"></script>

  <script>
    $(function() {
      // voltando para página de relatório de atrasos
      $(document).on('click', '#btn-voltar', function(e) {
        e.preventDefault;

        var url = window.location.href;
        var tmp = url.split('/');

        url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/public/views/schedule/gerencial_atendimento_externo.php';
        
        window.open(url, '_self');
      });
    });
  </script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
