<?php

require DIRETORIO_FUNCTIONS . 'graphics/conhecimento.php';

# verificando se existe a sessão de colaborador
if (isset($_SESSION['colaborador'])) {

  # recuperando id do colaborador
  $id = $_SESSION['colaborador']['id'];

  # abrindo conexão com a base de dados
  $conexao = abre_conexao();

  # chamando função que verifica o nível de conhecimento do colaborador em cada módulo do sistema
  verificaConhecimentoDoColaborador($conexao, $id);

} else {

  #erro, não existe a sessão usuário
  exit;

}
