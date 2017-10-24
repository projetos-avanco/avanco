<?php

require '../../../init.php';
require DIRETORIO_HELPERS . 'data.php';

# verificando se houve requisição via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  # recuperando dados enviados pelo AJAX
  $arr = array(
    'id'     => isset($_GET['id'])    ? $_GET['id']    : NULL,
    'data_1' => isset($_GET['data1']) ? $_GET['data1'] : NULL,
    'data_2' => isset($_GET['data2']) ? $_GET['data2'] : NULL
  );

  # verificando se todos os dados foram enviados
  if (! empty($arr['id']) AND ! empty($arr['data_1']) AND ! empty($arr['data_2'])) {

    # abrindo conexão com a base de dados
    $db = abre_conexao();

    # chamando função que formata a data para aaaa-mm-dd
    $arr = formataDataParaMysql($arr);

    $query =
      "SELECT
          B.id AS chat_id
      FROM
          (SELECT av_questionario_interno.id_chat FROM av_questionario_interno
          INNER JOIN lh_chat
              ON lh_chat.id = av_questionario_interno.id_chat
          WHERE (lh_chat.status = 2)
              AND (lh_chat.user_id = {$arr['id']})
              AND (FROM_UNIXTIME(lh_chat.time, '%Y-%m-%d') BETWEEN '{$arr['data_1']}' AND '{$arr['data_2']}')) AS A

      RIGHT JOIN

          (SELECT lh_chat.id, lh_users.name, lh_users.surname FROM lh_chat
          INNER JOIN lh_users
              ON lh_users.id = lh_chat.user_id
          WHERE (lh_chat.status = 2)
              AND (lh_chat.user_id = {$arr['id']})
              AND (FROM_UNIXTIME(lh_chat.time, '%Y-%m-%d') BETWEEN '{$arr['data_1']}' AND '{$arr['data_2']}')) AS B
          ON B.id = A.id_chat
      WHERE A.id_chat IS NULL";

      # verificando se a consulta pode ser executada
      if ($resultado = $db->query($query)) {

        $ids = array();

        # recuperando ids não preenchidos
        while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

          $ids[] = $registro['chat_id'];

        }

        # ecoando ids não preenchidos para o navegador
        echo json_encode($ids);

        exit;

      } else {

        $msg = 'Erro ao executar a consulta de questionários não respondidos!';

        # retornando mensagem de erro para o navegador
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);

        exit;

      }

  } else {

    $msg = 'Não foi enviado id, data_1 ou data_2!';

    # retornando mensagem de erro para o navegador
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);

    exit;

  }

}
