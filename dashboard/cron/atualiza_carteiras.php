<?php 

require '../init.php';

require DIRETORIO_MODULES  . 'avancoins/avancoins.php';

$db = abre_conexao();

# verificando se a conexão com a base de dados foi realizada com sucesso
if ($db) {

  $query = "SELECT id FROM av_avancoins_carteiras ORDER BY id;";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $ids = array();

    # recuperando todos os ids dos colaboradores que recebem avancoins
    while ($registro = $resultado->fetch_assoc()) {

      $ids[] = $registro['id'];

    }

  }

  # atualizando a carteira de todos os colaboradores que recebem avancoins
  foreach ($ids as $id) {

    # chamando função responsável por atualizar as ações diárias do colaborador no período atual
    atualizaAcoesDiarias($id);

    # chamando função responsável por atualizar as ações mensais do colaborador no período atual
    atualizaAcoesMensais($id);

    # chamando função responsável por atualizar a quantidade de moedas na carteira do colaborador
    atualizaCarteira($id);

  }

  fecha_conexao($db);

}