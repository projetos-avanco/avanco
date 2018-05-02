<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('edita_lancamentos.php')) : ?>

<?php

  require DIRETORIO_REQUESTS . 'get/processa_lancamentos_horas.php';
  
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

  <title>Portal Avanção - Edição Lançamentos</title>

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
      <h2>Edição Lançamentos</h2>

      <form action="<?php echo BASE_URL; ?>app/requests/post/recebe_horas_editadas.php" method="post" accept-charset="utf-8">

        <hr>

        <div class="row"><!-- linha -->
          <div class="col-sm-6 col-sm-offset-3"><!-- coluna 1 campo pesquisa -->
            <div class="input-group h2">
              <input class="form-control" id="pesquisa" type="text" placeholder="Pesquise por CNPJ ou Razão Social">

              <span class="input-group-btn">
                <button class="btn btn-primary" type="button">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
            </div>
          </div><!-- coluna 1 campo pesquisa -->
        </div><!-- linha -->

        <br>

        <div class="row"><!-- linha -->
          <div class="col-sm-12"><!-- coluna 1 tabela clientes e imagem loader -->
            <div id="bloco"><!-- tabela clientes -->
              
            </div><!-- tabela clientes -->
            
            <div class="hidden text-center" id="loader"><!-- imagem loader -->
              <img src="<?php echo BASE_URL; ?>../tickets/public/img/others/loader.gif" alt="loader" width="10%" height="10%">
            </div><!-- imagem loader -->
          </div><!-- coluna 1 tabela clientes e imagem loader -->
        </div><!-- linha -->

        <br>

        <div class="row"><!-- linha -->
          <div class="col-sm-12"><!-- coluna 1 campo razão social -->
            <div class="form-group">
              <label for="razao-social">Razão Social</label>

              <input class="form-control required" id="razao-social" type="text" name="issues[razao-social]" value="<?php echo $dados['razao_social']; ?>" placeholder="Razão Social" readonly="true">
            </div>
          </div><!-- coluna 1 campo razão social -->
        </div><!-- linha -->

        <br>

        <div class="row"><!-- linha -->
          <div class="col-sm-8"><!-- coluna 1 campo cnpj -->
            <div class="form-group">
              <label for="cnpj">CNPJ</label>

              <input class="form-control required" id="cnpj" type="text" name="issues[cnpj]" value="<?php echo $dados['cnpj']; ?>" placeholder="CNPJ" readonly="true">
            </div>
          </div><!-- coluna 1 campo cnpj -->

          <div class="col-sm-4"><!-- coluna 2 campo conta contrato -->
            <div class="form-group">
              <label for="conta-contrato">Conta Contrato</label>

              <input class="form-control required" id="conta-contrato" type="text" name="issues[conta-contrato]" value="<?php echo $dados['conta_contrato']; ?>" placeholder="Conta Contrato" readonly="true">
            </div>
          </div><!-- coluna 2 campo conta contrato -->
        </div><!-- linha -->

        <br>

        <div class="row"><!-- linha -->
          <div class="col-sm-8"><!-- coluna 1 campo supervisor -->
            <div class="form-group">
              <label for="supervisor">Supervisor</label>

              <input class="form-control" type="text" value="<?php echo $dados['supervisor']; ?>" readonly="true">

              <input type="hidden" name="issues[supervisor]" value="<?php echo $id; ?>"><!-- id do supervisor -->
            </div>
          </div><!-- coluna 1 campo supervisor -->

          <div class="col-sm-2"><!-- coluna 2 campo colaborador registrado -->
            <div class="form-group">
              <label for="supervisor">Colaborador</label>

              <select class="form-control" name="issues[colaborador]" id="colaborador-registrado" readonly="true">
                <option value="<?php echo $dados['id_colaborador']; ?>">
                  <?php echo $dados['colaborador']; ?>                  
                </option>
              </select>
            </div>
          </div><!-- coluna 2 campo colaborador registrado -->

          <div class="col-sm-2"><!-- coluna 3 campo colaboradores -->
            <label for="colaborador">Lista Colaboradores</label>                  
            <select class="form-control required" id="colaborador">
              
            </select>
          </div><!-- coluna 3 campo colaboradores -->
        </div><!-- linha -->

        <br>

        <div class="row"><!-- linha -->
          <div class="col-sm-12"><!-- coluna -->

            <div class="row"><!-- linha interna 1 -->
              <div class="col-sm-2"><!-- coluna 1 -->
                <label for="issue">Issue</label>

                <input class="form-control required" type="text" name="issues[issue]" value="<?php echo $dados['issue']; ?>" placeholder="Número da Issue">

                <input type="hidden" name="issues[id]" value="<?php echo $dados['id']; ?>"> <!-- id da issue -->

                <br>

                <label for="tipo">Tipo</label>

                <?php if ($dados['tipo'] == 'Remoto') : ?>
                  
                  <select class="form-control" name="issues[tipo]">
                    <option value="remoto" selected>Remoto</option>
                    <option value="in-loco">In-Loco</option>
                  </select>

                <?php else : ?>

                  <select class="form-control" name="issues[tipo]">
                    <option value="remoto">Remoto</option>
                    <option value="in-loco" selected>In-Loco</option>
                  </select>                      

                <?php endif; ?>

              </div><!-- coluna 1 -->

              <div class="col-sm-4 col-sm-offset-6"><!-- coluna 2 -->

                <div class="hidden" id="bloco-despesas"><!-- bloco despesas -->

                  <div class="row"><!-- linha interna 1 -->
                    <div class="col-sm-12"><!-- coluna 1 da linha interna 1 campo deslocamento -->
                      <div class="form-group">
                        <label for="deslocamento">Deslocamento</label>

                        <input class="form-control" id="deslocamento" type="text" name="despesas[deslocamento]" value="<?php echo $dados['deslocamento']; ?>">
                      </div>
                    </div><!-- coluna 1 da linha interna 1 campo deslocamento -->
                  </div><!-- linha interna 1 -->
                  
                  <div class="row"><!-- linha interna 2 -->
                    <div class="col-sm-12"><!-- coluna 1 da linha interna 2 campo alimentação -->
                      <div class="form-group">
                        <label for="alimentacao">Alimentação</label>

                        <input class="form-control" id="alimentacao" type="text" name="despesas[alimentacao]" value="<?php echo $dados['alimentacao']; ?>">
                      </div>
                    </div><!-- coluna 1 da linha interna 2 campo alimentação -->
                  </div><!-- linha interna 2 -->
                  
                  <div class="row"><!-- linha interna 3 -->
                    <div class="col-sm-12"><!-- coluna 1 da linha interna 3 campo hospedagem -->
                      <div class="form-group">
                        <label for="hospedagem">Hospedagem</label>

                        <input class="form-control" id="hospedagem" type="text" name="despesas[hospedagem]" value="<?php echo $dados['hospedagem']; ?>">
                      </div>
                    </div><!-- coluna 1 da linha interna 3 campo hospedagem -->
                  </div><!-- linha interna 3 -->

                  <div class="row"><!-- linha interna 4 -->
                    <div class="col-sm-12"><!-- coluna 1 da linha interna 4 campo total -->
                      <div class="form-group">
                        <label for="total-despesas">Total Despesas</label>

                        <input class="form-control" id="total-despesas" type="text" name="despesas[total-despesas]" value="<?php echo $dados['total_despesas']; ?>" readonly="true">
                      </div>
                    </div><!-- coluna 1 da linha interna 4 campo total -->
                  </div><!-- linha interna 4 -->

                </div><!-- bloco despesas -->

              </div><!-- coluna 2 -->
            </div><!-- linha interna 1 -->

          </div><!-- coluna -->
        </div><!-- linha -->

        <?php 

          # limpando posições do array que não serão utilizadas nos lançamentos
          unset($dados['id'], 
                $dados['issue'], 
                $dados['tipo'], 
                $dados['cnpj'], 
                $dados['conta_contrato'],
                $dados['razao_social'],
                $dados['supervisor'],
                $dados['colaborador'],
                $dados['id_colaborador'],
                $dados['deslocamento'],
                $dados['alimentacao'],
                $dados['hospedagem'],
                $dados['total_despesas']); 
          
          # alterando o formato das datas dos lançamentos
          for ($i =0; $i < count($dados); $i++) {

            $dados[$i]['data'] = formataDataUnicaParaMysql($dados[$i]['data']);

          }
          
          # contador usado nos attr's dos lançamentos
          $contador = 0;

        ?>
        
        <br>

        <div class="row"><!-- linha -->
          <div class="col-sm-12"><!-- coluna -->
            <hr>
            <div id="lancamentos"><!-- bloco lançamentos -->

              <?php foreach ($dados as $chave => $valor) : ?>

              <div class="row" numero-bloco="<?php echo $contador; ?>"><!-- linha 1-->               
                <div class="col-sm-12"><!-- coluna 1 -->                
                  <div class="row"><!-- linha interna 2 -->
                    <div class="col-sm-2"><!-- coluna 1 da linha interna 2 campo data -->                    
                      <label for="data">Data</label>

                      <input class="form-control required" id="data" type="date" name="lancamentos[<?php echo $contador; ?>][data]" numero="<?php echo $contador; ?>" value="<?php echo $valor['data']; ?>">
                    </div><!-- coluna 1 da linha interna 2 campo data -->
                  </div><!-- linha interna 2 -->

                  <br> 

                  <div class="row"><!-- linha interna 3 -->
                    <div class="col-sm-2"><!-- coluna 1 da linha interna 3 campo produto -->
                      <label for="produto">Produto</label>

                      <select class="form-control required" id="produto" name="lancamentos[<?php echo $contador; ?>][produto]" numero="<?php echo $contador; ?>">

                      <?php if ($valor['produto'] == 'Integral') : ?>

                        <option value="0">Selecione um Produto</option>
                        <option value="1" selected>Integral</option>
                        <option value="2">Frente de Loja</option>
                        <option value="3">Gestor</option>
                        <option value="4">Novo ERP</option>
                      
                      <?php elseif ($valor['produto'] == 'Frente de Loja') : ?>

                        <option value="0">Selecione um Produto</option>
                        <option value="1">Integral</option>
                        <option value="2" selected>Frente de Loja</option>
                        <option value="3">Gestor</option>
                        <option value="4">Novo ERP</option>

                      <?php elseif ($valor['produto'] == 'Gestor') : ?>

                        <option value="0">Selecione um Produto</option>
                        <option value="1">Integral</option>
                        <option value="2">Frente de Loja</option>
                        <option value="3" selected>Gestor</option>
                        <option value="4">Novo ERP</option>

                      <?php elseif ($valor['produto'] == 'Novo ERP') : ?>

                        <option value="0">Selecione um Produto</option>
                        <option value="1">Integral</option>
                        <option value="2">Frente de Loja</option>
                        <option value="3">Gestor</option>
                        <option value="4" selected>Novo ERP</option>
                      
                      <?php endif; ?>

                      </select>
                    </div><!-- coluna 1 da linha interna 3 campo produto -->
                  </div><!-- linha interna 3 -->

                  <br> 

                  <div class="row"><!-- linha interna 4 --> 
                    <div class="col-sm-2"><!-- coluna 1 da linha interna 4 campo horas trabalhadas -->
                      <label for="horas-trabalhadas">Horas Trabalhadas</label>

                      <input class="form-control required" id="horas-trabalhadas" type="time" name="lancamentos[<?php echo $contador; ?>][horas-trabalhadas]" numero="<?php echo $contador; ?>" value="<?php echo $valor['horas_trabalhadas']; ?>">
                    </div><!-- coluna 1 da linha interna 4 campo horas trabalhadas -->

                    <div class="col-sm-2"><!-- coluna 2 da linha interna 4 campo horas faturadas -->
                      <label for="horas-faturadas">Horas Faturadas</label>

                      <input class="form-control required" id="horas-faturadas" type="time" name="lancamentos[<?php echo $contador; ?>][horas-faturadas]" numero="<?php echo $contador; ?>" value="<?php echo $valor['horas_faturadas']; ?>">
                    </div><!-- coluna 2 da linha interna 4 campo horas faturadas -->
                  </div><!-- linha interna 4 -->

                  <br> 

                  <div class="row"><!-- linha interna 5 -->
                    <div class="col-sm-2"><!-- coluna 1 da linha interna 5 campo horas valor hora -->
                      <label for="valor-horas">Valor Horas</label>

                      <input class="form-control required" id="valor-horas" type="text" name="lancamentos[<?php echo $contador; ?>][valor-horas]" numero="<?php echo $contador; ?>" value="<?php echo $valor['valor_hora']; ?>">
                    </div><!-- coluna 1 da linha interna 5 campo horas valor hora -->

                    <div class="col-sm-2"><!-- coluna 2 da linha interna 5 campo total -->
                      <label for="valor-toral">Valor Total</label>

                      <input class="form-control required" id="valor-total" type="text" name="lancamentos[<?php echo $contador; ?>][valor-total]" numero="<?php echo $contador; ?>" value="<?php echo $valor['total']; ?>">
                    </div><!-- coluna 2 da linha interna 5 campo total -->
                  </div><!-- linha interna 5 -->

                  <br>

                  <div class="row">
                    <div class="col-sm-1">
                      <button class="btn btn-danger btn-block" id="botao-excluir" type="button" numero-botao="<?php echo $contador; ?>">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                      </button>
                    </div>
                  </div>
                                    
                  <hr>

                </div><!-- coluna 1 -->
              </div><!-- linha 1 -->

                <?php $contador++; ?>
              <?php endforeach; ?>

            </div><!-- bloco lançamentos -->
          </div><!-- coluna -->
        </div><!-- linha -->

        <div class="row"><!-- linha -->
          <div class="col-sm-6"><!-- coluna 1 -->

            <div class="row"><!-- linha interna -->
              <div class="col-sm-2"><!-- coluna 1 da linha interna botão acrescentar novo lançamento -->
                <button class="btn btn-primary btn-block" id="botao" type="button">
                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
              </div><!-- coluna 1 da linha interna botão acrescentar novo lançamento -->
            </div><!-- linha interna -->

          </div><!-- coluna 1 -->

          <div class="col-sm-6 text-right"><!-- coluna 2 -->
            <a class="btn btn-danger" href="<?php echo BASE_URL; ?>public/views/hours/consulta_lancamentos.php"><!-- botão cancelar -->
              <i class="fa fa-times" aria-hidden="true"></i> Cancelar
            </a><!-- botão cancelar -->

            <a class="btn btn-info" href="<?php echo BASE_URL; ?>public/views/hours/edita_lancamentos.php?issue=<?php echo $_GET['issue']; ?>"><!-- botão atualizar -->
            <i class="fa fa-refresh" aria-hidden="true"></i> Atualizar
            </a><!-- botão atualizar -->

            <button class="btn btn-success" type="submit"><!-- botão gravar -->
              <i class="fa fa-floppy-o" aria-hidden="true"></i> Gravar
            </button><!-- botão gravar -->
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

  <script src="<?php echo BASE_URL; ?>../tickets/public/js/screen/colaboradores.js"></script>
  <script src="<?php echo BASE_URL; ?>../tickets/public/js/screen/modulos.js"></script>
  <script src="<?php echo BASE_URL; ?>../tickets/public/js/screen/pesquisa.js"></script>
  <script src="<?php echo BASE_URL; ?>../tickets/public/js/screen/seleciona.js"></script>
  <!--<script src="<?php echo BASE_URL; ?>/public/js/hours/validacao.js"></script>-->
  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>  
  <script src="<?php echo BASE_URL; ?>public/js/hours/edit/lancamentos.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/hours/edit/despesas.js"></script>  
  <script src="<?php echo BASE_URL; ?>public/js/hours/edit/tipo_atendimento.js"></script>  
  <script src="<?php echo BASE_URL; ?>public/js/hours/edit/duplicar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/hours/edit/remover_lancamentos.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/hours/edit/altera_colaborador.js"></script>  
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
