<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('visualiza_tickets.php')) : ?>

<?php require DIRETORIO_REQUESTS . 'get/processa_ticket.php'; ?>

<?php 

# separando os ids dos chats por espaço
$chats = explode(' ', $dados['historico_chat_id']);

# eliminando espaços vazios
for ($i = 0; $i <= count($chats); $i++) {
  
  # verificando se a posição do array é um espaço vazio
  if (empty($chats[$i])) {

    unset($chats[$i]);

  }

}

?>

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
                    <th class="text-center bg-success" id="titulo" colspan="5">Informações do Ticket</th>
                  </tr>

                  <tr>
                    <th class="text-center bg-success" rowspan="5" width="10%">Dados da Empresa</th>

                    <th class="bg-success" width="10%">Gerado</th>
                    <td class="text-left" width="15%"><?php echo $dados['supervisor']; ?></td>

                    <th class="bg-success" width="10%">Agendado</th>
                    <td class="text-left" width="15%"><?php echo $dados['colaborador']; ?></td>
                  </tr>

                  <tr>                
                    <th class="bg-success">Cnpj</th>
                    <td class="text-left" colspan="3"><?php echo $dados['cnpj']; ?></td>                    
                  </tr>

                  <tr>
                    <th class="bg-success">Contrato</th>
                    <td class="text-left" colspan="3"><?php echo $dados['conta_contrato']; ?></td>                    
                  </tr>

                  <tr>                    
                    <th class="bg-success">Razão Social</th>
                    <td class="text-left" colspan="3"><?php echo $dados['razao_social']; ?></td>                    
                  </tr>
            
                  <tr>
                    <th class="text-center tamanho" colspan="5"></th>
                  </tr>
                  
                  <tr>
                    <th class="text-center bg-success" rowspan="7">Dados do Ticket</th>

                    <th class="bg-success">Ticket</th>
                    <td class="text-left" colspan="3"><?php echo $dados['ticket']; ?></td>                    
                  </tr>

                  <tr>
                    <th class="bg-success">Validade</th>
                    <td class="text-left" colspan="3"><?php echo $dados['validade']; ?></td>
                  </tr>

                  <tr>
                    <th class="bg-success">Data</th>
                    <td class="text-left" class="text-left" colspan="3"><?php echo $dados['data']; ?></td>
                  </tr>

                  <tr>
                    <th class="bg-success">Data Agendada</th>
                    <td class="text-left"><?php echo $dados['data_agendada']; ?></td>

                    <th class="bg-success">Hora Agendada</th>
                    <td class="text-left"><?php echo $dados['hora_agendada']; ?></td>
                  </tr>

                  <tr>
                    <th class="bg-success">Sistema</th>
                    <td class="text-left"><?php echo $dados['produto']; ?></td>

                    <th class="bg-success">Módulo</th>
                    <td class="text-left"><?php echo $dados['modulo']; ?></td>
                  </tr>

                  <tr>
                    <th class="bg-success">Assunto</th>
                    <td class="text-left" colspan="3"><?php echo $dados['assunto']; ?></td>
                  </tr>

                  <tr>
                    <th class="text-center tamanho" colspan="5"></th>
                  </tr>

                  <tr>
                    <th class="text-center bg-success" rowspan="3">Dados do Contato</th>

                    <th class="bg-success">Chats</th>                  
                    <td class="text-left" colspan="3">

                    <?php foreach ($chats as $chat) : ?>
                      <a href="<?php echo BASE_URL; ?>app/requests/get/recebe_chat_id.php?chat=<?php echo $chat; ?>" target="_blank">
                        <?php echo $chat; ?>
                      </a>
                    <?php endforeach; ?>

                    </td>                  
                  </tr>

                  <tr>                  
                    <th class="bg-success">Contato</th>
                    <td class="text-left" colspan="3"><?php echo $dados['contato']; ?></td>                    
                  </tr>                  

                  <tr>
                    <th class="bg-success">Telefone</th>
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

            <?php if ($_SESSION['usuario']['nivel'] == 2) : ?>
              <a class="btn btn-warning" href="<?php echo BASE_URL; ?>public/views/tickets/edita_tickets.php?ticket=<?php echo $dados['ticket']; ?>&funcao=edita">
                <i class="fa fa-pencil" aria-hidden="true"></i> Editar
              </a>
            <?php endif; ?>
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
