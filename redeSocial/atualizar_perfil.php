<?php
session_start();
include './database.php';

// Verifica se o utilizador está autenticado
if (!isset($_SESSION['utilizador'])) {
    die("<p style='color:red;'>Erro: Acesso negado.</p>");
}

$utilizador = $_SESSION['utilizador'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nova_visibilidade = $_POST['visibilidade'];
    $nova_data_nascimento = !empty($_POST['data_nascimento']) ? $_POST['data_nascimento'] : NULL;
    $nova_cidade = !empty($_POST['cidade']) ? trim($_POST['cidade']) : NULL;
    $nova_descricao = !empty($_POST['descricao']) ? trim($_POST['descricao']) : NULL;
    $novos_interesses = !empty($_POST['interesses']) ? trim($_POST['interesses']) : NULL;

    $stmt = $ligacao->prepare("UPDATE membros SET visibilidade=?, data_nascimento=?, cidade=?, descricao=?, interesses=? WHERE utilizador=?");
    $stmt->bind_param("ssssss", $nova_visibilidade, $nova_data_nascimento, $nova_cidade, $nova_descricao, $novos_interesses, $utilizador);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Perfil atualizado com sucesso!</p>";
    } else {
        echo "<p style='color:red;'>Erro ao atualizar perfil: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>
