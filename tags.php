<?php
    $str = "<h1>Olá Braga</h1>";
    $str1 = "<h1>Olá Braga</h1>";
    $novastr = filter_var($str, FILTER_SANITIZE_STRING);
    // Limpa o html h1
    echo $novastr;
    echo $str1;
?>