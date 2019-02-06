<?php

require_once '../../../../init.php';
require_once DIRETORIO_MODULES . 'vacation/modulo_manifestacao.php';

# verificando se houve uma requisição via método get
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  # chamando função responsável por retornar todos os exercícios de férias
  retornaTodosOsExerciciosDeFerias();
}