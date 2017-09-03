<?php

if (isset($_SESSION['usuario'])) {

  $id = $_SESSION['usuario']['id'];

  $conexao = abre_conexao();

  verificaConhecimentoDoColaborador($conexao, $id);

}
