<?php
// coloca a data de expiração para uma hora atrás 60*60 = 3600
setcookie("user", "", time() - 3600, '/');
echo "Cookie 'user' foi apagado.";
?>