<!DOCTYPE>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
<?php
// Define variáveis com valores vazios
$nomeErr = $emailErr = $generoErr = "";
$nome = $email = $genero = $coment = $website = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["nome"])) {
		$nomeErr = "Preenche o nome.";
	} else {
		$nome = teste_input($_POST["nome"]);
		// verifica se o nome só contem letras e espaços em branco
		if (!preg_match("/^[a-zA-Z ]*$/",$nome)) {
			$nomeErr = "Só são permitidas letras e espaços em branco";
		}
	}
	if (empty($_POST["email"])) {
		$emailErr = "Preenche o e-mail.";
	} else {
		$email = teste_input($_POST["email"]);
		// verifica se o email está bem formado
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Formato de email inválido";
		}
	}
	if (empty($_POST["website"])) {
		$websiteErr = "";
	} else {
		$website = teste_input($_POST["website"]);
		// verifica se a URL é válida
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
			$websiteErr = "URL inválida";
		}
	if (empty($_POST["coment"])) {
		$comentErr = ".";
	} else {
		$coment = teste_input($_POST["coment"]);
		
	}
	if (empty($_POST["genero"])) {
		$generoErr = "Escolha o género.";
	} else {
		$genero = teste_input($_POST["genero"]);
	}
}
function teste_input($dados) {
	$dados = trim($dados);
	$dados = stripslashes($dados);
	$dados = htmlspecialchars($dados);
	return $dados;
}
?>
<h2>Validação de formulário</h2>
<p><span class="error">* campo obrigatório</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Nome: <input type="text" name="nome">
<span class="error">* <?php echo $nomeErr;?></span>
<br /><br />
Email: <input type="text" name="email">
<span class="error">* <?php echo $emailErr;?></span>
<br /><br />
Website: <input type="text" name="website">
<br /><br />
Comentários: <textarea name="coment" rows="5" cols="40"></textarea>
<br /><br />
Género:
<input type="radio" name="genero" value="Feminino"> Feminino
<input type="radio" name="genero" value="Masculino"> Masculino
<input type="radio" name="genero" value="Outro"> Outro
<span class="error">* <?php echo $generoErr;?></span>
<br /><br />
<input type="submit" name="submit" value="Confirmar dados"> <!--Alterado-->
</form>
<form action="teste1.php" method="post">
<input type="hidden" name="nome" value="<?php echo $nome; ?>">
<input type="hidden" name="email" value="<?php echo $email;?>">
<input type="hidden" name="website" value="<?php echo $website;?>">
<input type="hidden" name="coment" value="<?php echo $coment;?>">
<input type="hidden" name="genero" value="<?php echo $genero;?>">
<?php
echo "<h2>Os seus dados: </h2>";
echo $nome;
echo "<br />";
echo $email;
echo "<br />";
echo $website;
echo "<br />";
echo $coment;
echo "<br />";
echo $genero;
echo "<br />";
?>
<input type="submit" name="submit" value="enviar">
</form>
</body>
</html>