<?php

/*
 * cria um array modelo para receber as mensagens de erro ou sucesso
 */
function criaModeloDeSessaoParaMensagens()
{
  $_SESSION['mensagens'] = array(
    'mensagem' => '',
    'tipo'     => '',
    'exibe'    => false
  );

}
