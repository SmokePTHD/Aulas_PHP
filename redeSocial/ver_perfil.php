
<?php
require_once 'header.php';
if (!$loggedin) die("</div></body></html>");

$utilizador = $_SESSION['utilizador'];

if (isset($_GET['ver'])) {
    $ver = $_GET['ver'];

    $stmt = $ligacao->prepare("SELECT foto, data_nascimento, cidade, descricao, interesses, visibilidade FROM membros WHERE utilizador=?");
    $stmt->bind_param("s", $ver);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if (!$user) {
        die("<p>Utilizador não encontrado.</p>");
    }

    $stmt = $ligacao->prepare("SELECT status FROM amigos WHERE utilizador=? AND amigo=?");
    $stmt->bind_param("ss", $ver, $utilizador);
    $stmt->execute();
    $amigo_result = $stmt->get_result();
    $status_amizade = $amigo_result->fetch_assoc()['status'] ?? null;
    $stmt->close();

    if ($user['visibilidade'] == 'privado' && $status_amizade != 'aceite' && $ver != $utilizador) {
        echo "<p>🚫 Este perfil é privado.</p>";
        die("</div></body></html>");
    }

    $foto = !empty($user['foto']) ? $user['foto'] : 'uploads/default.jpg';

    echo "<h2>Perfil de $ver</h2>";
    echo "<img src='$foto' alt='Foto de Perfil' width='150px'>";
    echo "<p><strong>Data de Nascimento:</strong> " . ($user['data_nascimento'] ? $user['data_nascimento'] : "Não informado") . "</p>";
    echo "<p><strong>Cidade:</strong> " . ($user['cidade'] ? $user['cidade'] : "Não informado") . "</p>";
    echo "<p><strong>Descrição:</strong> " . ($user['descricao'] ? $user['descricao'] : "Não informado") . "</p>";
    echo "<p><strong>Interesses:</strong> " . ($user['interesses'] ? $user['interesses'] : "Não informado") . "</p>";

    if ($status_amizade == 'pendente') {
        echo "<p style='color: orange;'>⏳ Pedido pendente</p>";
    } elseif ($status_amizade != 'aceite' && $ver != $utilizador) {
        echo "<a href='amigos.php?adiciona=$ver' style='color: green;'>➕ Seguir</a>";
    }

    die("</div></body></html>");
}
?>
