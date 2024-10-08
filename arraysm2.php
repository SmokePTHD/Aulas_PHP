<?php
$alunos = array
(
array("Teresa",19,"Feminino"),
array("Mário",17,"Masculino"),
array("Frederico",17,"Masculino"),
);
for ($row = 0; $row < 3; $row++) {
	echo "<p><b>Número da linha - $row</b></p>";
	echo "<u1>";
	for ($col = 0; $col < 3; $col++) {
		echo "<li>".$alunos[$row][$col]."</li>";
	}
	echo "</ul>";
}
?>