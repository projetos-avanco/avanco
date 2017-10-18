<?php

require '../../modules/screen/colaborador.php';

# verificando se foi enviado requisição via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  # chamando função responsável por criar as opções com os dados dos colaboradores
  criaOpcoesDeColaboradores();

}
