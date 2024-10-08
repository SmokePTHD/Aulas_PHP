<?php
$ficheiro = fopen ("webdicionario.txt", "r") or die ("O ficheiro não foi aberto!");
echo fgets($ficheiro);
fclose($ficheiro);
?>