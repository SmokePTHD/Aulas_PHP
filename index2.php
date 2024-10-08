<!DOCTYPE html>
<html>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
	Nome: <input type="text" name="fnome">
	<input type="submit">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// recolhe o valor do campo input
	$nome = $_REQUEST['fnome'];
	if (empty($nome)) {
		echo "Nome não preenchido";
	} else {
		echo "<p>Bom dia " . $nome . "!</p>";
	}
}
