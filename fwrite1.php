<?php
    $ficheiro = fopen("ficheiro1.txt", "w") or die("O ficheiro não foi aberto!");
    $txt = "Fátima Rocha \r\n";
    fwrite($ficheiro, $txt);
    $txt = "Joaquim Ribeiro \r\n";
    fwrite($ficheiro, $txt);
    fclose($ficheiro);
?>