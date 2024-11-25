<p><a href="index.php">Home</a></p>
<?php
	require_once 'login.php';
	$ligacao = new mysqli($hn, $un, $pw, $db);
	mysqli_set_charset($ligacao, "utf8");
	if($ligacao->connect_error) die("Erro fatal");
	// eliminar registos
	// isset é uma função nativa que serve para saber se uma variável está definida
	if(isset($_POST['delete']) && isset($_POST['isbn']))
	{
		$isbn = get_post($ligacao, 'isbn');
		// Exercício: crie um método de confirmação da intenção de apagar um registo
		$query = "DELETE FROM classicos_lit WHERE isbn='$isbn'";
		$result = $ligacao->query($query);
		if(!result) echo "Falha ao eliminar registo<br><br>";
	}
	if (isset($_POST['autor']) &&
	isset($_POST['titulo']) &&
	isset($_POST['categoria']) &&
	isset($_POST['ano']) &&
	isset($_POST['isbn']))
	{
		$autor = get_post($ligacao, 'autor');
		$titulo = get_post($ligacao, 'titulo');
		$categoria = get_post($ligacao, 'categoria');
		$ano = get_post($ligacao, 'ano');
		$isbn = get_post($ligacao, 'isbn');
		// Inserir registo
		$query = "INSERT INTO classiscos_lit VALUES"."('$autor', '$titulo','$categoria','$ano','$isbn')";
		$result = $ligacao->query($query);
		if(!$result) echo "Falha ao inserir registo<br><br>";
	}
	// _END efecuta output de tudo até encontrar novo _END
	echo <<<_END
	<form action="ins_elim.php" method="post"><pre>
	<!-- utilizamos a tag pre para o texto ficar alinhado --!>
	Autor <input type="text" name="autor">
	Titulo <input type="text" name="titulo">
	Categoria <input type="text" name="categoria">
	Ano <input type="text" name="ano">
	ISBN <input type="text" name="isbn">
	
		<input type="submit" value="Adicionar registo">
	</pre></form>
	_END;
	$query = "SELECT * FROM classicos_lit ORDER BY titulo";
	$result = $ligacao->query($query);
	if(!$result) die("Falha no acesso à base de dados");
	$rows = $result->num_rows;
	for ($j = 0; $j < $rows; ++$j) {
		$row = $result->fetch_array(MYSQLI_NUM); // Array numérico
		$r0 = htmlspecialchars($row[0]);
		$r1 = htmlspecialchars($row[1]);
		$r2 = htmlspecialchars($row[2]);
		$r3 = htmlspecialchars($row[3]);
		$r4 = htmlspecialchars($row[4]);
		
		echo <<<_END
		<pre>
		Autor $r0
		Titulo $r1
		Categoria $r2
		Ano $r3
		ISBN $r4
		</pre>
		<form action='ins_elim.php' method='post'>
		<input type='hidden' name='delete' value='yes'>
		<input type='hidden' name='isbn' value='$r4'>
		<input type='submit' value='Apagar registo'>
		</form>
		_END;
	}
	
	$result->close();
	$ligacao->close();
	function get_post($ligacao, $var) {
		return $ligacao->real_escape_string($_POST[$var]);
	}	
	//A função mysqli_real_escape_string() é usada antes de inserir uma string em um banco de dados, pois remove quaisquer caracteres especiais que possam interferir nas operações de consulta.
?>