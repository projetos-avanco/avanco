<?php

# verificando se a sessão de gráficos foi criada
if ($_SESSION['graficos']) {

  $graficos = array();

  # recuperando os níveis de conhecimento do colaborador em cada módulo
  $graficos = $_SESSION['graficos'];

  # eliminando sessão
  unset($_SESSION['graficos']);
}
