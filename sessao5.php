<?php
session_start();
// remove as variáveis
session_unset();
// destroi a sessão
session_destroy();
print_r($_SESSION);
?>