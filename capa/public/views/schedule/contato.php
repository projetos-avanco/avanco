<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('contato.php')) : ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Cadastro de Contato</title>

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
    .erro {
      border: 2px solid red;
    }
  </style>
</head>

<body>
  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <h2>Cadastro de Contato</h2>

            <hr>
          </div>
        </div><!-- linha -->

        <br>

        <form action="<?php echo BASE_URL; ?>app/requests/post/schedule/recebe_contato.php" method="post">

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">

                <div class="panel panel-info">
                  <div class="panel-heading">
                    <div class="text-center">
                      <strong>Contato</strong>
                    </div>
                  </div>

                  <div class="panel-body">

                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label class="sr-only" for="nome">Nome</label>
                          <input class="form-control" id="nome" type="text" name="contato[nome]" value="<?php echo (isset($_SESSION['contatos']['nome'])) ? $_SESSION['contatos']['nome'] : ''; ?>" maxlength="100" placeholder="Nome">
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

              </div>
            </div><!-- coluna 1 -->
          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">

                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">

                      <div class="panel panel-info">
                        <div class="panel-heading">
                          <div class="text-center">
                            <strong>Comercial</strong>
                          </div>
                        </div>

                        <div class="panel-body">

                          <div id="lista-fixo">

                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div class="input-group">
                                    <span class="input-group-btn">
                                      <button type="button" class="btn btn-default">
                                        <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
                                      </button>
                                    </span>

                                    <label class="sr-only" for="fixo-0">Telefone Fixo</label>
                                    <input class="form-control" id="fixo-0" type="tel" name="contato[fixo][0]" value="<?php echo (isset($_SESSION['contatos']['fixo'][0])) ? $_SESSION['contatos']['fixo'][0] : ''; ?>" maxlength="14" placeholder="(00) 0000-0000">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <!-- exibindo contatos gravados na sessão -->
                            <?php if (isset($_SESSION['contatos']['fixo']) && count($_SESSION['contatos']['fixo']) > 1) : ?>

                              <?php for ($i = 1; $i < count($_SESSION['contatos']['fixo']); $i++) : ?>

                                <div class="row" id="linha-fixo-<?php echo $i; ?>">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-btn">
                                          <button type="button" class="btn btn-default">
                                            <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
                                          </button>
                                        </span>

                                        <label class="sr-only" for="fixo-<?php echo $i; ?>">Telefone Fixo</label>
                                        <input class="form-control" id="fixo-<?php echo $i; ?>" type="tel" name="contato[fixo][<?php echo $i; ?>]" value="<?php echo $_SESSION['contatos']['fixo'][$i]; ?>" maxlength="14" placeholder="(00) 0000-0000">
                                      </div>
                                    </div>
                                  </div>
                                </div>

                              <?php endfor; ?>

                            <?php endif; ?>
                            <!-- exibindo contatos gravados na sessão -->

                          </div>

                          <div class="row">
                            <div class="col-sm-4 col-sm-offset-2">
                              <button class="btn btn-block btn-info" id="duplicar-fixo" type="button">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                              </button>
                            </div>

                            <div class="col-sm-4">
                              <button class="btn btn-block btn-danger" id="remover-fixo" type="button">
                                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                              </button>
                            </div>
                          </div>

                        </div>
                      </div>

                    </div>
                  </div><!-- coluna 1 -->

                  <div class="col-sm-3">
                    <div class="form-group">

                      <div class="panel panel-info">
                        <div class="panel-heading">
                          <div class="text-center">
                            <strong>Móvel</strong>
                          </div>
                        </div>

                        <div class="panel-body">

                          <div id="lista-movel">

                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div class="input-group">
                                    <span class="input-group-btn">
                                      <button type="button" class="btn btn-default">
                                        <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
                                      </button>
                                    </span>

                                    <label class="sr-only" for="movel-0">Telefone Móvel</label>
                                    <input class="form-control" id="movel-0" type="tel" name="contato[movel][0]" value="<?php echo (isset($_SESSION['contatos']['movel'][0])) ? $_SESSION['contatos']['movel'][0] : ''; ?>" maxlength="15" placeholder="(00) 00000-0000">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <!-- exibindo contatos gravados na sessão -->
                            <?php if (isset($_SESSION['contatos']['movel']) && count($_SESSION['contatos']['movel']) > 1) : ?>

                              <?php for ($i = 1; $i < count($_SESSION['contatos']['movel']); $i++) : ?>

                                <div class="row" id="linha-movel-<?php echo $i; ?>">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-btn">
                                          <button type="button" class="btn btn-default">
                                            <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
                                          </button>
                                        </span>

                                        <label class="sr-only" for="movel-<?php echo $i; ?>">Telefone Móvel</label>
                                        <input class="form-control" id="movel-<?php echo $i; ?>" type="tel" name="contato[movel][<?php echo $i; ?>]" value="<?php echo $_SESSION['contatos']['movel'][$i]; ?>" maxlength="15" placeholder="(00) 00000-0000">
                                      </div>
                                    </div>
                                  </div>
                                </div>

                              <?php endfor; ?>

                            <?php endif; ?>
                            <!-- exibindo contatos gravados na sessão -->

                          </div>

                          <div class="row">
                            <div class="col-sm-4 col-sm-offset-2">
                              <button class="btn btn-block btn-info" id="duplicar-movel" type="button">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                              </button>
                            </div>

                            <div class="col-sm-4">
                              <button class="btn btn-block btn-danger" id="remover-movel" type="button">
                                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                              </button>
                            </div>
                          </div>

                        </div>
                      </div>

                    </div>
                  </div><!-- coluna 2 -->

                  <div class="col-sm-6"><!-- coluna 3 -->
                    <div class="form-group">

                      <div class="panel panel-info">
                        <div class="panel-heading">
                          <div class="text-center">
                            <strong>Eletrônico</strong>
                          </div>
                        </div>

                        <div class="panel-body">

                          <div id="lista-email">

                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <div class="input-group">
                                    <span class="input-group-btn">
                                      <button type="button" class="btn btn-default">
                                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                                      </button>
                                    </span>

                                    <label class="sr-only" for="email-0">E-mail</label>
                                    <input class="form-control" id="email-0" type="email" name="contato[email][0]" value="<?php echo (isset($_SESSION['contatos']['email'][0])) ? $_SESSION['contatos']['email'][0] : ''; ?>" maxlength="100" placeholder="exemplo@exemplo.com.br">
                                  </div>
                                </div>
                              </div>
                            </div>


                            <!-- exibindo contatos gravados na sessão -->
                            <?php if (isset($_SESSION['contatos']['email']) && count($_SESSION['contatos']['email']) > 1) : ?>

                              <?php for ($i = 1; $i < count($_SESSION['contatos']['email']); $i++) : ?>

                                <div class="row" id="linha-email-<?php echo $i; ?>">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-btn">
                                          <button type="button" class="btn btn-default">
                                            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                                          </button>
                                        </span>

                                        <label class="sr-only" for="email-<?php echo $i; ?>">E-mail</label>
                                        <input class="form-control" id="email-<?php echo $i; ?>" type="email" name="contato[email][<?php echo $i; ?>]" value="<?php echo $_SESSION['contatos']['email'][$i]; ?>" maxlength="100" placeholder="exemplo@exemplo.com.br">
                                      </div>
                                    </div>
                                  </div>
                                </div>

                              <?php endfor; ?>

                            <?php endif; ?>
                            <!-- exibindo contatos gravados na sessão -->

                          </div>

                          <div class="row">
                            <div class="col-sm-2 col-sm-offset-4">
                              <button class="btn btn-block btn-info" id="duplicar-email" type="button">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                              </button>
                            </div>

                            <div class="col-sm-2">
                              <button class="btn btn-block btn-danger" id="remover-email" type="button">
                                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                              </button>
                            </div>
                          </div>

                        </div>
                      </div>

                      <div class="row">                        
                        <div class="col-sm-3 col-sm-offset-9">
                          <div class="form-group">
                            <button class="btn btn-block btn-success" type="submit" name="submit" value="submit">
                              <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
                              Gravar
                            </button>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div><!-- coluna 3 -->
                </div>

              </div>
            </div>
          </div>

          <input id="id" type="hidden" name="contato[id]">

        </form>

        <?php if ((!empty($_SESSION['atividades']['mensagens'])) && $_SESSION['atividades']['exibe'] == true) : ?>

          <?php for ($i = 0; $i < count($_SESSION['atividades']['mensagens']); $i++) : ?>
            <div class="row">
              <div class="col-sm-12">
                <div class="text-left">
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

        <?php unset($_SESSION['atividades']['mensagens'], $_SESSION['atividades']['tipo']); ?>
      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/contact/recupera_id_cnpj.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/contact/mascaras.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/contact/duplica_fixo.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/contact/duplica_movel.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/contact/duplica_email.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/contact/remove_fixo.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/contact/remove_movel.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/contact/remove_email.js"></script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
