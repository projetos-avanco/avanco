<?php require '../../../init.php'; ?>
<?php require_once DIRETORIO_HELPERS . 'datas.php'; ?>

<?php if (verificaUsuarioLogado('edita_atendimento_externo.php')) : ?>

<?php
  require_once DIRETORIO_FUNCTIONS . 'schedule/external/consultas_externo.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/contact/consultas_contato.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/address/consultas_endereco.php';
  require_once DIRETORIO_FUNCTIONS . 'avancoins/colaboradores.php';

  # verificando se houve uma requisição via método get
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    # verificando se o id do atendimento externo foi enviado e não está vazio
    if (isset($_GET['id']) && (!empty($_GET['id']))) {
      # verificando se o id do atendimento externo é uma string numérica
      if (is_numeric($_GET['id'])) {
        $id = (int) $_GET['id'];
      }
    }

    # verificando se o id do atendimento externo foi recuperado
    if (isset($id)) {
      $db = abre_conexao();

      # chamando função que retorna os dados para tela de edição
      $dados = retornaDadosDoAtendimentoExternoParaEdicao($db, $id);

      # chamando função que retorna os dados do atendimento externo
      $externo = retornaDadosDoAtendimentoExterno($db, $id);

      # chamando função que retorna o nome do colaborador
      $colaborador = consultaNomeDoColaborador($db, $externo['colaborador']) . ' ' .consultaSobrenomeDoColaborador($db, $externo['colaborador']);

      # chamando função que retorna os contatos de um cnpj
      $contatos = consultaDadosDosContatosDeUmCnpj($db, $externo['id_cnpj'], $externo['id_contato']);

      # chamando função que retorna o endereço do cnpj
      $endereco = retornaEnderecoAjax($db, $externo['id_cnpj']);

      # verificando se o atendimento externo não é faturado ou é faturado
      if ($externo['faturado'] == 0) {
        $valor = 0;
      } elseif ($externo['faturado'] == 1) {
        # verificando se o valor do atendimento externo será cobrado por hora, pacote ou horas contratuais
        if ($externo['valor_hora'] > 0 && $externo['valor_pacote'] == 0) {
          $valor = number_format($externo['valor_hora'], 2, ',', '.');
        } elseif ($externo['valor_hora'] == 0 && $externo['valor_pacote'] > 0) {
          $valor = number_format($externo['valor_pacote'], 2, ',', '.');
        } else {
          $valor = 0;
        }
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Edição Atendimento Externo</title>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap_3.3.7.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/fontes.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/home.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/sidebar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/schedule/tabelas.css">

  <!-- dispositivos com largura máxima de 769px (por exemplo tablets) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbartablet.css" type="text/css" media="screen and (max-width: 769px)" />
  <!-- dispositivos com largura máxima de 450px (por exemplo smartphones) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbarsmart.css" type="text/css" media="screen and (max-width:450px)" />

  <style>
    .erro {
      border: 2px solid red;
    }

    .btn-file {
      position: relative;
      overflow: hidden;
    }

    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
  </style>
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <h2>Edição Atendimento Externo</h2>
            <hr>
          </div>
        </div>

        <?php if ((!empty($_SESSION['atividades']['mensagens'])) && $_SESSION['atividades']['exibe'] == true) : ?>

        <?php for ($i = 0; $i < count($_SESSION['atividades']['mensagens']); $i++) : ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="text-center">
                <div class="alert alert-<?php echo $_SESSION['atividades']['tipo']; ?>" role="alert">
                    <?php if ($_SESSION['atividades']['tipo'] == 'danger') : ?>
                      <strong>Ops!</strong>
                    <?php else : ?>
                      <strong>Tudo Certo!</strong>
                    <?php endif; ?>

                    <?php echo $_SESSION['atividades']['mensagens'][$i]; ?>
                </div>
              </div>
            </div>
          </div>
        <?php endfor; ?>

        <?php endif; ?>
        
        <form action="<?php echo BASE_URL; ?>app/requests/post/schedule/external/processa_edicao_atendimento_externo.php" method="post" enctype="multipart/form-data">
        
          <div class="row"><!-- linha principal -->
            <div class="col-sm-6"><!-- primeira coluna principal -->

              <div class="row"><!-- painel empresa -->
                <div class="col-sm-12">

                  <div class="panel panel-info"><!-- panel -->
                    <div class="panel-heading">
                      <strong>Empresa</strong>
                    </div>

                    <div class="panel-body"><!-- panel-body -->                    
                      <table class="table table-condensed">
                        <thead>
                          <tr>
                            <th class="text-center">Razão Social</th>
                            <th class="text-center">CNPJ</th>
                            <th class="text-center">Contrato</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-left"><?php echo $dados['razao_social']; ?></td>
                            <td class="text-center"><?php echo $dados['cnpj']; ?></td>
                            <td class="text-center"><?php echo $dados['conta_contrato']; ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div><!-- panel-body -->
                  </div><!-- panel -->                  
                </div>
              </div><!-- painel empresa -->

              <div class="row"><!-- painel endereço -->
                <div class="col-sm-12">
                
                  <div class="panel panel-info"><!-- panel -->
                    <div class="panel-heading">
                      <div class="text-left">
                        <strong>Endereço</strong>
                      </div>
                    </div>

                    <div class="panel-body"><!-- panel-body -->
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="logradouro">Logradouro</label>
                            <input class="form-control required" id="logradouro" type="text" placeholder="Avenida" value="<?php echo $endereco['logradouro']; ?>" readonly>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="distrito">Bairro</label>
                            <input class="form-control required" id="distrito" type="text" placeholder="Bairro" value="<?php echo $endereco['distrito']; ?>"readonly>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="localidade">Cidade</label>
                            <input class="form-control required" id="localidade" type="text" placeholder="Cidade" value="<?php echo $endereco['localidade']; ?>" readonly>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="uf">Estado</label>
                            <input class="form-control required" id="uf" type="text" placeholder="Estado" value="<?php echo $endereco['uf']; ?>" readonly>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label for="tipo">Tipo do Endereco</label>
                            <input class="form-control required" id="tipo" type="text" placeholder="Tipo do Endereço" value="<?php echo $endereco['tipo']; ?>" readonly>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group">
                            <label for="cep">Código Postal</label>
                            <input class="form-control required" id="cep" type="text" placeholder="Código Postal" value="<?php echo $endereco['cep']; ?>" readonly>
                          </div>
                        </div>

                        <div class="col-sm-2">
                          <div class="form-group">
                            <label for="numero">Número</label>
                            <input class="form-control required" id="numero" type="text" placeholder="Número" value="<?php echo $endereco['numero']; ?>" readonly>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="complemento">Complemento</label>
                            <input class="form-control" id="complemento" type="text" placeholder="Complemento" value="<?php echo $endereco['complemento']; ?>" readonly>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="referencia">Referência</label>
                            <input class="form-control" id="referencia" type="text" placeholder="Referência" value="<?php echo $endereco['referencia']; ?>" readonly>
                          </div>
                        </div>
                      </div>

                    </div><!-- panel-body -->
                  </div><!-- panel -->

                </div>
              </div><!-- painel endereço -->

              <div class="row"><!-- painel atendimento -->
                <div class="col-sm-12">

                  <div class="panel panel-info"><!-- panel -->
                    <div class="panel-heading">
                      <strong>Atendimento</strong>
                    </div>

                    <div class="panel-body"><!-- panel-body -->
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="novo-colaborador">Colaborador</label>
                            <select class="form-control required" id="novo-colaborador" name="externo[colaborador]" readonly>
                              <option value="<?php echo $externo['colaborador']; ?>" selected><?php echo $colaborador; ?></option>
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="colaborador">Lista Colaboradores</label>
                            <select class="form-control" id="colaborador">

                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="produto">Produto</label>
                            <select class="form-control required" id="produto" name="externo[produto]">
                            <?php if ($externo['produto'] == '1') : ?>
                              <option value="1" selected>Integral</option>
                              <option value="2">Frente de Loja</option>
                              <option value="3">Gestor</option>
                              <option value="4">Novo ERP</option>
                            <?php elseif ($externo['produto'] == '2') : ?>
                              <option value="1">Integral</option>
                              <option value="2" selected>Frente de Loja</option>
                              <option value="3">Gestor</option>
                              <option value="4">Novo ERP</option>
                            <?php elseif ($externo['produto'] == '3') : ?>
                              <option value="1">Integral</option>
                              <option value="2">Frente de Loja</option>
                              <option value="3" selected>Gestor</option>
                              <option value="4">Novo ERP</option>
                            <?php elseif ($externo['produto'] == '4') : ?>
                              <option value="1">Integral</option>
                              <option value="2">Frente de Loja</option>
                              <option value="3">Gestor</option>
                              <option value="4" selected>Novo ERP</option>
                            <?php endif; ?>
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="modulo">Módulo</label>
                            <select class="form-control required" id="modulo" name="externo[modulo]">
                            <?php if ($externo['modulo'] == '1'  && $externo['produto'] == '1') : ?>                    
                              <option value="1" selected>Materiais</option>
                              <option value="2">Fiscal</option>
                              <option value="3">Financeiro</option>
                              <option value="4">Contábil</option>
                              <option value="5">Cotação</option>
                              <option value="6">TNFE</option>
                              <option value="7">WMS</option>
                            <?php elseif ($externo['modulo'] == '2'  && $externo['produto'] == '1') : ?>                              
                              <option value="1">Materiais</option>
                              <option value="2" selected>Fiscal</option>
                              <option value="3">Financeiro</option>
                              <option value="4">Contábil</option>
                              <option value="5">Cotação</option>
                              <option value="6">TNFE</option>
                              <option value="7">WMS</option>
                            <?php elseif ($externo['modulo'] == '3'  && $externo['produto'] == '1') : ?>                              
                              <option value="1">Materiais</option>
                              <option value="2">Fiscal</option>
                              <option value="3" selected>Financeiro</option>
                              <option value="4">Contábil</option>
                              <option value="5">Cotação</option>
                              <option value="6">TNFE</option>
                              <option value="7">WMS</option>
                            <?php elseif ($externo['modulo'] == '4'  && $externo['produto'] == '1') : ?>                            
                              <option value="1">Materiais</option>
                              <option value="2">Fiscal</option>
                              <option value="3">Financeiro</option>
                              <option value="4" selected>Contábil</option>
                              <option value="5">Cotação</option>
                              <option value="6">TNFE</option>
                              <option value="7">WMS</option>
                            <?php elseif ($externo['modulo'] == '5'  && $externo['produto'] == '1') : ?>                              
                              <option value="1">Materiais</option>
                              <option value="2">Fiscal</option>
                              <option value="3">Financeiro</option>
                              <option value="4">Contábil</option>
                              <option value="5" selected>Cotação</option>
                              <option value="6">TNFE</option>
                              <option value="7">WMS</option>
                            <?php elseif ($externo['modulo'] == '6'  && $externo['produto'] == '1') : ?>                              
                              <option value="1">Materiais</option>
                              <option value="2">Fiscal</option>
                              <option value="3">Financeiro</option>
                              <option value="4">Contábil</option>
                              <option value="5">Cotação</option>
                              <option value="6" selected>TNFE</option>
                              <option value="7">WMS</option>
                            <?php elseif ($externo['modulo'] == '7'  && $externo['produto'] == '1') : ?>                              
                              <option value="1">Materiais</option>
                              <option value="2">Fiscal</option>
                              <option value="3">Financeiro</option>
                              <option value="4">Contábil</option>
                              <option value="5">Cotação</option>
                              <option value="6">TNFE</option>
                              <option value="7" selected>WMS</option>
                            <?php elseif ($externo['modulo'] == '8'  && $externo['produto'] == '2') : ?>                              
                              <option value="8" selected>Frente Windows</option>
                              <option value="9">Frente Linux</option>
                              <option value="10">Supervisor</option>
                              <option value="11">Scanntech</option>
                              <option value="12">Sitef</option>
                              <option value="13">Comandas</option>
                            <?php elseif ($externo['modulo'] == '9'  && $externo['produto'] == '2') : ?>                              
                              <option value="8">Frente Windows</option>
                              <option value="9" selected>Frente Linux</option>
                              <option value="10">Supervisor</option>
                              <option value="11">Scanntech</option>
                              <option value="12">Sitef</option>
                              <option value="13">Comandas</option>
                            <?php elseif ($externo['modulo'] == '10' && $externo['produto'] == '2') : ?>                              
                              <option value="8">Frente Windows</option>
                              <option value="9">Frente Linux</option>
                              <option value="10" selected>Supervisor</option>
                              <option value="11">Scanntech</option>
                              <option value="12">Sitef</option>
                              <option value="13">Comandas</option>
                            <?php elseif ($externo['modulo'] == '11' && $externo['produto'] == '2') : ?>                              
                              <option value="8">Frente Windows</option>
                              <option value="9">Frente Linux</option>
                              <option value="10">Supervisor</option>
                              <option value="11" selected>Scanntech</option>
                              <option value="12">Sitef</option>
                              <option value="13">Comandas</option>
                            <?php elseif ($externo['modulo'] == '12' && $externo['produto'] == '2') : ?>                              
                              <option value="8">Frente Windows</option>
                              <option value="9">Frente Linux</option>
                              <option value="10">Supervisor</option>
                              <option value="11">Scanntech</option>
                              <option value="12" selected>Sitef</option>
                              <option value="13">Comandas</option>
                            <?php elseif ($externo['modulo'] == '13' && $externo['produto'] == '2') : ?>                              
                              <option value="8">Frente Windows</option>
                              <option value="9">Frente Linux</option>
                              <option value="10">Supervisor</option>
                              <option value="11">Scanntech</option>
                              <option value="12">Sitef</option>
                              <option value="13" selected>Comandas</option>
                            <?php elseif ($externo['modulo'] == '14' && $externo['produto'] == '3') : ?>                              
                              <option value="14" selected>Instalação</option>
                              <option value="15">Cadastro</option>
                              <option value="16">Movimento</option>
                              <option value="17">Contábil</option>
                              <option value="18">Fiscal</option>
                            <?php elseif ($externo['modulo'] == '15' && $externo['produto'] == '3') : ?>                              
                              <option value="14">Instalação</option>
                              <option value="15" selected>Cadastro</option>
                              <option value="16">Movimento</option>
                              <option value="17">Contábil</option>
                              <option value="18">Fiscal</option>
                            <?php elseif ($externo['modulo'] == '16' && $externo['produto'] == '3') : ?>                              
                              <option value="14">Instalação</option>
                              <option value="15">Cadastro</option>
                              <option value="16" selected>Movimento</option>
                              <option value="17">Contábil</option>
                              <option value="18">Fiscal</option>
                            <?php elseif ($externo['modulo'] == '17' && $externo['produto'] == '3') : ?>                              
                              <option value="14">Instalação</option>
                              <option value="15">Cadastro</option>
                              <option value="16">Movimento</option>
                              <option value="17" selected>Contábil</option>
                              <option value="18">Fiscal</option>
                            <?php elseif ($externo['modulo'] == '18' && $externo['produto'] == '3') : ?>                              
                              <option value="14">Instalação</option>
                              <option value="15">Cadastro</option>
                              <option value="16">Movimento</option>
                              <option value="17">Contábil</option>
                              <option value="18" selected>Fiscal</option>
                            <?php elseif ($externo['modulo'] == '19' && $externo['produto'] == '4') : ?>                              
                              <option value="19" selected>Instalação</option>
                              <option value="20">Pessoas</option>
                              <option value="21">Produtos</option>
                              <option value="22">Fiscal</option>
                              <option value="23">Financeiro</option>
                              <option value="24">Lançamentos</option>
                              <option value="25">Relatórios e Gráficos</option>
                              <option value="26">Importação e Exportação</option>
                              <option value="27">Configurações PDV</option>
                              <option value="28">Minha Conta</option>
                            <?php elseif ($externo['modulo'] == '20' && $externo['produto'] == '4') : ?>                              
                              <option value="19">Instalação</option>
                              <option value="20" selected>Pessoas</option>
                              <option value="21">Produtos</option>
                              <option value="22">Fiscal</option>
                              <option value="23">Financeiro</option>
                              <option value="24">Lançamentos</option>
                              <option value="25">Relatórios e Gráficos</option>
                              <option value="26">Importação e Exportação</option>
                              <option value="27">Configurações PDV</option>
                              <option value="28">Minha Conta</option>
                            <?php elseif ($externo['modulo'] == '21' && $externo['produto'] == '4') : ?>                              
                              <option value="19">Instalação</option>
                              <option value="20">Pessoas</option>
                              <option value="21" selected>Produtos</option>
                              <option value="22">Fiscal</option>
                              <option value="23">Financeiro</option>
                              <option value="24">Lançamentos</option>
                              <option value="25">Relatórios e Gráficos</option>
                              <option value="26">Importação e Exportação</option>
                              <option value="27">Configurações PDV</option>
                              <option value="28">Minha Conta</option>
                            <?php elseif ($externo['modulo'] == '22' && $externo['produto'] == '4') : ?>                              
                              <option value="19">Instalação</option>
                              <option value="20">Pessoas</option>
                              <option value="21">Produtos</option>
                              <option value="22" selected>Fiscal</option>
                              <option value="23">Financeiro</option>
                              <option value="24">Lançamentos</option>
                              <option value="25">Relatórios e Gráficos</option>
                              <option value="26">Importação e Exportação</option>
                              <option value="27">Configurações PDV</option>
                              <option value="28">Minha Conta</option>
                            <?php elseif ($externo['modulo'] == '23' && $externo['produto'] == '4') : ?>                              
                              <option value="19">Instalação</option>
                              <option value="20">Pessoas</option>
                              <option value="21">Produtos</option>
                              <option value="22">Fiscal</option>
                              <option value="23" selected>Financeiro</option>
                              <option value="24">Lançamentos</option>
                              <option value="25">Relatórios e Gráficos</option>
                              <option value="26">Importação e Exportação</option>
                              <option value="27">Configurações PDV</option>
                              <option value="28">Minha Conta</option>
                            <?php elseif ($externo['modulo'] == '24' && $externo['produto'] == '4') : ?>                              
                              <option value="19">Instalação</option>
                              <option value="20">Pessoas</option>
                              <option value="21">Produtos</option>
                              <option value="22">Fiscal</option>
                              <option value="23">Financeiro</option>
                              <option value="24" selected>Lançamentos</option>
                              <option value="25">Relatórios e Gráficos</option>
                              <option value="26">Importação e Exportação</option>
                              <option value="27">Configurações PDV</option>
                              <option value="28">Minha Conta</option>
                            <?php elseif ($externo['modulo'] == '25' && $externo['produto'] == '4') : ?>                              
                              <option value="19">Instalação</option>
                              <option value="20">Pessoas</option>
                              <option value="21">Produtos</option>
                              <option value="22">Fiscal</option>
                              <option value="23">Financeiro</option>
                              <option value="24">Lançamentos</option>
                              <option value="25" selected>Relatórios e Gráficos</option>
                              <option value="26">Importação e Exportação</option>
                              <option value="27">Configurações PDV</option>
                              <option value="28">Minha Conta</option>
                            <?php elseif ($externo['modulo'] == '26' && $externo['produto'] == '4') : ?>                              
                              <option value="19">Instalação</option>
                              <option value="20">Pessoas</option>
                              <option value="21">Produtos</option>
                              <option value="22">Fiscal</option>
                              <option value="23">Financeiro</option>
                              <option value="24">Lançamentos</option>
                              <option value="25">Relatórios e Gráficos</option>
                              <option value="26" selected>Importação e Exportação</option>
                              <option value="27">Configurações PDV</option>                    
                              <option value="28">Minha Conta</option>
                            <?php elseif ($externo['modulo'] == '27' && $externo['produto'] == '4') : ?>                              
                              <option value="19">Instalação</option>
                              <option value="20">Pessoas</option>
                              <option value="21">Produtos</option>
                              <option value="22">Fiscal</option>
                              <option value="23">Financeiro</option>
                              <option value="24">Lançamentos</option>
                              <option value="25">Relatórios e Gráficos</option>
                              <option value="26">Importação e Exportação</option>
                              <option value="27" selected>Configurações PDV</option>
                              <option value="28">Minha Conta</option>
                            <?php elseif ($externo['modulo'] == '28' && $externo['produto'] == '4') : ?>
                              <option value="19">Instalação</option>
                              <option value="20">Pessoas</option>
                              <option value="21">Produtos</option>
                              <option value="22">Fiscal</option>
                              <option value="23">Financeiro</option>
                              <option value="24">Lançamentos</option>
                              <option value="25">Relatórios e Gráficos</option>
                              <option value="26">Importação e Exportação</option>
                              <option value="27">Configurações PDV</option>
                              <option value="28" selected>Minha Conta</option>
                            <?php endif; ?>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="data-inicial">Data Inicial</label>
                            <input class="form-control required" id="data-inicial" type="date" name="externo[data-inicial]" value="<?php echo $externo['data_inicial']; ?>">
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="data-final">Data Final</label>
                            <input class="form-control required" id="data-final" type="date" name="externo[data-final]" value="<?php echo $externo['data_final']; ?>">
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="horario">Horário</label>
                            <div class="input-group">
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                  <span class="glyphicon glyphicon-time"></span>
                                </button>
                              </span>                              
                              <input class="form-control required" id="horario" type="text" name="externo[horario]" value="<?php echo $externo['horario']; ?>" placeholder="Horário">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label for="anexo">Anexo</label>
                            <span class="btn btn-danger btn-block btn-file">
                              Anexar Arquivo <input id="anexo" type="file" name="externo[anexo]">
                            </span>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="observacao">Observação</label>
                            <textarea class="form-control" id="observacao" name="externo[observacao]" rows="4" cols="30" placeholder="Observações..."><?php echo $externo['observacao']; ?></textarea>
                          </div>
                        </div>
                      </div>                                         
                    </div><!-- panel-body -->
                  </div><!-- panel -->

                  <input type="hidden" name="externo[id]" value="<?php echo $id; ?>">

                  <input type="hidden" name="externo[supervisor]" value="<?php echo $_SESSION['usuario']['id']; ?>">
                </div>
              </div><!-- painel atendimento -->

            </div><!-- primeira coluna principal -->

            <div class="col-sm-6"><!-- segunda coluna principal -->

              <div class="row"><!-- painel contato -->
                <div class="col-sm-12">

                  <div class="panel panel-info"><!-- panel -->
                    <div class="panel-heading">
                      <strong>Contato</strong>
                    </div>

                    <div class="panel-body"><!-- panel-body -->                    
                      <table class="table table-condensed">
                        <thead>
                          <tr>
                            <th class="text-center">Nome</th>
                            <th class="text-center">Fixo</th>
                            <th class="text-center">Móvel</th>
                            <th class="text-center">Email</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-left"><?php echo $dados['nome']; ?></td>
                            <td class="text-center"><?php echo $dados['fixo']; ?></td>
                            <td class="text-center"><?php echo $dados['movel']; ?></td>
                            <td class="text-left"><?php echo $dados['endereco']; ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div><!-- panel-body -->
                  </div><!-- panel -->                  
                </div>
              </div><!-- painel contato -->

              <div class="row"><!-- painel id's dos contatos em cópia oculta -->
                <div class="col-sm-12">

                  <div class="panel panel-info"><!-- panel -->
                    <div class="panel-heading">
                      <strong>Complementar</strong>
                    </div>

                    <div class="panel-body"><!-- panel-body -->                    
                      <div class="text-left">
                        <ul class="list-group" id="contatos-copia"><!-- tabela contatos -->
                          <li class="list-group-item list-group-item-info">
                            <div class="text-center">
                              <strong>enviar e-mail em cópia para</strong>
                            </div>
                          </li>
                          <?php foreach ($contatos as $contato) : ?>
                            <li class="list-group-item">
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="copia[]" value="<?php echo $contato['id']; ?>"><?php echo $contato['nome']; ?>
                                </label>
                              </div>
                            </li>
                          <?php endforeach; ?>
                        </ul><!-- tabela contatos -->
                      </div>
                    </div><!-- panel-body -->
                  </div><!-- panel -->                  
                </div>
              </div><!-- painel id's dos contatos em cópia oculta -->

              <div class="row"><!-- painel financeiro -->
                <div class="col-sm-12">

                  <div class="panel panel-info"><!-- panel -->
                    <div class="panel-heading">
                      <strong>Financeiro</strong>
                    </div>

                    <div class="panel-body"><!-- panel-body -->
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="situacao">Situação</label>
                            <select class="form-control required" id="situacao" name="externo[situacao]" readonly>
                              <?php if ($externo['status'] == 1) : ?>
                                <option value="1" selected>Confirmado</option>
                              <?php elseif ($externo['status'] == 2) : ?>
                                <option value="2" selected>À Confirmar</option>
                              <?php elseif ($externo['status'] == 3) : ?>
                                <option value="3" selected>Reservado</option>
                              <?php endif; ?>
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="tipo-atendimento">Tipo Atendimento</label>
                            <select class="form-control required" id="tipo-atendimento" name="externo[tipo-atendimento]">
                              <option value="0">Selecione um Tipo de Atendimento</option>
                              <option value="1" <?php echo ($externo['tipo'] == 1) ? 'selected' : ''; ?>>Suporte ao Cliente</option>
                              <option value="2" <?php echo ($externo['tipo'] == 2) ? 'selected' : ''; ?>>Projeto Mais Gestão</option>
                              <option value="3" <?php echo ($externo['tipo'] == 3) ? 'selected' : ''; ?>>Implantação</option>
                              <option value="4" <?php echo ($externo['tipo'] == 4) ? 'selected' : ''; ?>>Treinamento Avanço</option>
                              <option value="5" <?php echo ($externo['tipo'] == 5) ? 'selected' : ''; ?>>Instalação</option>
                              <option value="6" <?php echo ($externo['tipo'] == 6) ? 'selected' : ''; ?>>Atualização</option>
                            </select>
                          </div>
                        </div>                        
                      </div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="despesa">Despesa</label>
                            <select class="form-control required" id="despesa" name="externo[despesa]">
                              <option value="0">Cobrança de Despesas?</option>
                              <option value="1" <?php echo ($externo['despesa'] == 1) ? 'selected' : ''; ?>>Sim</option>
                              <option value="2" <?php echo ($externo['despesa'] == 0) ? 'selected' : ''; ?>>Não</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="faturado">Faturado</label>
                            <select class="form-control required" id="faturado" name="externo[faturado]">
                              <option value="0">Pedido Faturado?</option>
                              <option value="1" <?php echo ($externo['faturado'] == 1) ? 'selected' : ''; ?>>Sim</option>
                              <option value="2" <?php echo ($externo['faturado'] == 0) ? 'selected' : ''; ?>>Não</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="cobranca">Tipo Cobrança</label>
                            <select class="form-control" id="cobranca" name="externo[cobranca]">
                              <option value="0" <?php echo ($externo['faturado'] == 0 && $externo['valor_pacote'] == 0 && $externo['valor_hora'] == 0) ? 'selected' : ''; ?>>Selecione o Tipo de Cobrança</option>
                              <option value="1" <?php echo ($externo['faturado'] == 1 && $externo['valor_pacote'] == 0 && $externo['valor_hora'] > 0) ? 'selected' : ''; ?>>Hora</option>
                              <option value="2" <?php echo ($externo['faturado'] == 1 && $externo['valor_pacote'] > 0 && $externo['valor_hora'] == 0) ? 'selected' : ''; ?>>Pacote</option>
                              <option value="3" <?php echo ($externo['faturado'] == 1 && $externo['valor_pacote'] == 0 && $externo['valor_hora'] == 0) ? 'selected' : ''; ?>>Não Informado</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="valor">Valor</label>
                            <div class="input-group">
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                  <span class="glyphicon glyphicon-usd"></span>
                                </button>
                              </span>                              
                              <input class="form-control required" id="valor" type="text" name="externo[valor]" value="<?php echo $valor; ?>" placeholder="0.00">
                            </div>
                          </div>
                        </div>
                      </div>                      
                    </div><!-- panel-body -->
                  </div><!-- panel -->

                </div>
              </div><!-- painel financeiro -->

              <div class="row"><!-- painel registro -->
                <div class="col-sm-12">

                  <div class="panel panel-info"><!-- panel -->
                    <div class="panel-heading">
                      <div class="text-center">
                        <strong>Registro</strong>
                      </div>
                    </div>

                    <div class="panel-body"><!-- panel-body -->
                      <div class="text-center">
                        <h1>
                          <strong id="ticket">
                            <?php echo $externo['registro']; ?>
                          </strong>
                        </h1>
                      </div>
                    </div><!-- panel-body -->
                  </div><!-- panel -->

                </div>
              </div><!-- painel registro -->

              <div class="row">
                <div class="col-sm-3 col-sm-offset-6">
                  <button class="btn btn-block btn-default btn-sm" id="btn-voltar" type="button">
                    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
                    Voltar
                  </button>
                </div>

                <div class="col-sm-3">
                  <button class="btn btn-block btn-success btn-sm" type="submit" name="submit" value="submit">
                    <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
                    Gravar
                  </button>
                </div>
              </div>

            </div><!-- segunda coluna principal -->
          </div><!-- linha principal -->

        </form>

        <?php unset($_SESSION['atividades'], $_SESSION['registro']); ?>

      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/altera_cobranca.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/avancoins/colaboradores.js"></script>
  <script src="<?php echo BASE_URL; ?>../tickets/public/js/screen/modulos.js"></script>
  <!--<script src="<?php echo BASE_URL; ?>public/js/schedule/external/validacao.js"></script> -->

  <script>
    $(function() {
      $(document).ready(function() {        
        $('#horario').mask('00:00');
        $('#valor').mask('#0.00', {reverse: true});

        var faturado = $('#faturado').val();
        var cobranca = $('#cobranca').val();

        if (faturado == 2) {
          $('#cobranca').attr('disabled', true);
          $('#valor').attr('disabled', true);
          $('#valor').val('0.00');
        } else if (faturado == 1) {
          if (cobranca == 3) {
            $('#valor').attr('disabled', true);
            $('#valor').val('0.00');            
          }
        }
      });

      // voltando para o relatório gerencial de atendimentos externos
      $(document).on('click', '#btn-voltar', function(e) {
        e.preventDefault;

        var url = window.location.href;
        var tmp = url.split('/');

        url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/public/views/schedule/gerencial_atendimento_externo.php';
        
        window.open(url, '_self');
      });

      // aterando data final caso a data inicial seja alterada
      $(document).on('change', '#data-inicial', function(e) {
        e.preventDefault;

        var dataInicial = $('#data-inicial').val();

        $('#data-final').val(dataInicial);
      });

      // alterando cobrança
      $(document).on('change', '#cobranca', function(e) {
        e.preventDefault;

        var tipo = $(this).val();

        if (tipo === '3') {
          $('#valor').val('0.00');
          $('#valor').attr('disabled', true);
        } else {
          $('#valor').val('0.00');
          $('#valor').attr('disabled', false);
        } 
      });

      // editando colaborador
      $(document).on('change', '#colaborador', function(e) {
        e.preventDefault;

        var id = $(this).val();
        var nome = $('#colaborador :selected').text();

        $('#novo-colaborador').html('<option value="' + id + '" selected>' + nome + '</option>');
      });
    });
  </script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
