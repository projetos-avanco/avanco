<?php

  require '../../../init.php';

  require DIRETORIO_MODULES  . 'profile/perfil.php';
  require DIRETORIO_REQUESTS . 'processa_perfil.php';
  require DIRETORIO_HELPERS  . 'verifica.php';
  require DIRETORIO_HELPERS  . 'profile/init_colaborador.php';

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
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/dashboard.css">
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

            <div class="col-sm-12"><!-- quarta coluna da linha -->
              <hr>
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
                            title='".$dashboard['titulos_conquistados']['data_premiacao'][$i]."'>";
                        break;

                      case '2':
                        $titulos .=
                          "<img src='".BASE_URL."public/img/titles/goleiro.png'
                            title='".$dashboard['titulos_conquistados']['data_premiacao'][$i]."'>";
                        break;

                      case '3':
                        $titulos .=
                          "<img src='".BASE_URL."public/img/titles/lateral.png'
                            title='".$dashboard['titulos_conquistados']['data_premiacao'][$i]."'>";
                        break;

                      case '4':
                        $titulos .=
                          "<img src='".BASE_URL."public/img/titles/meio_campo.png'
                            title='".$dashboard['titulos_conquistados']['data_premiacao'][$i]."'>";
                        break;

                      case '5':
                        $titulos .=
                          "<img src='".BASE_URL."public/img/titles/zagueiro.png'
                            title='".$dashboard['titulos_conquistados']['data_premiacao'][$i]."'>";
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
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                  </div>
                    <input type="text" class="form-control" name="data-1" value="<?php echo $dashboard['periodo']['data_1']; ?>">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
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
                  <h1  class="text-center resultados">
                  <?php
                    echo $dashboard['informacoes_gerais']['infovarejo']['quantidade_mes_artigos_infovarejo'];
                    echo '<span class="mes-total cor-cinza">Mês</span>' . '<span class="barras">/</span> ';
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
                  <h1  class="text-center resultados">
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
                  <h1  class="text-center resultados">
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
                  <h1  class="text-center resultados">
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

        </div><!--coluna 2 -->
      </div><!--linha 1 -->
    </div><!-- container -->
  </main><!-- conteúdo -->

  <footer><!-- rodapé -->

  </footer><!-- rodapé -->

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap-4.0.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>libs/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>public/js/bootstrap-datepicker/calendario.js"></script>
</body>
</html>
