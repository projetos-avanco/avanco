<?php

require '../../modules/screen/colaborador.php';

# verificando se foi enviado requisição via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  # chamando função que consulta os colaboradores existentes no chat e cria as opções para o select da tela de ticket
  criaOpcoesDeColaboradores();

}
