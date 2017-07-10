<?php

if (! verificaUsuarioLogado()) {

  header('Location: ' . BASE_URL . 'public/views/login/form-login.php');

}
