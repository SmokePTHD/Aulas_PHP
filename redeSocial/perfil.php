<?php
session_start();
include './header.php';
include './database.php';

if (!$loggedin) die("Acesso negado.");

$utilizador = $_SESSION['utilizador'];

// Obter dados do utilizador
$stmt = $ligacao->prepare("SELECT foto, visibilidade, data_nascimento, cidade, descricao, interesses FROM membros WHERE utilizador=?");
$stmt->bind_param("s", $utilizador);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

$foto = !empty($user['foto']) ? $user['foto'] : 'uploads/default.jpg';
$visibilidade = $user['visibilidade'];
$data_nascimento = $user['data_nascimento'];
$cidade = $user['cidade'];
$descricao = $user['descricao'];
$interesses = $user['interesses'];

echo "<h2>Perfil de $utilizador</h2>";
echo "<img src='$foto' alt='Foto de Perfil' width='150px'>";
?>

<form id="perfil-form">
    <label>Visibilidade do Perfil:</label>
    <select name="visibilidade" id="visibilidade">
        <option value="publico" <?= ($visibilidade == 'publico') ? 'selected' : '' ?>>Público</option>
        <option value="privado" <?= ($visibilidade == 'privado') ? 'selected' : '' ?>>Privado</option>
    </select>

    <label>Data de Nascimento:</label>
    <input type="date" name="data_nascimento" value="<?= $data_nascimento ?>">

    <label>Cidade:</label>
    <input type="text" name="cidade" value="<?= $cidade ?>">

    <label>Descrição:</label>
    <textarea name="descricao"><?= $descricao ?></textarea>

    <label>Interesses:</label>
    <textarea name="interesses"><?= $interesses ?></textarea>

    <button type="submit">Atualizar Perfil</button>
</form>

<div id="resposta"></div>

<script>
$(document).ready(function() {
    $("#perfil-form").submit(function(event) {
        event.preventDefault();
        
        $.ajax({
            url: "atualizar_perfil.php",
            type: "POST",
            data: $("#perfil-form").serialize(),
            success: function(response) {
                $("#resposta").html(response);
            },
            error: function() {
                $("#resposta").html("<p style='color:red;'>Erro ao atualizar perfil.</p>");
            }
        });
    });
});
</script>
