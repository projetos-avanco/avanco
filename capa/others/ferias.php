<?php

require 'init.php';
require 'app/helpers/diversas.php';

$db = abre_conexao();

echo geraRegistro($db, 'av_agenda_pedidos_ferias');