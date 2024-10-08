<?php 
    $ficheiro = fopen("webdicionario.txt", "r") or die("O ficheiro não foi encontrado!");
    while (!feof($ficheiro)) {
        echo fgets($ficheiro) . "<br />";
    }
    fclose($ficheiro);
?>