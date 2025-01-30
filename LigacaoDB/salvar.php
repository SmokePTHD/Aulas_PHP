<?php
// salvar.php

$id = filter_input(INPUT_POST, 'id');
$new_name = filter_input(INPUT_POST, 'name');
$new_dateBirth = filter_input(INPUT_POST, 'dateBirth');
$new_sex = filter_input(INPUT_POST, 'sex');
$new_address = filter_input(INPUT_POST, 'address');
$new_email = filter_input(INPUT_POST, 'email');
$new_phone = filter_input(INPUT_POST, 'phone');
$new_sns = filter_input(INPUT_POST, 'sns');
$new_nif = filter_input(INPUT_POST, 'nif');

require_once 'login.php';
$ligacao = new mysqli($hn, $un, $pw, $db);
mysqli_set_charset($ligacao, "utf8");

if (!$ligacao) {
    header("Location: exibir.php?alteracao=false");
    exit;
}

$sql = "UPDATE Pacients SET
    name = '$new_name',
    dateBirth = '$new_dateBirth',
    sex = '$new_sex',
    address = '$new_address',
    email = '$new_email',
    phone = '$new_phone',
    sns = '$new_sns',
    nif = '$new_nif'
    WHERE id = $id;";

$update = mysqli_query($ligacao, $sql);

if (!$update) {
    header("Location: exibir.php?alter=false");
    exit;
}

header("Location: exibir.php?alter=true");
?>
