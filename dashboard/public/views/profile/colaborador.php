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
  <title>Perfil do Colaborador</title>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize-7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/style.css">
</head>
<body>
  <h1>DASHBOARD DO COLABORADOR</h1>

  <form action="" method="post">
    <label for="data">Calendário: </label>
      <input type="date" name="datas[data-1]" id="datas" min="1979-12-31">
      <input type="date" name="datas[data-2]" id="datas" max="2099-12-31">

    <input type="submit" value="Gerar">
  </form>

  <div class="um">
    <h3><?php echo $dashboard['pessoal']['nome'] . ' ' . $dashboard['pessoal']['sobrenome']; ?></h3>

    <img src="<?php echo $dashboard['pessoal']['caminho_foto']; ?>" alt="Foto do colaborador" width="493" height="343">
  </div>

  <div class="dois">
    <h2>Indicadores do Chat</h2>

    <table>
      <tr>
        <th>Período de <?php echo $dashboard['periodo']['data_1']; ?> até <?php echo $dashboard['periodo']['data_2']; ?></th>
      </tr>
      <?php foreach ($dashboard['indicadores_chat'] as $chave => $valor) : ?>
        <tr>
          <th><?php echo $chave; ?></th>
          <td><?php echo $valor; ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>

  <div class="tres">
    <h2>Títulos Conquistados</h2>

    <table>
      <?php foreach ($dashboard['titulos_conquistados'] as $chaves) : ?>
        <?php foreach ($chaves as $chave => $valor) : ?>
          <tr>
            <td><?php echo $valor; ?></td>
          </tr>
        <?php endforeach; ?>
      <?php endforeach; ?>
    </table>
  </div>

  <div class="quatro">
    <h2>Informações Gerais</h2>

    <table>
      <?php foreach ($dashboard['informacoes_gerais'] as $chave) : ?>
        <?php foreach ($chave as $sub_chave => $valor) : ?>
          <tr>
            <th><?php echo $sub_chave; ?></th>
            <td><?php echo $valor; ?></td>
          </tr>
        <?php endforeach; ?>
      <?php endforeach; ?>
    </table>
  </div>
  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery-3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
