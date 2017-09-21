<?php

require '../../init.php';

require ABS_PATH . 'app/models/cliente.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $cliente = criaModeloDeCliente();

} else {

  # não recebeu requisição via método POST

}
