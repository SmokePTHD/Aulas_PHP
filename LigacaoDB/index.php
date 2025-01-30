<?php
	require_once 'login.php';
	$ligacao = new mysqli($hn, $un, $pw, $db);
	if ($ligacao -> connect_error) die("Erro fatal !");
?>
<p> Esta é a página de entrada, index, que faz require ao ficheiro de login para efetuar a ligação à base de dados. </p>
<a href="exibir.php"> Editar registos </a>
<br />
<a href="ins_elim.php"> Inserir e eliminar registos </a>