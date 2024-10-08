<!DOCTYPE HTML>
<html>
<body>
<?php
$cookie_nome = "user";
$cookie_valor = "Maria Fernandes";
setcookie($cookie_nome, $cookie_valor, time() + (86400 * 30), "/"); // 86400 = 1 dia
?>
<?php
if(!isset($_COOKIE[$cookie_nome])) {
	echo "cookie '" . $cookie_nome . "' não atribuido!";
} else {
	echo "cookie '" . $cookie_nome . "' está atribuido!<br />";
	echo "O valor é: " . $_COOKIE[$cookie_nome];
}
?>
</body>
</html>