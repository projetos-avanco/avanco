<?php

  require '../../../init.php';

  require DIRETORIO_MODULES  . 'profile/perfil.php';
  require DIRETORIO_REQUESTS . 'processa-perfil.php';
  require DIRETORIO_HELPERS  . 'verifica.php';

  # verificando se os dados do colaborador foram consultados no chat
  if (isset($_SESSION['colaborador'])) {

    # verificando se os dados do colaborador foram inseridos ou atualizados na tabela
    if ($_SESSION['colaborador']['id'] != '0' && $_SESSION['colaborador']['tipo'] == 1) {

      # chamando função que gera (busca e retorna os dados processados na tabela) a sessão com os dados para o navegador
      geraDadosParaDashboard($_SESSION['colaborador']['id']);

      # recuperando dados que serão exibidos no dashboard
      $dashboard  = $_SESSION['navegador']['dashboard'];

      # verificando se os dados do colaborador não foram inseridos ou atualizados na tabela
    } elseif ($_SESSION['colaborador']['id'] == '0' && $_SESSION['colaborador']['tipo'] == 2) {

      echo 'query INSERT ou UPDATE não foi executada!';

      # verificando se o usuário que requisitou a página possui cadastro no chat
    } elseif ($_SESSION['colaborador']['id'] == '0' && $_SESSION['colaborador']['tipo'] == 3) {

      echo 'usuário não existe na base de dados do chat!';

    }

    # eliminando sessões
    unset($_SESSION['colaborador'], $_SESSION['navegador']['dashboard'], $_SESSION['navegador']['documentos']);

  }

  # nome para o link da base de conhecimento
  $bc =
    strtolower(removeAcentos($dashboard['pessoal']['nome'])) .
    strtolower(removeAcentos($dashboard['pessoal']['sobrenome']));

  # nome para o link do infovarejo
  $info = '/author/' .
    strtolower(removeAcentos($dashboard['pessoal']['nome'])) .
    '-' .
    strtolower(removeAcentos($dashboard['pessoal']['sobrenome']));

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Perfil do Colaborador</title>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize-7.0.0.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/style.css">
</head>

<body>

  <div class="container-fluid">
    <header>
      <img src="#" alt="Imagem" width="100%" height="100%">
      <p><a class="text-right btn btn-primary" href="<?php echo BASE_URL; ?>app/modules/logout/logout.php">Deslogar</a></p>
    </header>

    <main>
      <div class="row">
        <div class="col-md-4">
          <div class="text-center">
            <img src="<?php echo $dashboard['pessoal']['caminho_foto'];?>" alt="Avatar" class="rounded-circle" width="50%" height="50%">
              <br><br>
            <h4><?php echo $dashboard['pessoal']['nome'] . ' ' . $dashboard['pessoal']['sobrenome']; ?></h4>
            <h5>#<?php echo $dashboard['pessoal']['time']?></h5>
              <hr>
            <i class="fa fa-trophy fa-2x" aria-hidden="true"></i>
              <br><br>
            <h5>Hall da Fama</h5>
          </div>
        </div>

        <div class="col-md-4">
          <h2>Indicadores Chat</h2>

          <br>

          <div class="text-center">
            <h4>Atendimentos</h4>
          </div>

          <br>

          <div class="row"><!-- linha do card -->
            <div class="col-md-6"><!-- coluna do card -->
              <div class="card"><!-- card -->
                <div class="card-header text-center">
                  Realizados / Solicitados
                </div>
                <div class="card-body">
                  <h4 class="text-center">
                  <?php
                    echo $dashboard['indicadores_chat']['atendimentos_realizados'];
                    echo ' / ';
                    echo $dashboard['indicadores_chat']['atendimentos_demandados'];
                  ?>
                  </h4>
                </div>
              </div><!-- card -->
            </div><!-- coluna do card -->

            <div class="col-md-6"><!-- coluna do card -->
              <div class="card"><!-- card -->
                <div class="card-header text-center">
                  Taxa de Perda
                </div>
                <div class="card-body">
                  <h4 class="text-center">
                  <?php
                    echo $dashboard['indicadores_chat']['percentual_perda'] . '%';
                  ?>
                  </h4>
                </div>
              </div><!-- card -->
            </div><!-- coluna do card -->
          </div><!-- linha do card -->

          <br><br>

          <div class="row"><!-- linha do card -->
            <div class="col-md-6"><!-- linha do card -->
              <div class="card"><!-- card -->
                <div class="card-header text-center">
                  Avancino
                </div>
                <div class="card-body">
                  <h4 class="text-center">
                  <?php
                    echo $dashboard['indicadores_chat']['percentual_avancino'] . '%';
                  ?>
                  </h4>
                </div>
              </div><!-- card -->
            </div><!-- coluna do card -->

            <div class="col-md-6"><!-- coluna do card -->
              <div class="card"><!-- card -->
                <div class="card-header text-center">
                  Eficiência
                </div>
                <div class="card-body">
                  <h4 class="text-center">
                  <?php
                    echo $dashboard['indicadores_chat']['percentual_eficiencia'] . '%';
                  ?>
                  </h4>
                </div>
              </div><!-- card -->
            </div><!-- coluna do card -->
          </div><!-- linha do card -->
        </div>

        <div class="col-md-4">
          <form class="form-inline" method="post">
            <div class="input-group input-daterange">
              <div class="input-group-addon">
                <i class="fa fa-calendar" aria-hidden="true"></i>
              </div>
              <input type="text" class="form-control" name="data-1" value="<?php echo $dashboard['periodo']['data_1']; ?>">
              <div class="input-group-addon">
                <i class="fa fa-calendar" aria-hidden="true"></i>
              </div>
              <input type="text" class="form-control" name="data-2" value="<?php echo $dashboard['periodo']['data_2']; ?>">
              <button type="submit" class="btn btn-outline-primary">Pesquisar</button>
            </div>
          </form>

          <div class="row altura"><!-- linha do card -->
            <div class="col-md-6"><!-- coluna do card -->
              <div class="card"><!-- card -->
                <div class="card-header text-center">
                  Fila até 15 Minutos
                </div>
                <div class="card-body">
                  <h4 class="text-center">
                  <?php
                    echo $dashboard['indicadores_chat']['percentual_fila_ate_15_minutos'] . '%';
                  ?>
                  </h4>
                </div>
              </div><!-- card -->
            </div><!-- coluna do card -->

            <div class="col-md-6"><!-- coluna do card -->
              <div class="card"><!-- card -->
                <div class="card-header text-center">
                  TMA
                </div>
                <div class="card-body">
                  <h4 class="text-center">
                  <?php
                    echo $dashboard['indicadores_chat']['tma'] . ' min';
                  ?>
                  </h4>
                </div>
              </div><!-- card -->
            </div><!-- coluna do card -->
          </div><!-- linha do card -->

          <br><br>

          <div class="row">
            <div class="col-md-6">
              <div class="card"><!-- card -->
                <div class="card-header text-center">
                  Questionário
                </div>
                <div class="card-body">
                  <h4 class="text-center">
                  <?php
                    echo $dashboard['indicadores_chat']['percentual_questionario_respondido'] . '%';
                  ?>
                  </h4>
                </div>
              </div><!-- card -->
            </div><!-- coluna do card -->
          </div><!-- linha do card -->

        </div>
      </div><!-- linha -->

      <br>

      <div class="row">
        <div class="col-md-4"></div>

        <div class="col-md-8">
          <h2>Informações Gerais</h2>

          <br>

          <div class="row"><!-- linha do card -->
          <div class="col-md-3"><!-- coluna do card -->
            <div class="card"><!-- card -->
              <div class="card-header text-center">
                <a href="http://www.infovarejo.com.br<?php echo $info; ?>" target="_blank">Artigos do InfoVarejo</a>
              </div>
              <div class="card-body">
                <h4 class="text-center">
                <?php
                  echo $dashboard['informacoes_gerais']['infovarejo']['quantidade_mes_artigos_infovarejo'];
                  echo ' Mês' . ' / ';
                  echo $dashboard['informacoes_gerais']['infovarejo']['quantidade_total_artigos_infovarejo'];
                  echo ' Total';
                ?>
                </h4>
              </div>
            </div><!-- card -->
          </div><!-- coluna do card -->

          <div class="col-md-3"><!-- coluna do card -->
            <div class="card"><!-- card -->
              <div class="card-header text-center">
                <a href="http://bc.avancoinfo.com.br/dosearchsite.action?cql=siteSearch+~+%22<?php echo $bc; ?>%22+and+space+%3D+%22AV%22&queryString=<?php echo $bc; ?>" target="_blank">
                  Documentos B.C
                </a>
              </div>
              <div class="card-body">
                <h4 class="text-center">
                  <?php
                    echo $dashboard['informacoes_gerais']['base_conhecimento']['quantidade_mes_documentos_bc'];
                    echo ' Mês' . ' / ';
                    echo $dashboard['informacoes_gerais']['base_conhecimento']['quantidade_total_documentos_bc'];
                    echo ' Total';
                  ?>
                </h4>
              </div>
            </div><!-- card -->
          </div><!-- coluna do card -->

          <div class="col-md-3"><!-- coluna do card -->
            <div class="card"><!-- card -->
              <div class="card-header text-center">
                SLA Último Mês
              </div>
              <div class="card-body">
                <h4  class="text-center">
                  <?php
                    echo $dashboard['informacoes_gerais']['sla']['percentual_mes_sla'] . '%';
                  ?>
                </h4>
              </div>
            </div><!-- card -->
          </div><!-- coluna do card -->

          <div class="col-md-3"><!-- coluna do card -->
            <div class="card"><!-- card -->
              <div class="card-header text-center">
                SLA Total
              </div>
              <div class="card-body">
                <h4  class="text-center">
                  <?php
                    echo $dashboard['informacoes_gerais']['sla']['percentual_total_sla'] . '%';
                  ?>
                </h4>
              </div>
            </div><!-- card -->
          </div><!-- coluna do card -->
        </div><!-- linha do card -->

        </div>
      </div><!-- linha -->

      <div class="row">
        <div class="col-md-4"></div>

        <div class="col-md-8">
          <h2>Conhecimento Técnico</h2>
        </div>
      </div><!-- linha -->
    </main>

    <footer>
      <h4 class="text-center">Avanção 2017</h4>
    </footer>
  </div><!-- container -->

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>libs/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>public/js/bootstrap-datepicker/calendario.js"></script>
</body>
</html>
