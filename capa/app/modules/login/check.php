<?php

if (! verificaUsuarioLogado()) {

  header('Location: ' . BASE_URL . 'public/login/form-login.php');

}
