<?php 

# definindo constante com o endereço do host da base de dados
if (! defined('DB_HOST'))
  define('DB_HOST', '6.6.6.2');

# definindo constante com o nome do usuário do base de dados
if (! defined('DB_USER'))
  define('DB_USER', 'root');

# definindo constante com a senha do usuário da base de dados
if (! defined('DB_PASSWORD'))
  define('DB_PASSWORD', 'super');

# definindo constante o nome da base de dados
if (! defined('DB_NAME'))
  define('DB_NAME', 'chat_avanco');

# abrindo conexão com a base de dados
$conexao = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$conexao->set_charset('utf8');

# verificando se a conexão com a base de dados foi realizada com sucesso
if ($conexao) {

  $query =
  "SELECT
    ticket
  FROM av_tickets
  WHERE (validade = true)
    AND (DATE_FORMAT(agendado, '%Y-%m-%d') < CURRENT_DATE());"; 
  
  # verificando se a consulta pode ser executada
  if ($resultado = $conexao->query($query)) {

    $tickets = array();

    # recuperando tickets que já passaram do prazo de agendamento
    while ($registro = $resultado->fetch_assoc()) {

      $tickets[] = $registro['ticket'];

    }

  }

  # invalidando tickets 
  foreach ($tickets as $ticket) {
    
    $query = '';
    $query = "UPDATE av_tickets SET validade = false WHERE (ticket = $ticket);";

    $conexao->query($query);

  }

  $conexao->close();

}