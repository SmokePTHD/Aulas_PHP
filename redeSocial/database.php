<?php
$dbhost  = 'localhost';    
$dbname  = 'GPSI22';   
$dbuser  = 'goncalo123';   
$dbpass  = 'password1234';   

$ligacao = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($ligacao->connect_error) die("Erro fatal na ligação!");

return $ligacao;
?>