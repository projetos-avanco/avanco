<?php

  require '../../../init.php';

  require DIRETORIO_MODULES  . 'profile/perfil.php';
  require DIRETORIO_REQUESTS . 'processa-perfil.php';

  # verificando se os dados do colaborador foram consultados no chat
  if (isset($_SESSION['colaborador'])) {

    # verificando se os dados do colaborador foram inseridos ou atualizados na tabela
    if ($_SESSION['colaborador']['id'] != '0' && $_SESSION['colaborador']['tipo'] == '1') {

      # chamando função que gera (busca e retorna os dados processados na tabela) a sessão com os dados para o navegador
      geraDadosParaDashboard($_SESSION['colaborador']['id']);

      # recuperando dados que serão exibidos no dashboard
      $dashboard  = $_SESSION['navegador']['dashboard'];
      $documentos = $_SESSION['navegador']['documentos'];

      # verificando se os dados do colaborador não foram inseridos ou atualizados na tabela
    } elseif ($_SESSION['colaborador']['id'] == '0' && $_SESSION['colaborador']['tipo'] == '2') {

      echo 'query INSERT ou UPDATE não foi executada!';

      # verificando se o usuário que requisitou a página possui cadastro no chat
    } elseif ($_SESSION['colaborador']['id'] == '0' && $_SESSION['colaborador']['tipo'] == '3') {

      echo 'usuário não existe na base de dados do chat!';

    }

    # eliminando sessões
    unset($_SESSION['colaborador'], $_SESSION['navegador']['dashboard'], $_SESSION['navegador']['documentos']);

  }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Perfil do Colaborador</title>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize-7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/style.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/datetimepicker/css/jquery.datetimepicker.css" media="screen">

</head>
<body>
  <div class="container-fluid">
    <h1>DASHBOARD DO COLABORADOR</h1>

    <div class="row">
      <div class="col align-self-center">
        <form action="" method="post" class="form-horizontal"  role="form">
            <input id="date_timepicker_start" type="text" name="datas[data-1]">
            <input id="date_timepicker_end" type="text" name="datas[data-2]">
            <input type="submit" value="Gerar" >
        </form>
      </div>
    </div>

    <div class="row"><!-- linha 1 -->
      <div class="col-md-3">
        <h4 class="text-center"><?php echo $dashboard['pessoal']['nome'] . ' ' . $dashboard['pessoal']['sobrenome']; ?></h4>

        <img src="<?php
          echo $dashboard['pessoal']['caminho_foto'];
          ?>" alt="Avatar" class="rounded-circle" width="100%" height="100%">
      </div>

      <div class="col-md-4">
        <h4>Indicadores Chat</h4>

        <table class="table table-sm">
          <tr>
            <th>Período de <?php echo $dashboard['periodo']['data_1']; ?> até <?php echo $dashboard['periodo']['data_2']; ?></th>
          </tr>
          <tr>
            <th>Atendimentos Demandados:</th>
            <td><?php echo $dashboard['indicadores_chat']['atendimentos_demandados']; ?></td>
          </tr>
          <tr>
            <th>Atendimentos Realizados:</th>
            <td><?php echo $dashboard['indicadores_chat']['atendimentos_realizados']; ?></td>
          </tr>
          <tr>
            <th>Taxa de Perda:</th>
            <td><?php echo $dashboard['indicadores_chat']['percentual_perda'] . '%'; ?></td>
          </tr>
          <tr>
            <th>Fila até 15 Minutos:</th>
            <td><?php echo $dashboard['indicadores_chat']['percentual_fila_ate_15_minutos'] . '%'; ?></td>
          </tr>
          <tr>
            <th>TMA:</th>
            <td><?php echo $dashboard['indicadores_chat']['tma'] . ' min'; ?></td>
          </tr>
          <tr>
            <th>Avancino:</th>
            <td><?php echo $dashboard['indicadores_chat']['percentual_avancino'] . '%'; ?></td>
          </tr>
          <tr>
            <th>Eficiência:</th>
            <td><?php echo $dashboard['indicadores_chat']['percentual_eficiencia'] . '%'; ?></td>
          </tr>
          <tr>
            <th>Questionário Interno:</th>
            <td><?php echo $dashboard['indicadores_chat']['percentual_questionario_respondido'] . '%'; ?></td>
          </tr>
        </table>
      </div>

      <div class="col-md-5">
        <h4>Gráficos</h4>
      </div>
    </div><!-- linha 1 -->

    <div class="row"><!-- linha 2 -->
      <div class="col-md-3">
        <h4>Títulos Conquistados</h4>

        <table class="table table-sm">
        <?php foreach ($dashboard['titulos_conquistados']['nome'] as $chave => $valor) : ?>
          <tr>
            <th><?php echo $valor; ?></th>
          </tr>
        <?php endforeach; ?>
        </table>
      </div>

      <div class="col-md-4">
        <h4>Informações Gerais</h4>

        <table class="table table-sm">
          <tr><!-- infovarejo -->
            <th>Artigos no Infovarejo:</th>
            <td>
              <?php
                echo $dashboard['informacoes_gerais']['infovarejo']['quantidade_mes_artigos_infovarejo'];
                echo ' / Mês' . ' - ';
                echo $dashboard['informacoes_gerais']['infovarejo']['quantidade_total_artigos_infovarejo'];
                echo ' / Total';
              ?>
            </td>
          </tr><!-- infovarejo -->

          <tr><!-- base de conhecimento -->
            <th>Documentos BC:</th>
            <td>
              <?php
                echo $dashboard['informacoes_gerais']['base_conhecimento']['quantidade_mes_documentos_bc'];
                echo ' / Mês' . ' - ';
                echo $dashboard['informacoes_gerais']['base_conhecimento']['quantidade_total_documentos_bc'];
                echo ' / Total';
              ?>
            </td>
          </tr><!-- base de conhecimento -->

          <tr><!-- sla -->
            <th>SLA:</th>
            <td>
              <?php
                echo $dashboard['informacoes_gerais']['sla']['percentual_mes_sla'];
                echo '% / Mês' . ' - ';
                echo $dashboard['informacoes_gerais']['sla']['percentual_total_sla'];
                echo '% / Total';
              ?>
            </td>
          </tr><!-- sla -->
        </table>
      </div>

      <div class="col-md-5">
        <h4>Gráficos</h4>
      </div>
    </div><!-- linha 2 -->

    <div class="row"><!-- linha 3 -->
      <div class="col-md-12">
        <table class="table table-striped">
          <tr>
            <th>Nome</th>
            <th>Postado</th>
          </tr>
        <?php foreach ($documentos['nome'] as $nomeChave => $nomeValor) : ?>
          <?php foreach ($documentos['data_postagem'] as $dataChave => $dataValor) : ?>
            <tr>
              <td><?php echo $nomeValor; ?></td>
              <td><?php echo $dataValor; ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endforeach; ?>
        </table>
      </div>
    </div><!-- linha 3 -->
  </div>

  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery-3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/datetimepicker/js/jquery.datetimepicker.full.min.js" charset="UTF-8"></script>
  <script type="text/javascript">

    jQuery(function(){

      $.datetimepicker.setLocale('pt-BR');
     jQuery('#date_timepicker_start').datetimepicker({
      format:'Y-m-d',
      onShow:function( ct ){
       this.setOptions({
        maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false

      });
      },
      timepicker:false
     });


     jQuery('#date_timepicker_end').datetimepicker({
      format:'Y-m-d',
      onShow:function( ct ){
       this.setOptions({
        minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
       })

      },
      timepicker:false
     });
    });

  </script>
</body>
</html>
