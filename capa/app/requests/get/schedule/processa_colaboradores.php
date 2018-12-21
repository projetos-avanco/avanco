<?php

require_once '../../../../init.php';
require_once DIRETORIO_FUNCTIONS . 'users/consulta_conta.php';

# verificando se houve uma requisição via método get
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $db = abre_conexao();

  # chamando função que retorna todos os colaboradores ativos do chat via ajax
  retornaTodosOsColaboradoresAtivosDoChat($db);
}