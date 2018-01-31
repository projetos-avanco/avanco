<?php 

require '../init.php';

require DIRETORIO_MODULES  . 'avancoins/avancoins.php';

$db = abre_conexao();

if ($db) {

  $query = "SELECT id FROM av_avancoins_carteiras ORDER BY id;";

  if ($resultado = $db->query($query)) {

    $ids = array();

    while ($registro = $resultado->fetch_assoc()) {

      $ids[] = $registro['id'];

    }

  }

  foreach ($ids as $id) {

    # chamando função responsável por atualizar as ações diárias do colaborador no período atual
    atualizaAcoesDiarias($id);

    # chamando função responsável por atualizar as ações mensais do colaborador no período atual
    atualizaAcoesMensais($id);

    # chamando função responsável por atualizar a quantidade de moedas na carteira do colaborador
    atualizaCarteira($id);

  }

}