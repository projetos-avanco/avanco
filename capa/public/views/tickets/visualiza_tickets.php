<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('visualiza_tickets.php')) : ?>

<?php require DIRETORIO_REQUESTS . 'get/processa_ticket.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Visualização de Tickets</title>

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
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/tickets/tabela_visualiza_tickets.css">

  <!-- dispositivos com largura máxima de 769px (por exemplo tablets) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbartablet.css" type="text/css" media="screen and (max-width: 769px)" />
  <!-- dispositivos com largura máxima de 450px (por exemplo smartphones) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbarsmart.css" type="text/css" media="screen and (max-width:450px)" />
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <h2>Visualização Tickets</h2>

            <hr>
          </div>
        </div><!-- linha -->

        <br>

        <div class="row">          
          <div class="col-sm-12">
            <div class="text-center">
              <table class="table table-bordered">            
                <tbody>
                  <tr>
                    <th class="text-center" id="titulo" colspan="5">Informações do Ticket</th>
                  </tr>

                  <tr>
                    <th class="text-center" rowspan="5" width="10%">Dados da Empresa</th>

                    <th>Criado</th>
                    <td class="text-left"><?php echo $dados['supervisor']; ?></td>

                    <th>Agendado</th>
                    <td class="text-left"><?php echo $dados['colaborador']; ?></td>
                  </tr>

                  <tr>                
                    <th width="10%">Cnpj</th>
                    <td class="text-left" width="20%" colspan="3"><?php echo $dados['cnpj']; ?></td>                    
                  </tr>

                  <tr>
                    <th>Contrato</th>
                    <td class="text-left" colspan="3"><?php echo $dados['conta_contrato']; ?></td>                    
                  </tr>

                  <tr>                    
                    <th>Razão Social</th>
                    <td class="text-left" colspan="3"><?php echo $dados['razao_social']; ?></td>                    
                  </tr>
            
                  <tr>
                    <th class="text-center tamanho" colspan="5"></th>
                  </tr>
                  
                  <tr>
                    <th class="text-center" rowspan="7">Dados do Ticket</th>

                    <th>Ticket</th>
                    <td class="text-left" colspan="3"><?php echo $dados['ticket']; ?></td>                    
                  </tr>

                  <tr>
                    <th>Validade</th>
                    <td class="text-left" colspan="3"><?php echo $dados['validade']; ?></td>
                  </tr>

                  <tr>
                    <th>Data Criação</th>
                    <td class="text-left" class="text-left" colspan="3"><?php echo $dados['data']; ?></td>
                  </tr>

                  <tr>
                    <th>Data Agendada</th>
                    <td class="text-left"><?php echo $dados['data_agendada']; ?></td>

                    <th>Hora Agendada</th>
                    <td class="text-left"><?php echo $dados['hora_agendada']; ?></td>
                  </tr>

                  <tr>
                    <th>Sistema</th>
                    <td class="text-left"><?php echo $dados['produto']; ?></td>

                    <th>Módulo</th>
                    <td class="text-left"><?php echo $dados['modulo']; ?></td>
                  </tr>

                  <tr>
                    <th>Assunto</th>
                    <td class="text-left" colspan="3"><?php echo $dados['assunto']; ?></td>
                  </tr>

                  <tr>
                    <th class="text-center tamanho" colspan="5"></th>
                  </tr>

                  <tr>
                    <th class="text-center" rowspan="3">Dados do Contato</th>

                    <th>Chat</th>
                    <td class="text-left" colspan="3"><?php echo $dados['chat_id']; ?></td>
                  </tr>

                  <tr>                  
                    <th>Contato</th>
                    <td class="text-left" colspan="3"><?php echo $dados['contato']; ?></td>                    
                  </tr>                  

                  <tr>
                    <th>Telefone</th>
                    <td class="text-left" colspan="3"><?php echo $dados['telefone']; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>    
          </div><!-- coluna -->          
        </div><!-- linha -->
        
        <div class="row">
          <div class="col-sm-12">
            <div class="text-right">              
              <a class="btn btn-default" href="<?php echo BASE_URL; ?>public/views/tickets/consulta_tickets.php">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
              </a>

              <a class="btn btn-warning" href="<?php echo BASE_URL; ?>public/views/tickets/edita_tickets.php?ticket=<?php echo $dados['ticket']; ?>&funcao=edita">
                <i class="fa fa-pencil" aria-hidden="true"></i> Editar
              </a>
            </div>
          </div>
        </div>

      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->
  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery_3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
