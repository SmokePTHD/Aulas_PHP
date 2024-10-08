<?php
    $ficheiro = fopen("ficheiro1.txt", "w") or die("O ficheiro não foi aberto!");
    $txt = "José Silva \r\n";
    fwrite($ficheiro, $txt);
    $txt = "Maria Carvalho \r\n";
    fwrite($ficheiro, $txt);
    fclose($ficheiro);
?>