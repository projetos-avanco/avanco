<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('edita_cadastro.php')) : ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Edita de Usuário</title>

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

   <!-- dispositivos com largura máxima de 769px (por exemplo tablets) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbartablet.css" type="text/css" media="screen and (max-width: 769px)" />
  <!-- dispositivos com largura máxima de 450px (por exemplo smartphones) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbarsmart.css" type="text/css" media="screen and (max-width:450px)" />

  <style>
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

    table thead tr th {
      font-size: 0.85em;
      text-align: left;
    }

    table tbody tr td {
      height: 0.1em;      
    }

    .table tbody tr td {
      font-size: 12px;
      vertical-align: middle;
      padding-top: 0.5%;
      padding-left: 5%;
      padding-bottom: 0.5%;
    }

    .table {
      font-family: 'Lato Regular', sans-serif;
    }
  </style>
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <h2>Edição de Usuário</h2>
                <hr>
              </div>
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

          <form action="<?php echo BASE_URL; ?>app/requests/post/users/recebe_edicao_cadastro.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <div class="row"><!-- linha principal -->
              <div class="col-sm-6"><!-- primeira coluna principal -->

                <div class="row"><!-- painel dashboard -->
                  <div class="col-sm-12">

                    <div class="panel panel-info"><!-- panel -->
                      <div class="panel-heading">
                        <div class="text-left">
                          <strong>Dashboard</strong>
                        </div>
                      </div>

                      <div class="panel-body"><!-- panel-body -->
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="sr-only" for="time">Times</label>
                              <select class="form-control" id="time" name="cadastro[time]">
                                <option value="1" selected>Times</option>

                                <optgroup label="Materiais">
                                  <option value="2">Os Templários</option>
                                </optgroup>

                                <optgroup label="Financeiro">
                                  <option value="3">Divergente</option>
                                </optgroup>

                                <optgroup label="Fiscal">
                                  <option value="4">Gulliver</option>
                                </optgroup>

                                <optgroup label="Frente">
                                  <option value="5">Avalanche</option>  
                                </optgroup>                                                                                                                          
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="sr-only" for="foto">Foto</label>
                              <span class="btn btn-danger btn-block btn-file">
                                Anexar Foto <input id="foto" type="file" name="foto">
                              </span>
                            </div>
                          </div>                          
                        </div>

                        <div class="row">
                          <div class="col-sm-12">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th class="text-center" colspan="4">Módulos</th>
                                </tr>

                                <tr>
                                  <th class="text-center">Integral</th>
                                  <th class="text-center">Frente</th>
                                  <th class="text-center">Gestor</th>
                                  <th class="text-center">Novo ERP</th>
                                </tr>
                              </thead>

                              <tbody>
                                <tr>
                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="1" name="cadastro[opcoes][1]" value="1"> Materiais
                                      </label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="8" name="cadastro[opcoes][8]" value="2"> Frente Windows
                                      </label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="14" name="cadastro[opcoes][14]" value="3"> Instalação
                                      </label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="19" name="cadastro[opcoes][19]" value="4"> Instalação
                                      </label>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="2" name="cadastro[opcoes][2]" value="1"> Fiscal
                                      </label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="9" name="cadastro[opcoes][9]" value="2"> Frente Linux
                                      </label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="15" name="cadastro[opcoes][15]" value="3"> Cadastro
                                      </label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="20" name="cadastro[opcoes][20]" value="4"> Pessoas
                                      </label>
                                    </div>
                                  </td>
                                </tr>
                                
                                <tr>
                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="3" name="cadastro[opcoes][3]" value="1"> Financeiro
                                      </label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="10" name="cadastro[opcoes][10]" value="2"> Supervisor
                                      </label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="16" name="cadastro[opcoes][16]" value="3"> Movimento
                                      </label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="21" name="cadastro[opcoes][21]" value="4"> Produtos
                                      </label>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="4" name="cadastro[opcoes][4]" value="1"> Contábil
                                      </label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="11" name="cadastro[opcoes][11]" value="2"> Scanntech
                                      </label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="17" name="cadastro[opcoes][17]" value="3"> Contábil
                                      </label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="22" name="cadastro[opcoes][22]" value="4"> Fiscal
                                      </label>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="5" name="cadastro[opcoes][5]" value="1"> Cotação
                                      </label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="12" name="cadastro[opcoes][12]" value="2"> Sitef
                                      </label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="18" name="cadastro[opcoes][18]" value="3"> Fiscal
                                      </label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="23" name="cadastro[opcoes][23]" value="4"> Financeiro
                                      </label>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="6" name="cadastro[opcoes][6]" value="1"> TNFE
                                      </label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="13" name="cadastro[opcoes][13]" value="2"> Comandas
                                      </label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label></label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="24" name="cadastro[opcoes][24]" value="4"> Lançamentos
                                      </label>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="7" name="cadastro[opcoes][7]" value="1"> WMS
                                      </label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="30" name="cadastro[opcoes][30]" value="2"> NFC-e
                                      </label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label></label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="25" name="cadastro[opcoes][25]" value="4"> Relatórios e Gráficos
                                      </label>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="29" name="cadastro[opcoes][29]" value="1"> NFC-e
                                      </label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label></label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label></label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="26" name="cadastro[opcoes][26]" value="4"> Importação e Exportação
                                      </label>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td>
                                    <div class="checkbox">
                                      <label></label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label></label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label></label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="27" name="cadastro[opcoes][27]" value="4"> Configurações PDV
                                      </label>
                                    </div>
                                  </td>
                                </tr>

                                <tr>
                                  <td>
                                    <div class="checkbox">
                                      <label></label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label></label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label></label>
                                    </div>
                                  </td>

                                  <td>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" id="28" name="cadastro[opcoes][28]" value="4"> Minha Conta
                                      </label>
                                    </div>
                                  </td>  
                                </tr>
                              </tbody>
                            </table>

                          </div>
                        </div>

                      </div><!-- panel-body -->
                    </div><!-- panel -->

                  </div>
                </div><!-- painel dashboard -->

              </div><!-- primeira coluna principal -->

              <div class="col-sm-6"><!-- segunda coluna principal -->
                <div class="row"><!-- painel usuário -->
                  <div class="col-sm-12">

                    <div class="panel panel-info"><!-- panel -->
                      <div class="panel-heading">
                        <div class="text-left">
                          <strong>Usuário</strong>
                        </div>
                      </div>

                      <div class="panel-body"><!-- panel-body -->
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label for="colaborador">Lista Colaboradores</label>
                              <select class="form-control required" id="colaborador" name="cadastro[colaborador]">

                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="senha">Senha</label>
                              <input class="form-control required" id="senha" type="password" name="cadastro[senha]" placeholder="Senha para o Portal Avanção">
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="repita-senha">Confirmação Senha</label>
                              <input class="form-control required" id="repita-senha" type="password" name="cadastro[repita-senha]" placeholder="Confirmação de Senha para o Portal Avanção">
                            </div>
                          </div>                          
                        </div>

                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="nivel">Nível</label>
                              <select class="form-control" id="nivel" name="cadastro[nivel]">
                                <option value="0" selected>Nível de Usuário</option>
                                <option value="1">Suporte</option>
                                <option value="2">Administrador</option>
                                <option value="3">Estagiário</option>
                              </select>
                            </div>
                          </div>                                                    
                        </div>

                        <div class="row hidden" id="bloco-contrato">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="contrato">Contrato</label>
                              <select class="form-control" name="cadastro[contrato]" id="contrato">
                                <option value="1" selected>Contrato Semestral</option>
                                <option value="2">Contrato Anual</option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="data-admissao">Data Admissão</label>
                              <input class="form-control" id="data-admissao" type="date" name="cadastro[admissao]" placeholder="Admissão">
                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="ramal">Ramal</label>
                              <input class="form-control" id="ramal" type="text" name="cadastro[ramal]" placeholder="Ramal">
                            </div>
                          </div>
                        </div>
                      </div><!-- panel-body -->

                      <input type="hidden" id="id-portal" name="cadastro[id-portal]">
                      <input type="hidden" id="nome" name="cadastro[nome]">
                      <input type="hidden" id="sobrenome" name="cadastro[sobrenome]">
                    </div><!-- panel -->                  
                  </div>
                </div><!-- painel usuário -->
                
                <div class="row">
                  <div class="col-sm-3 col-sm-offset-6">
                    <div class="form-group">
                      <button class="btn btn-block btn-default btn-sm" type="reset">
                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                        Resetar
                      </button>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <button class="btn btn-block btn-success btn-sm" type="submit" name="submit" value="users">
                        <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
                        Gravar
                      </button>
                    </div>
                  </div>
                </div>
                
              </div><!-- segunda coluna principal -->
            </div><!-- linha principal -->

          </form>

          <?php unset($_SESSION['atividades']); ?>

      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->
  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery_3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/colaboradores.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/users/recupera_dados.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/users/verifica_nivel.js"></script>

  <script>
    $(function() {
      $(document).ready(function(e) {
        e.preventDefault;

        // adicionando classe disabled nos checkboxes
        $('.checkbox').addClass('disabled');

        // adicionando atributo disabled nos inputs checkboxes
        $('input:checkbox').prop('disabled', 'disabled');

        // percorrendo e desmarcando todos os checkboxes que estiverem marcados
        $('input:checkbox').each(function () {
          $(this).prop('checked', false);
        });

        // adicionando atributo disabled no select de times
        $('#time').prop('disabled', 'disabled');

        // percorrendo options do select de times
        $('#time option').each(function () {
          // adicionando o atributo selected no option de valor 1, nos outros, retirando o selected
          if ($(this).val() == 1) {
            $(this).prop('selected', true);
          } else {
            $(this).prop('selected', false);
          }
        });

        // adicionando o atributo disabled do input file
        $('#foto').prop('disabled', true);
        $('#foto').val('');

        // ocultando bloco de contrato de estagiário
        $('#bloco-contrato').addClass('hidden');
        $('#bloco-contrato').prop('disabled', true);

        // ocultando bloco de contrato de estagiário
        $('#bloco-contrato').addClass('hidden');
        $('#bloco-contrato').prop('disabled', true);

        $('#senha').prop('disabled', 'disabled');
        $('#repita-senha').prop('disabled', 'disabled');
        $('#nivel').prop('disabled', 'disabled');
        $('#contrato').prop('disabled', 'disabled');
        $('#data-admissao').prop('disabled', 'disabled');
        $('#ramal').prop('disabled', 'disabled');
      });
    });
  </script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
