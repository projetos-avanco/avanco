<?php

  require '../../../init.php';

  require DIRETORIO_MODULES  . 'profile/perfil.php';
  require DIRETORIO_REQUESTS . 'processa_perfil.php';
  require DIRETORIO_HELPERS  . 'profile/init_colaborador.php';
  require DIRETORIO_MODULES  . 'graphics/graficos.php';
  require DIRETORIO_HELPERS  . 'graphics/init_graficos.php' ;

  require DIRETORIO_HELPERS  . 'verifica.php';
#exit(var_dump($graficos));
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Perfil do Colaborador</title>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize-7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap-4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/fontes.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/dashboard.css">

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChartIntegral);
      google.charts.setOnLoadCallback(drawChartFrente);
      google.charts.setOnLoadCallback(drawChartGestor);

      /* Gráfico do Integral */
      function drawChartIntegral() {
        var data = google.visualization.arrayToDataTable([
          ['Módulos',     'Percentual'],
          ['Materiais',   <?php echo $graficos['integral']['materiais']; ?>],
          ['Fiscal',      <?php echo $graficos['integral']['fiscal']; ?>],
          ['Financeiro',  <?php echo $graficos['integral']['financeiro']; ?>],
          ['Contábil',    <?php echo $graficos['integral']['contabil']; ?>],
          ['Cotação Web', <?php echo $graficos['integral']['cotacao']; ?>],
          ['TNFE',        <?php echo $graficos['integral']['tnfe']; ?>],
          ['WMS',         <?php echo $graficos['integral']['wms']; ?>]
        ]);

        var options = {
          chart: {
            title: 'Gráfico de Conhecimento',
            subtitle: 'Nível de Conhecimento do Colaborador nos Módulos do Sistema Integral',
          },
          bars: 'horizontal',
          width: 1080,
          height: 600,
          hAxis: {
            format: 'decimal'
          },
          backgroundColor: '#151A20',
          colors: ['#009F45']
        };

        var chart = new google.charts.Bar(document.getElementById('integral'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
      /* Gráfico do Integral */

      /* Gráfico do Frente de Loja */
      function drawChartFrente() {
        var data = google.visualization.arrayToDataTable([
          ['Módulos',         'Percentual'],
          ['Frente Windows',  <?php echo $graficos['frente_de_loja']['frente_windows']; ?>],
          ['Frente Linux',    <?php echo $graficos['frente_de_loja']['frente_linux']; ?>],
          ['Supervisor',      <?php echo $graficos['frente_de_loja']['supervisor']; ?>],
          ['Scanntech',       <?php echo $graficos['frente_de_loja']['scanntech']; ?>],
          ['Sitef',           <?php echo $graficos['frente_de_loja']['sitef']; ?>],
          ['Comandas',        <?php echo $graficos['frente_de_loja']['comandas']; ?>]
        ]);

        var options = {
          chart: {
            title: 'Gráfico de Conhecimento',
            subtitle: 'Nível de Conhecimento do Colaborador nos Módulos do Frente de Loja',
          },
          bars: 'horizontal',
          width: 1080,
          height: 600,
          hAxis: {
            format: 'decimal'
          },
          backgroundColor: '#151A20',
          colors: ['#009F45']
        };

        var chart = new google.charts.Bar(document.getElementById('frente'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
      /* Gráfico do Frente de Loja */

      /* Gráfico do Gestor */
      function drawChartGestor() {
        var data = google.visualization.arrayToDataTable([
          ['Módulos',     'Percentual'],
          ['Instalação',  <?php echo $graficos['gestor']['instalacao']; ?>],
          ['Cadastro',    <?php echo $graficos['gestor']['cadastro']; ?>],
          ['Movimento',   <?php echo $graficos['gestor']['movimento']; ?>],
          ['Contábil',    <?php echo $graficos['gestor']['contabil']; ?>],
          ['Fiscal',      <?php echo $graficos['gestor']['fiscal']; ?>]
        ]);

        var options = {
          chart: {
            title: 'Gráfico de Conhecimento',
            subtitle: 'Nível de Conhecimento do Colaborador nos Módulos do Gestor',
          },
          bars: 'horizontal',
          width: 1080,
          height: 600,
          hAxis: {
            format: 'decimal'
          },
          backgroundColor: '#151A20',
          colors: ['#009F45']
        };

        var chart = new google.charts.Bar(document.getElementById('gestor'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
      /* Gráfico do Gestor */
    </script>
</head>

<body>

  <header><!-- cabeçalho -->
    <figure>
      <img src="<?php echo $dashboard['pessoal']['caminho_foto_bandeira'];?>" alt="Bandeira do Time" width="100%" height="100%">
    </figure>
  </header><!-- cabeçalho -->

  <main><!-- conteúdo -->
    <div class="container-fluid"><!-- container -->
      <div class="row"><!--linha 1 -->
        <div class="col-sm-4"><!--coluna 1 da linha 1 -->

          <div class="row bloco-pessoal"><!-- primeira linha da coluna 1 -->
            <div class="col-sm-12"><!-- primeira coluna da linha -->
              <div class="text-center">
                <img src="<?php echo $dashboard['pessoal']['caminho_foto_jogador'];?>" alt="Avatar" class="rounded-circle" width="70%" height="70%">
              </div>
            </div><!-- primeira coluna da linha -->

            <div class="col-sm-12"><!-- segunda coluna da linha -->
              <div class="text-center">
                <h2>
                <?php
                  echo $dashboard['pessoal']['nome'] . ' ' . $dashboard['pessoal']['sobrenome'];
                ?>
                </h2>
              </div>
            </div><!-- segunda coluna da linha -->

            <div class="col-sm-12"><!-- terceira coluna da linha -->
              <div class="text-center">
                <h5 id="nome-time">
                <?php
                  echo '#' . $dashboard['pessoal']['time'];
                ?>
                </h5>
              </div>
            </div><!-- terceira coluna da linha -->

            <hr>

            <div class="col-sm-12"><!-- quarta coluna da linha -->
              <div class="text-center" id="trofeu">
                <img src="<?php echo BASE_URL; ?>public/img/others/trofeu.png" alt="Troféu" width="8%" height="8%">
              </div>

              <div class="text-center">
                <h5 id="hall-da-fama">Hall da Fama</h5>
              </div>

              <!-- processando títulos conquistados -->
              <?php
                if ($dashboard['titulos_conquistados'] > 0) {

                  $titulos = '';

                  for ($i = 0; $i < count($dashboard['titulos_conquistados']['id']); $i++) {
                    switch ($dashboard['titulos_conquistados']['id'][$i]) {
                      case '1':
                        $titulos .=
                          "<img src='".BASE_URL."public/img/titles/artilheiro.png'
                            title='".$dashboard['titulos_conquistados']['data_premiacao'][$i]."' width='20%' height='20%'>";
                        break;

                      case '2':
                        $titulos .=
                          "<img src='".BASE_URL."public/img/titles/goleiro.png'
                            title='".$dashboard['titulos_conquistados']['data_premiacao'][$i]."' width='20%' height='20%'>";
                        break;

                      case '3':
                        $titulos .=
                          "<img src='".BASE_URL."public/img/titles/lateral.png'
                            title='".$dashboard['titulos_conquistados']['data_premiacao'][$i]."' width='20%' height='20%'>";
                        break;

                      case '4':
                        $titulos .=
                          "<img src='".BASE_URL."public/img/titles/meio_campo.png'
                            title='".$dashboard['titulos_conquistados']['data_premiacao'][$i]."' width='20%' height='20%'>";
                        break;

                      case '5':
                        $titulos .=
                          "<img src='".BASE_URL."public/img/titles/zagueiro.png'
                            title='".$dashboard['titulos_conquistados']['data_premiacao'][$i]."' width='20%' height='20%'>";
                        break;
                    }
                  }
                }
              ?>
              <!-- processando títulos conquistados -->

              <div class="text-center">
                <?php echo $titulos;?>
              </div>
            </div><!-- quarta coluna da linha -->
          </div><!-- primeira linha da coluna 1 -->
        </div><!--coluna 1 da linha 1 -->

        <div class="col-sm-8"><!--coluna 2 da linha 1-->

          <div class="row"><!-- primeira linha da coluna 2 -->
            <div class="col-sm-12"><!-- primeira coluna da linha -->
              <div class="text-right">
                <p>
                <?php if ($_SESSION['usuario']['nivel'] == 2) : ?>
                  <a class="text-right btn btn-success btn-sm" href="<?php echo BASE_URL; ?>public/views/profile/administrador.php">Voltar</a>
                <?php endif; ?>
                  <a class="text-right btn btn-success btn-sm" href="<?php echo BASE_URL; ?>app/modules/logout/logout.php">Deslogar</a>
                </p>
              </div>
            </div><!-- primeira coluna da linha -->
          </div><!-- primeira linha da coluna 2 -->

          <div class="row"><!-- segunda linha da coluna 2 -->
            <div class="col-sm-6"><!-- primeira coluna da linha -->
              <h2>Indicadores Chat</h2>
            </div><!-- primeira coluna da linha -->
          </div><!-- segunda linha da coluna 2 -->

          <div class="row"><!-- terceira linha da coluna 2 -->
            <div class="col-sm-6"></div>
            <div class="col-sm-6"><!-- segunda coluna da linha -->
              <form class="form-inline" method="post">
                <div class="input-group input-daterange">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar" aria-hidden="true"></i><span class="calendario">De: </span>
                  </div>
                    <input type="text" class="form-control" name="data-1" value="<?php echo $dashboard['periodo']['data_1']; ?>">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar" aria-hidden="true"></i><span class="calendario">Até: </span>
                  </div>
                    <input type="text" class="form-control" name="data-2" value="<?php echo $dashboard['periodo']['data_2']; ?>">
                    <button type="submit" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
              </form>
            </div><!-- segunda coluna da linha -->
          </div><!-- terceira linha da coluna 2 -->

          <div class="row"><!-- quarta linha da coluna 2 -->
            <div class="col-sm-12"><!-- primeira coluna da linha -->
              <h4 class="text-center">Atendimentos</h4>
            </div><!-- primeira coluna da linha -->
          </div><!-- quarta linha da coluna 2 -->

          <div class="row"><!-- quinta linha da coluna 2 -->
            <div class="col-sm-3"><!-- primeira coluna da linha -->
              <div class="text-left">
                <p>Realizados</p>
                <h1 class="resultados">
                <?php
                  echo $dashboard['indicadores_chat']['atendimentos_realizados'];
                ?>
                </h1>
              </div>
            </div><!-- primeira coluna da linha -->

            <div class="col-sm-3"><!-- segunda coluna da linha -->
              <div class="text-left">
                <p>Demandados</p>
                <h1 class="resultados">
                <?php
                  echo $dashboard['indicadores_chat']['atendimentos_demandados'];
                ?>
                </h1>
              </div>
            </div><!-- segunda coluna da linha -->

            <div class="col-sm-3"><!-- terceira coluna da linha -->
              <div class="text-left">
                <p>Taxa de Perda</p>
                <h1 class="resultados">
                <?php
                  echo $dashboard['indicadores_chat']['percentual_perda'] . '<span class="cor-cinza">%</span>';
                ?>
                </h1>
              </div>
            </div><!-- terceira coluna da linha -->

            <div class="col-sm-3"><!-- quarta coluna da linha -->
              <div class="text-left">
                <p>TMA</p>
                <h1 class="resultados">
                <?php
                  echo $dashboard['indicadores_chat']['tma'] . '<span class="tma cor-cinza">min<span>';
                ?>
                </h1>
              </div>
            </div><!-- quarta coluna da linha -->
          </div><!-- quinta linha da coluna 2 -->

          <div class="row"><!-- sexta linha da coluna 2 -->
            <div class="col-sm-3"><!-- primeira coluna da linha -->
              <div class="text-left">
                <p>Fila até 15 Minutos</p>
                <h1 class="resultados">
                <?php
                  echo $dashboard['indicadores_chat']['percentual_fila_ate_15_minutos'] . '<span class="cor-cinza">%</span>';
                ?>
                </h1>
              </div>
            </div><!-- primeira coluna da linha -->

            <div class="col-sm-3"><!-- segunda coluna da linha -->
              <div class="text-left">
                <p>Avancino</p>
                <h1 class="resultados">
                <?php
                  echo $dashboard['indicadores_chat']['percentual_avancino'] . '<span class="cor-cinza">%</span>';
                ?>
                </h1>
              </div>
            </div><!-- segunda coluna da linha -->

            <div class="col-sm-3"><!-- terceira coluna da linha -->
              <div class="text-left">
                <p>Eficiência</p>
                <h1 class="resultados">
                <?php
                  echo $dashboard['indicadores_chat']['percentual_eficiencia'] . '<span class="cor-cinza">%</span>';
                ?>
                </h1>
              </div>
            </div><!-- terceira coluna da linha -->

            <div class="col-sm-3"><!-- quarta coluna da linha -->
              <div class="text-left">
                <p>Questionário</p>
                <h1 class="resultados">
                <?php
                  echo $dashboard['indicadores_chat']['percentual_questionario_respondido'] . '<span class="cor-cinza">%</span>';
                ?>
                </h1>
              </div>
            </div><!-- quarta coluna da linha -->
          </div><!-- sexta linha da coluna 2 -->

          <div class="row"><!-- sétima linha da coluna 2 -->
            <div class="col-sm-6"><!-- primeira coluna da linha -->
              <h2>Informações Gerais</h2>
            </div><!-- primeira coluna da linha -->
          </div><!-- sétima linha da coluna 2 -->

          <div class="row"><!-- oitava linha da coluna 2 -->
            <div class="col-sm-12"><!-- primeira coluna da linha -->
              <h4 class="text-center">Artigos Documentos SLA</h4>
            </div><!-- primeira coluna da linha -->
          </div><!-- oitava linha da coluna 2 -->

          <div class="row"><!-- nona linha da coluna 2 -->
            <div class="col-sm-3"><!-- primeira coluna da linha -->
              <div class="card"><!-- card -->
                <div class="card-header text-center">
                  <p class="info-gerais">
                    <a href="http://www.infovarejo.com.br<?php echo $info; ?>" class="links" target="_blank">
                      Artigos InfoVarejo
                    </a>
                  </p>
                </div>
                <div class="card-body">
                  <h1  class="text-center resultados-gerais">
                  <?php
                    echo $dashboard['informacoes_gerais']['infovarejo']['quantidade_mes_artigos_infovarejo'];
                    echo '<span class="mes-total cor-cinza">Mês</span>' . '<span class="cor-cinza">/</span> ';
                    echo $dashboard['informacoes_gerais']['infovarejo']['quantidade_total_artigos_infovarejo'];
                    echo '<span class="mes-total cor-cinza">Total</span>';
                  ?>
                  </h1>
                </div>
              </div><!-- card -->
            </div><!-- primeira coluna da linha -->

            <div class="col-sm-3"><!-- segunda coluna da linha -->
              <div class="card"><!-- card -->
                <div class="card-header text-center">
                  <p class="info-gerais">
                    <a href="http://bc.avancoinfo.com.br/dosearchsite.action?cql=siteSearch+~+%22<?php echo $base; ?>%22+and+space+%3D+%22AV%22&queryString=<?php echo $base; ?>" class="links" target="_blank">
                    Documentos B.C
                  </p>
                </a>
                </div>
                <div class="card-body">
                  <h1  class="text-center resultados-gerais">
                  <?php
                    echo $dashboard['informacoes_gerais']['base_conhecimento']['quantidade_mes_documentos_bc'];
                    echo '<span class="mes-total cor-cinza">Mês</span>' . '<span class="cor-cinza">/</span> ';
                    echo $dashboard['informacoes_gerais']['base_conhecimento']['quantidade_total_documentos_bc'];
                    echo '<span class="mes-total cor-cinza">Total</span>';
                  ?>
                  </h1>
                </div>
              </div><!-- card -->
            </div><!-- segunda coluna da linha -->

            <div class="col-sm-3"><!-- terceira coluna da linha -->
              <div class="card"><!-- card -->
                <div class="card-header text-center">
                  <p class="info-gerais">
                    SLA do Mês
                  </p>
                </div>
                <div class="card-body">
                  <h1  class="text-center resultados-gerais">
                  <?php
                    echo $dashboard['informacoes_gerais']['sla']['percentual_mes_sla'] . '<span class="cor-cinza">%</span>';
                  ?>
                  </h1>
                </div>
              </div><!-- card -->
            </div><!-- terceira coluna da linha -->

            <div class="col-sm-3"><!-- quarta coluna da linha -->
              <div class="card"><!-- card -->
                <div class="card-header text-center">
                  <p class="info-gerais">
                    SLA Total
                  </p>
                </div>
                <div class="card-body">
                  <h1  class="text-center resultados-gerais">
                  <?php
                    echo $dashboard['informacoes_gerais']['sla']['percentual_total_sla'] . '<span class="cor-cinza">%</span>';
                  ?>
                  </h1>
                </div>
              </div><!-- card -->
            </div><!-- quarta coluna da linha -->
          </div><!-- nona linha da coluna 2 -->

          <div class="row"><!-- décima linha da coluna 2 -->
            <div class="col-sm-12"><!-- primeira coluna da linha -->
              <h2>Conhecimento Técnico</h2>
            </div><!-- primeira coluna da linha -->
          </div><!-- décima linha da coluna 2 -->

          <div class="row"><!-- décima primeira linha da coluna 2 -->
            <div class="col-sm-12"><!-- primeira coluna da linha -->
              <h4 class="text-center">Integral</h4>
            </div><!-- primeira coluna da linha -->
          </div><!-- décima primeira linha da coluna 2 -->

          <div class="row"><!-- décima segunda linha da coluna 2 -->
            <div class="col-sm-12"><!-- primeira coluna da linha -->
              <div id="integral" style="width: 1000px; height: 600px;"></div>
            </div><!-- primeira coluna da linha -->
          </div><!-- décima segunda linha da coluna 2 -->

          <div class="row"><!-- décima terceira linha da coluna 2 -->
            <div class="col-sm-12"><!-- primeira coluna da linha -->
              <h4 class="text-center">Frente de Loja</h4>
            </div><!-- primeira coluna da linha -->
          </div><!-- décima terceira linha da coluna 2 -->

          <div class="row"><!-- décima quarta linha da coluna 2 -->
            <div class="col-sm-12"><!-- primeira coluna da linha -->
              <div id="frente" style="width: 1000px; height: 600px;"></div>
            </div><!-- primeira coluna da linha -->
          </div><!-- décima quarta linha da coluna 2 -->

          <div class="row"><!-- décima quinta linha da coluna 2 -->
            <div class="col-sm-12"><!-- primeira coluna da linha -->
              <h4 class="text-center">Gestor</h4>
            </div><!-- primeira coluna da linha -->
          </div><!-- décima quinta linha da coluna 2 -->

          <div class="row"><!-- décima sexta linha da coluna 2 -->
            <div class="col-sm-12"><!-- primeira coluna da linha -->
              <div id="gestor" style="width: 1000px; height: 600px;"></div>
            </div><!-- primeira coluna da linha -->
          </div><!-- décima sexta linha da coluna 2 -->

        </div><!--coluna 2 -->
      </div><!--linha 1 -->
    </div><!-- container -->
  </main><!-- conteúdo -->

  <footer><!-- rodapé -->
    <div class="container-fluid">
      <div class="row justify-content-sm-center">
        <div class="col-sm-auto text-center">
          <h5 id="avancao">Avanção 2017</h5>
        </div>
      </div>
    </div>
  </footer><!-- rodapé -->

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap-4.0.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>libs/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>public/js/bootstrap-datepicker/calendario.js"></script>
</body>
</html>
