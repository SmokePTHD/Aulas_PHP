<?php
session_start();
include './header.php';
include './database.php';

if (!$loggedin) die("Acesso negado.");

$utilizador = $_SESSION['utilizador'];

if (isset($_GET['aceitar'])) {
    $amigo = $_GET['aceitar'];
    $stmt = $ligacao->prepare("UPDATE amigos SET status='aceite' WHERE utilizador=? AND amigo=?");
    $stmt->bind_param("ss", $amigo, $utilizador);
    $stmt->execute();
    $stmt->close();
}

if (isset($_GET['rejeitar'])) {
    $amigo = $_GET['rejeitar'];
    $stmt = $ligacao->prepare("DELETE FROM amigos WHERE utilizador=? AND amigo=?");
    $stmt->bind_param("ss", $amigo, $utilizador);
    $stmt->execute();
    $stmt->close();
}

$result = $ligacao->query("SELECT utilizador FROM amigos WHERE amigo='$utilizador' AND status='pendente'");
echo "<h3>Pedidos de Amizade</h3>";
while ($row = $result->fetch_assoc()) {
    echo "{$row['utilizador']} quer seguir-te. 
    <a href='amigos.php?aceitar={$row['utilizador']}'>Aceitar</a> | 
    <a href='amigos.php?rejeitar={$row['utilizador']}'>Rejeitar</a><br>";
}
?>
