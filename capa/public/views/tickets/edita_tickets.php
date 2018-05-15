<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('edita_tickets.php')) : ?>

<?php

  require DIRETORIO_REQUESTS . 'get/processa_ticket.php';

  $id = '';

  # recuperando id do chat do supervisor que está logado
  $id = $_SESSION['usuario']['id'];

?>

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

  <title>Portal Avanção - Edição Tickets</title>

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

  <?php include ABS_PATH . 'inc/templates/navbar.php'; ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php'; ?>

  <div class="row">
    <div class="col-sm-12">
      <h2>Edição Tickets</h2>

      <form action="<?php echo BASE_URL; ?>app/requests/post/recebe_tickets_editados.php" method="post" accept-charset="utf-8">

        <hr>
        
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="razao_social">Razão Social</label>
              <input class="form-control" type="text" name="ticket[razao_social]" id="razao-social" value="<?php echo $dados['razao_social']; ?>" readonly="true">
            </div>
          </div>             
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="cnpj">Cnpj</label>
              <input class="form-control" type="text" name="ticket[cnpj]" id="cnpj" value="<?php echo $dados['cnpj']; ?>" readonly="true">
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="conta-contrato">Contrato</label>
              <input class="form-control" type="text" name="ticket[conta_contrato]" id="conta-contrato" value="<?php echo $dados['conta_contrato']; ?>" readonly="true">
            </div>
          </div>
        </div>

        <div class="row">        
          <div class="col-sm-6">
            <div class="form-group">
              <label for="supervisor">Gerado</label>
              <input class="form-control" type="text" name="ticket[supervisor]" id="supervisor" value="<?php echo $dados['supervisor']; ?>" readonly="true">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="agendado">Agendado</label>
              <select class="form-control" name="ticket[colaborador]" id="agendado" readonly="true">
                <option value="<?php echo $dados['id_colaborador']; ?>"><?php echo $dados['colaborador']; ?></option>
              </select>              
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="lista">Lista</label>
              <select class="form-control" id="colaborador">
              </select>
            </div>
          </div>        
        </div>

        <br>

        <div class="row">
          <div class="col-sm-12">

            <div class="row">
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="ticket">Ticket</label>
                  <input class="form-control" type="text" name="ticket[ticket]" id="ticket" value="<?php echo $dados['ticket']; ?>" readonly="true">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="validade">Validade</label>
                  <input class="form-control" type="text" name="ticket[validade]" id="validade" value="<?php echo $dados['validade']; ?>" readonly="true">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="data">Data Criação</label>
                  <input class="form-control" type="date" name="ticket[data]" id="data" value="<?php echo $dados['data']; ?>" readonly="true">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="data-agendada">Data Agendada</label>
                  <input class="form-control" type="date" name="ticket[data-agendada]" id="data-agendada" value="<?php echo $dados['data_agendada']; ?>">
                </div>
              </div>

              <div class="col-sm-2">
                <div class="form-group">
                  <label for="hora-agendada">Hora Agendada</label>
                  <input class="form-control" type="time" name="ticket[hora-agendada]" id="hora-agendada" value="<?php echo $dados['hora_agendada']; ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="produto">Produto</label>

                  <select class="form-control" name="ticket[produto]" id="produto">
                  <?php if ($dados['id_produto'] == '1') : ?>

                    <option value="1" selected>Integral</option>
                    <option value="2">Frente de Loja</option>
                    <option value="3">Gestor</option>
                    <option value="4">Novo ERP</option>

                  <?php elseif ($dados['id_produto'] == '2') : ?>

                    <option value="1">Integral</option>
                    <option value="2" selected>Frente de Loja</option>
                    <option value="3">Gestor</option>
                    <option value="4">Novo ERP</option>

                  <?php elseif ($dados['id_produto'] == '3') : ?>

                    <option value="1">Integral</option>
                    <option value="2">Frente de Loja</option>
                    <option value="3" selected>Gestor</option>
                    <option value="4">Novo ERP</option>

                  <?php elseif ($dados['id_produto'] == '4') : ?>

                    <option value="1">Integral</option>
                    <option value="2">Frente de Loja</option>
                    <option value="3">Gestor</option>
                    <option value="4" selected>Novo ERP</option>

                  <?php endif; ?>
                  </select>
                </div>
              </div>

              <div class="col-sm-2">
                <div class="form-group">
                  <label for="modulo">Módulo</label>

                  <select class="form-control" name="ticket[modulo]" id="modulo">                  
                  <?php if ($dados['id_modulo'] == '1'  && $dados['id_produto'] == '1') : ?>
                    
                    <option value="1" selected>Materiais</option>
                    <option value="2">Fiscal</option>
                    <option value="3">Financeiro</option>
                    <option value="4">Contábil</option>
                    <option value="5">Cotação</option>
                    <option value="6">TNFE</option>
                    <option value="7">WMS</option>

                  <?php elseif ($dados['id_modulo'] == '2'  && $dados['id_produto'] == '1') : ?>
                    
                    <option value="1">Materiais</option>
                    <option value="2" selected>Fiscal</option>
                    <option value="3">Financeiro</option>
                    <option value="4">Contábil</option>
                    <option value="5">Cotação</option>
                    <option value="6">TNFE</option>
                    <option value="7">WMS</option>

                  <?php elseif ($dados['id_modulo'] == '3'  && $dados['id_produto'] == '1') : ?>
                    
                    <option value="1">Materiais</option>
                    <option value="2">Fiscal</option>
                    <option value="3" selected>Financeiro</option>
                    <option value="4">Contábil</option>
                    <option value="5">Cotação</option>
                    <option value="6">TNFE</option>
                    <option value="7">WMS</option>

                  <?php elseif ($dados['id_modulo'] == '4'  && $dados['id_produto'] == '1') : ?>
                    
                    <option value="1">Materiais</option>
                    <option value="2">Fiscal</option>
                    <option value="3">Financeiro</option>
                    <option value="4" selected>Contábil</option>
                    <option value="5">Cotação</option>
                    <option value="6">TNFE</option>
                    <option value="7">WMS</option>

                  <?php elseif ($dados['id_modulo'] == '5'  && $dados['id_produto'] == '1') : ?>
                    
                    <option value="1">Materiais</option>
                    <option value="2">Fiscal</option>
                    <option value="3">Financeiro</option>
                    <option value="4">Contábil</option>
                    <option value="5" selected>Cotação</option>
                    <option value="6">TNFE</option>
                    <option value="7">WMS</option>

                  <?php elseif ($dados['id_modulo'] == '6'  && $dados['id_produto'] == '1') : ?>
                    
                    <option value="1">Materiais</option>
                    <option value="2">Fiscal</option>
                    <option value="3">Financeiro</option>
                    <option value="4">Contábil</option>
                    <option value="5">Cotação</option>
                    <option value="6" selected>TNFE</option>
                    <option value="7">WMS</option>

                  <?php elseif ($dados['id_modulo'] == '7'  && $dados['id_produto'] == '1') : ?>
                    
                    <option value="1">Materiais</option>
                    <option value="2">Fiscal</option>
                    <option value="3">Financeiro</option>
                    <option value="4">Contábil</option>
                    <option value="5">Cotação</option>
                    <option value="6">TNFE</option>
                    <option value="7" selected>WMS</option>

                  <?php elseif ($dados['id_modulo'] == '8'  && $dados['id_produto'] == '2') : ?>
                    
                    <option value="8" selected>Frente Windows</option>
                    <option value="9">Frente Linux</option>
                    <option value="10">Supervisor</option>
                    <option value="11">Scanntech</option>
                    <option value="12">Sitef</option>
                    <option value="13">Comandas</option>

                  <?php elseif ($dados['id_modulo'] == '9'  && $dados['id_produto'] == '2') : ?>
                    
                    <option value="8">Frente Windows</option>
                    <option value="9" selected>Frente Linux</option>
                    <option value="10">Supervisor</option>
                    <option value="11">Scanntech</option>
                    <option value="12">Sitef</option>
                    <option value="13">Comandas</option>

                  <?php elseif ($dados['id_modulo'] == '10' && $dados['id_produto'] == '2') : ?>
                    
                    <option value="8">Frente Windows</option>
                    <option value="9">Frente Linux</option>
                    <option value="10" selected>Supervisor</option>
                    <option value="11">Scanntech</option>
                    <option value="12">Sitef</option>
                    <option value="13">Comandas</option>

                  <?php elseif ($dados['id_modulo'] == '11' && $dados['id_produto'] == '2') : ?>
                    
                    <option value="8">Frente Windows</option>
                    <option value="9">Frente Linux</option>
                    <option value="10">Supervisor</option>
                    <option value="11" selected>Scanntech</option>
                    <option value="12">Sitef</option>
                    <option value="13">Comandas</option>

                  <?php elseif ($dados['id_modulo'] == '12' && $dados['id_produto'] == '2') : ?>
                    
                    <option value="8">Frente Windows</option>
                    <option value="9">Frente Linux</option>
                    <option value="10">Supervisor</option>
                    <option value="11">Scanntech</option>
                    <option value="12" selected>Sitef</option>
                    <option value="13">Comandas</option>

                  <?php elseif ($dados['id_modulo'] == '13' && $dados['id_produto'] == '2') : ?>
                    
                    <option value="8">Frente Windows</option>
                    <option value="9">Frente Linux</option>
                    <option value="10">Supervisor</option>
                    <option value="11">Scanntech</option>
                    <option value="12">Sitef</option>
                    <option value="13" selected>Comandas</option>

                  <?php elseif ($dados['id_modulo'] == '14' && $dados['id_produto'] == '3') : ?>
                    
                    <option value="14" selected>Instalação</option>
                    <option value="15">Cadastro</option>
                    <option value="16">Movimento</option>
                    <option value="17">Contábil</option>
                    <option value="18">Fiscal</option>

                  <?php elseif ($dados['id_modulo'] == '15' && $dados['id_produto'] == '3') : ?>
                    
                    <option value="14">Instalação</option>
                    <option value="15" selected>Cadastro</option>
                    <option value="16">Movimento</option>
                    <option value="17">Contábil</option>
                    <option value="18">Fiscal</option>

                  <?php elseif ($dados['id_modulo'] == '16' && $dados['id_produto'] == '3') : ?>
                    
                    <option value="14">Instalação</option>
                    <option value="15">Cadastro</option>
                    <option value="16" selected>Movimento</option>
                    <option value="17">Contábil</option>
                    <option value="18">Fiscal</option>

                  <?php elseif ($dados['id_modulo'] == '17' && $dados['id_produto'] == '3') : ?>
                    
                    <option value="14">Instalação</option>
                    <option value="15">Cadastro</option>
                    <option value="16">Movimento</option>
                    <option value="17" selected>Contábil</option>
                    <option value="18">Fiscal</option>

                  <?php elseif ($dados['id_modulo'] == '18' && $dados['id_produto'] == '3') : ?>
                    
                    <option value="14">Instalação</option>
                    <option value="15">Cadastro</option>
                    <option value="16">Movimento</option>
                    <option value="17">Contábil</option>
                    <option value="18" selected>Fiscal</option>

                  <?php elseif ($dados['id_modulo'] == '19' && $dados['id_produto'] == '4') : ?>
                    
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

                  <?php elseif ($dados['id_modulo'] == '20' && $dados['id_produto'] == '4') : ?>
                    
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

                  <?php elseif ($dados['id_modulo'] == '21' && $dados['id_produto'] == '4') : ?>
                    
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

                  <?php elseif ($dados['id_modulo'] == '22' && $dados['id_produto'] == '4') : ?>
                    
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

                  <?php elseif ($dados['id_modulo'] == '23' && $dados['id_produto'] == '4') : ?>
                    
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

                  <?php elseif ($dados['id_modulo'] == '24' && $dados['id_produto'] == '4') : ?>
                    
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

                  <?php elseif ($dados['id_modulo'] == '25' && $dados['id_produto'] == '4') : ?>
                    
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

                  <?php elseif ($dados['id_modulo'] == '26' && $dados['id_produto'] == '4') : ?>
                    
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

                  <?php elseif ($dados['id_modulo'] == '27' && $dados['id_produto'] == '4') : ?>
                    
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

                  <?php elseif ($dados['id_modulo'] == '28' && $dados['id_produto'] == '4') : ?>

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
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="assunto">Assunto</label>
                  <textarea class="form-control" name="ticket[assunto]" id="assunto" cols="30" rows="4"><?php echo $dados['assunto']; ?></textarea>
                </div>
              </div>
            </div>
            
          </div>
        </div>

        <br>

        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label for="contato">Contato</label>
              <input class="form-control" type="text" name="ticket[contato]" id="contato" value="<?php echo $dados['contato']; ?>">
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              <label for="telefone">Telefone</label>
              <input class="form-control" type="text" name="ticket[telefone]" id="telefone" value="<?php echo $dados['telefone']; ?>" placeholder="Telefone do Contato" maxlength="15" onkeyup="mascara(this, mtel);">
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              <label for="chat">Chat</label>
              <input class="form-control" type="text" name="ticket[chat_id]" id="chat" value="<?php echo $dados['chat_id']; ?>" readonly="true">
            </div>
          </div>
        </div>

        <hr>

        <div class="row"><!-- linha -->
          <div class="col-sm-12"><!-- coluna 2 -->
            <div class="text-right">
              <a class="btn btn-danger" href="<?php echo BASE_URL; ?>public/views/tickets/consulta_tickets.php"><!-- botão cancelar -->
                <i class="fa fa-times" aria-hidden="true"></i> Cancelar
              </a><!-- botão cancelar -->

              <a class="btn btn-info" href="<?php echo BASE_URL; ?>public/views/tickets/edita_tickets.php?ticket=<?php echo $_GET['ticket']; ?>&funcao=edita"><!-- botão atualizar -->
              <i class="fa fa-refresh" aria-hidden="true"></i> Recarregar
              </a><!-- botão atualizar -->

              <button class="btn btn-success" type="submit"><!-- botão gravar -->
                <i class="fa fa-floppy-o" aria-hidden="true"></i> Editar
              </button><!-- botão gravar -->
            </div>
          </div><!-- coluna 2 -->
        </div><!-- linha -->

      </form><!-- formulário -->

      <br>

      <div class="row">
        <div class="col-sm-12">

        <?php if (! empty($_SESSION['mensagens']['mensagem']) AND $_SESSION['mensagens']['exibe'] == true) : ?>

          <div class="alert alert-<?php echo $_SESSION['mensagens']['tipo']; ?>" role="alert">
            <?php echo $_SESSION['mensagens']['mensagem']; ?>
            <?php unset($_SESSION['mensagens']['mensagem'], $_SESSION['mensagens']['tipo']); ?>
          </div>

        <?php endif; ?>

        </div>
      </div>

    </div><!-- coluna principal -->
  </div><!-- linha principal -->

      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->

  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery_3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>
  
  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>  
  <script src="<?php echo BASE_URL; ?>public/js/tickets/edit/altera_colaborador.js"></script>  
  <script src="<?php echo BASE_URL; ?>public/js/tickets/edit/validacao.js"></script>
  <script src="<?php echo BASE_URL; ?>../tickets/public/js/screen/colaboradores.js"></script>  
  <script src="<?php echo BASE_URL; ?>../tickets/public/js/screen/mascara.js"></script>
  <script src="<?php echo BASE_URL; ?>../tickets/public/js/screen/modulos.js"></script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
