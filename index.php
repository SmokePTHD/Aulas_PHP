<!DOCTYPE html>
<html>
<head>
<title>PHP Aulas</title>
</head>
<body>
<h1>Aulas de PHP - M16</h1>
<?php
	echo "<strong>Olá Mundo!</strong>";
	echo "<br />";
	// comentário de uma linha 
	# outro comentário de uma linha
	/* Comentário maior, que vai ocupar várias linhas e portanto tem de abrir e fechar */
	$color = "vermelho";
	echo "O meu carro é " . $color . "<br>";
	echo "A minha casa é " . $COLOR . "<br>";
	echo "O meu barco é " . $coLOR . "<br>";
	echo "<br />";
$x = 5;
$y = 4;
	echo $x + $y . "<br />";
	echo $x / $y . "<br />";
	echo $x - $y . "<br />";
	echo $x * $y . "<br />";
	echo $x % $y . "<br />"; // módulo, resto da divisão
	
echo strlen("Conta número de caracteres") . "<br />";
echo str_word_count("Conta número de palabras") . "<br />";
echo strrev("Inverte uma string") . "<br />";
echo strpos("Procura texto", "texto") . "<br />"; /* vai procurar a palavra texto na string "Procura texto" e retorna o valor 8, posição do caracter t; note que a primeira posição é 0 e não 1. */
echo str_replace("nada", "texto", "substitui nada") . "<br />"; // substitui "nada" por "texto"
echo ucfirst("converte o primeiro caractere de uma string para maiúsculas");
echo "<br />";
echo ucwords("converte o primeiro caractere de cada palavra em uma string para maiúsculas");
echo "<br />"; 	
echo strtoupper("converte uma string para maiúsculas");
echo "<br />";
echo strtolower("CONVERTE UMA STRING para minúsculas");
echo "<br />";

$t = date("H");
if ($t < "20")
{
echo "Tenha um bom dia!";
} else {
echo "Tenha uma boa noite!";
}
echo "<br />";

$t2 = date("H");
if ($t2 < "19") {
echo "Tenha uma boa tarde!"; }
else {
	echo "Tenha uma boa noite!";
}
echo "<br />";

$favcolor = "red";
// substituir red sucessivamente por vermelho, azul e verde
echo "<br />";
switch ($favcolor) {
	case "vermelho";
		echo "A sua cor favorita é vermelho";
		break;
	case "azul";
		echo "A sua cor favorita é azul";
		break;
	case "verde";
		echo "A sua cor favorita é verde";
		break;
	default:
		echo "A sua cor favorita não é vermelho, nem azul,nem verde!";
echo "<br />";
}
echo "<br />";
$x = 1;
while($x <= 5) {
	echo "O número é: $x <br />";
	$x++;
}
echo "<br />";
$x =6;
do {
	echo "O número é: $x <br />";
	$x++;
} while ($x <= 5);
echo "<br />";
// cuidado com o do while, excuta SEMPRE pelo menos uma vez
echo "<br />";
for ($x = 0; $x <= 10; $x++){
	echo "O número é: $x <br />";
}
echo "<br />";
$cores = array ("vermelho", "verde", "azul", "amarelo");
foreach ($cores as $valor) {
	echo "$valor <br />";
}
echo "<br />";

function escreveMsg() {
	echo "Olá Mundo! <br />";
}
escreveMsg(); //chama a função
echo "<br />";

function familianome($fnome) {
	echo "$fnome Silva <br />";
}
familiaNome("Joana");
familiaNome("Helena");
familiaNome("Mário");
familiaNome("Pedro");
familiaNome("António");
echo "<br/>";

function familianomee($fnome, $ano) {
	echo "$fnome Silva, nasceu em $ano. <br />";
}
familiaNomee("Joana", "1985");
familiaNomee("Helena", "1978");
familiaNomee("Mário", "1993");
familiaNomee("Pedro", "1980");
familiaNomee("António", "1999");
echo "<br/>";

function atribuiAltura($minaltura = 170) {
	echo "A altura é: $minaltura <br />";
}
atribuiAltura(180);
atribuiAltura(); //vai usr o valor padrão 170
atribuiAltura(175);
echo " <br />";

function soma($x, $y) {
	$z = $x + $y;
	return $z;
}
echo "5 + 10 = " . soma(5, 10) . "<br />";
echo "7 + 13 = " . soma(7, 13) . "<br />";
echo "2 + 4 = " . soma (2, 4) . "<br />";
echo "<br />";

echo "Esta ", "string ", "foi ", "feita ", "com múltiplos parâmetros e echo.<br />";
echo "<br />";
$txt1 = "Estudo PHP";
$txt2 = "EPB";
$x = 5;
$y = 4;
echo "<h2>" . $txt1 . "</h2>";
echo "Estudo PHP na " . $txt2 . "<br />";
echo $x + $y . "<br />";
echo "<br />";
print "<h2>PHP é o máximo!</h2>";
print "Olá EPB!<br />";
print "Estou a aprender e a adorar!<br />";
echo "<br />";

$frutas = array("maçã", "laranja", "banana");
echo "Eu gosto de " . $frutas[0] . " e de " . $frutas[1] . ", mas não de " . $frutas[2] . ".";
echo "<br />";

echo count($frutas);
echo "<br />";
$arrlength = count($frutas);
for ($x = 0; $x < $arrlength; $x++) {
	echo $frutas[$x];
	echo "<br />";
}

$idades = array("Pedro"=>"18", "Benjamim"=>"17", "João"=>"19");
echo "O Pedro tem " . $idades['Pedro'] . " anos de idade.";
echo "<br />";

foreach($idades as $x => $x_value) {
	echo "Chave = " . $x . ", Valor = " . $x_value;
	echo "<br />";
}
echo "<br />";

// ordem ascendente numérica
$numeros = array(1, 6, 2);
sort($numeros);
$arrlength = count($numeros);
for($x = 0; $x < $arrlength; $x++) {
	echo $numeros[$x];
	echo "<br />";
}
echo "<br />";

//ordem descendente numérica
$numeros = array (1, 6, 2);
rsort($numeros);
$arrlength = count($numeros);
for ($x = 0; $x < $arrlength; $x++) {
	echo $numeros[$x];
	echo "<br />";
}
echo "<br />";

//ordem descendente alfabética
$nomes = array ("Joana", "Ana", "Teresa");
sort($nomes);
$arrlength = count($nomes);
for ($x = 0; $x < $arrlength; $x++) {
	echo $nomes[$x];
	echo "<br />";
}
echo "<br />";

//ordem ascendente alfabética
$nomes = array ("Joana", "Ana", "Teresa");
rsort($nomes);
$arrlength = count($nomes);
for ($x = 0; $x < $arrlength; $x++) {
	echo $nomes[$x];
	echo "<br />";
}
echo "<br />";

// ordem asscendente de acordo com o Valor
$idades = array("Pedro"=>"18", "Benjamim"=>"17", "João"=>"19");
asort($idades);
foreach($idades as $x => $x_value) {
	echo "Chave = " . $x . ", Valor = " . $x_value;
	echo "<br />";
}
echo "<br />";

// ordem ascendente de acordo com o chave
$idades = array("Pedro"=>"18", "Benjamim"=>"17", "João"=>"19");
ksort($idades);
foreach($idades as $x => $x_value) {
	echo "Chave = " . $x . ", Valor = " . $x_value;
	echo "<br />";
}
echo "<br />";

// ordem descendente de acordo com o Valor
$idades = array("Pedro"=>"18", "Benjamim"=>"17", "João"=>"19");
arsort($idades);
foreach($idades as $x => $x_value) {
	echo "Chave = " . $x . ", Valor = " . $x_value;
	echo "<br />";
}
echo "<br />";

// ordem desscendente de acordo com a chave
$idades = array("Pedro"=>"18", "Benjamim"=>"17", "João"=>"19");
krsort($idades);
foreach($idades as $x => $x_value) {
	echo "Chave = " . $x . ", Valor = " . $x_value;
	echo "<br />";
}
echo "<br />";

// $GLOBALS acessível de qualquer ponto
$x = 75;
$y = 25;
function adicao() {
$GLOBALS['z'] = $GLOBALS['x'] + $GLOBALS['y'];
}
adicao();
echo $z;
echo "<br />";

$x = 75;
$y = 25;
function adicao1() {
	$z = $x + $y;
}
adicao1();
echo $z;
echo "<br />";

echo $_SERVER['PHP_SELF'];
echo "PHP_SELF<br />";
echo $_SERVER['SERVER_NAME'];
echo "SERVER_NAME<br />";
echo $_SERVER['HTTP_HOST'];
echo "HTPP_HOST<br />";
echo $_SERVER['HTTP_REFERER'];
echo "HTTP_REFERER<br />";
echo $_SERVER['HTTP_USER_AGENT'];
echo "HTTP_USER_AGENT<br />";
echo $_SERVER['SCRIPT_NAME'];
echo "SCRIPT_NAME<br />";
echo "<br />";


?>
</body>
</html>