<?php //index.php
	require_once 'login.php';
	$ligacao = new mysqli($hn, $un, $pw, $db);
	if($ligacao->connect_error) die("Erro fatal");
?>
<p>Esta é a página de entrada, index, que faz require ao ficheiro de login para efectuar a ligação à base de dados.</p>
<a href="exibir.php">Editar registos</a> <a href="ins_elim.php">Inserir e eliminar registos</a>
<h3>Os ficheiros deste site de demonstração da ligação php / mysql devem ser criados pela seguinte ordem: index, login, criar_tabela, ins_elim, exibir, editar e salvar, todos com extensão php.<br />Em caso de erro verifique se a sua base de dados, tabela e respetivas colunas foram criadas extatamente com os nomes que estão neste exemplo.</h3>