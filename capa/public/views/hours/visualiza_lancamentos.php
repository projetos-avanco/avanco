<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('visualiza_lancamentos.php')) : ?>

<?php require DIRETORIO_REQUESTS . 'get/processa_lancamentos_horas.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Visualização de Lançamentos</title>

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
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/hours/tabela_visualiza_lancamentos.css">

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
            <h2>Visualização Lançamentos</h2>

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
                    <th class="text-center bg-success" id="titulo" colspan="5">Registro de Horas</th>
                  </tr>

                  <tr>
                    <th class="text-center bg-success" width="10%" rowspan="5">Dados do Registro</th>

                    <th class="bg-success" width="10%">Cnpj</th>
                    <td class="text-left" width="15%"><?php echo $dados['cnpj']; ?></td>

                    <th class="bg-success" width="10%">Issue</th>
                    <td class="text-left" width="15%"><?php echo $dados['issue']; ?></td>                    
                  </tr>

                  <tr>
                    <th class="bg-success">Conta Contrato</th>
                    <td class="text-left"><?php echo $dados['conta_contrato']; ?></td>

                    <th class="bg-success">Supervisor</th>
                    <td class="text-left"><?php echo $dados['supervisor']; ?></td>                     
                  </tr>

                  <tr>                    
                    <th class="bg-success">Razão Social</th>
                    <td class="text-left"><?php echo $dados['razao_social']; ?></td>

                    <th class="bg-success">Colaborador</th>
                    <td class="text-left"><?php echo $dados['colaborador']; ?></td>
                  </tr>

                  <tr>
                    <th class="bg-success">Observação</th>
                    <td class="text-left" colspan="3"><?php echo $dados['observacao']; ?></td>
                  </tr>

                  <tr>
                    <th class="text-center tamanho" colspan="5"></th>
                  </tr>

                  <tr>
                    <th class="text-center bg-success" rowspan="5">Dados de Despesas</th>               

                    <th class="bg-success">Deslocamento</th>
                    <td class="text-left"><?php echo $dados['deslocamento']; ?></td>

                    <th class="bg-success">Tipo</th>
                    <td class="text-left"><?php echo $dados['tipo']; ?></td>
                  </tr>

                  <tr>                  
                    <th class="bg-success">Alimentação</th>
                    <td class="text-left" colspan="5"><?php echo $dados['alimentacao']; ?></td>
                  </tr>

                  <tr>              
                    <th class="bg-success">Hospedagem</th>
                    <td class="text-left" colspan="5"><?php echo $dados['hospedagem']; ?></td>
                  </tr>

                  <tr>                    
                    <th class="bg-success">Total</th>
                    <td class="text-left" colspan="5"><?php echo $dados['total_despesas']; ?></td>                    
                  </tr>
                                    
                  <?php

                    # gravando o número da issue para usar no botão de edição
                    $issue = $dados['issue'];

                    # eliminando posição que não serão usadas
                    unset($dados['id'],
                          $dados['cnpj'],
                          $dados['conta_contrato'],                    
                          $dados['razao_social'],
                          $dados['issue'],
                          $dados['supervisor'],
                          $dados['id_colaborador'],
                          $dados['colaborador'],
                          $dados['observacao'],
                          $dados['deslocamento'],
                          $dados['alimentacao'],
                          $dados['hospedagem'],
                          $dados['total_despesas'],
                          $dados['tipo']);

                    $contador = 1;

                  ?>
                  
                  <?php foreach ($dados as $chave => $valor) : ?>
                    <tr>
                      <th class="text-center tamanho" colspan="5"></th>
                    </tr>

                    <tr>
                      <th class="text-center bg-success" rowspan="7" >Dados do Lançamento <?php echo $contador; ?></th>
                    </tr>                   

                    <tr>
                      <th class="bg-success">Data</th>
                      <td class="text-left"><?php echo $valor['data']; ?></td>

                      <th class="bg-success">Produto</th>
                      <td class="text-left"><?php echo $valor['produto']; ?></td>                    
                    </tr>

                    <tr>
                      <th class="bg-success">Horas Trabalhadas</th>
                      <td class="text-left" colspan="5"><?php echo $valor['horas_trabalhadas']; ?></td>
                    </tr>

                    <tr>
                      <th class="bg-success">Horas Faturadas</th>
                      <td class="text-left" colspan="5"><?php echo $valor['horas_faturadas']; ?></td>                      
                    </tr>

                    <tr>
                      <th class="bg-success">Valor da Hora</th>
                      <td class="text-left" colspan="5"><?php echo $valor['valor_hora']; ?></td>                      
                    </tr>

                    <tr>
                      <th class="bg-success">Total</th>
                      <td class="text-left" colspan="5"><?php echo $valor['total']; ?></td>                      
                    </tr>

                    <?php $contador++; ?>
                    
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>    
          </div><!-- coluna -->          
        </div><!-- linha -->
        
        <div class="row">
          <div class="col-sm-12">
            <div class="text-right">              
              <a class="btn btn-default" href="<?php echo BASE_URL; ?>public/views/hours/consulta_lancamentos.php">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar
              </a>

              <a class="btn btn-warning" href="<?php echo BASE_URL; ?>public/views/hours/edita_lancamentos.php?issue=<?php echo $issue; ?>">
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
