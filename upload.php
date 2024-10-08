<?php
$target_dir = "uploads/";
$target_file = $target_dir.basename($_FILES["imgupload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// verifica se o ficheiro é imagem
if (isset($_POST["submit"])){
	$check = getimagesize($_FILES["imgupload"]["tmp_name"]);
	if ($check !== false) {
		echo "O ficheiro é uma imagem = " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		echo "O ficheiro não é uma imagem!";
		$uploadOk = 0;
	}
}
// Verifica se o ficheiro já existe
if (file_exists($target_file)){
	echo "O ficheiro já existe. ";
	$uploadOk = 0;
}
// Verifica o tamanho do ficheiro
if ($_FILES["imgupload"]["size"] > 500000){
	echo "O ficheiro é muito pesado. ";
	$uploadOk = 0;
}
// Permite determinados tipos de imagem - jpg, jpeg, png, gif
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
	echo "Apenas pode carregar imagens jpg, jpeg, png e gif. ";
	$uploadOk = 0;
}
// Verifica se $uploadOk está a 0 por erro
if ($uploadOk == 0){
	echo "O ficheiro não foi carregado";
	//Se tudo está ok carrega o ficheiro
} else {
	if (move_uploaded_file($_FILES["imgupload"]["tmp_name"], $target_file)){
		echo "O ficheiro ". basename($_FILES["imgupload"]["name"]) . "foi carregado.";
	}else {
		echo "Aconteceu um erro ao carregar o ficheiro";
	}
}
?>
