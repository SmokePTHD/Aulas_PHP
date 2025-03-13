<?php
require_once 'header.php';

if ($_SERVER['REQUEST_URI'] === '/favicon.ico') {
    http_response_code(404);
    exit();
}

if (!$loggedin) die("</div></body></html>");

$utilizador = $_SESSION['utilizador'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['seguir'])) {
    ob_clean(); // Limpa qualquer saída anterior
    header('Content-Type: application/json');

    $amigo = $_POST['seguir'];

    // Verifica o status atual da amizade
    $stmt = $ligacao->prepare("SELECT status FROM amigos WHERE utilizador=? AND amigo=?");
    $stmt->bind_param("ss", $amigo, $utilizador);
    $stmt->execute();
    $result = $stmt->get_result();
    $status = $result->fetch_assoc()['status'] ?? null;
    $stmt->close();

    if (!$status) {
        // Obtém a visibilidade do amigo
        $stmt = $ligacao->prepare("SELECT visibilidade FROM membros WHERE utilizador=?");
        $stmt->bind_param("s", $amigo);
        $stmt->execute();
        $result = $stmt->get_result();
        $visibilidade = $result->fetch_assoc()['visibilidade'] ?? 'publico';
        $stmt->close();

        // Define o status da amizade
        $novo_status = ($visibilidade == 'publico') ? 'aceite' : 'pendente';
        $stmt = $ligacao->prepare("INSERT INTO amigos (utilizador, amigo, status) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $amigo, $utilizador, $novo_status);
        $stmt->execute();
        $stmt->close();
    } elseif ($status == 'pendente' || $status == 'aceite') {
        $stmt = $ligacao->prepare("DELETE FROM amigos WHERE utilizador=? AND amigo=?");
        $stmt->bind_param("ss", $amigo, $utilizador);
        $stmt->execute();
        $stmt->close();
        $novo_status = 'removido';
    }

    echo json_encode(["status" => $novo_status ?? 'erro', "user" => $amigo]);
    exit();
}

// Busca a lista de membros
$result = $ligacao->query("SELECT utilizador, foto, visibilidade FROM membros ORDER BY utilizador");

echo "<h3>Membros</h3>";
echo "<div id='membros-container' style='display: flex; flex-wrap: wrap; gap: 20px;'>";

while ($row = $result->fetch_assoc()) {
    if ($row['utilizador'] == $utilizador) continue;

    $foto = !empty($row['foto']) ? $row['foto'] : 'uploads/default.jpg';
    $nome = htmlspecialchars($row['utilizador']);
    $visibilidade = $row['visibilidade'];

    // Verifica se já são amigos
    $stmt = $ligacao->prepare("SELECT status FROM amigos WHERE utilizador=? AND amigo=?");
    $stmt->bind_param("ss", $nome, $utilizador);
    $stmt->execute();
    $amigo_result = $stmt->get_result();
    $status_amizade = $amigo_result->fetch_assoc()['status'] ?? null;
    $stmt->close();

    // Define os botões
    $btn_text = "Seguir";
    $btn_color = "#007bff";

    if ($status_amizade == 'aceite') {
        $btn_text = "Deixar de seguir";
        $btn_color = "#dc3545";
    } elseif ($status_amizade == 'pendente') {
        $btn_text = "Cancelar pedido";
        $btn_color = "#ffc107";
    }
    
    echo "<div class='membro' data-user='$nome' style='width: 200px; border: 1px solid #ddd; padding: 10px; text-align: center; border-radius: 10px;'>";
    echo "<img src='$foto' alt='$nome' style='width: 100px; height: 100px; border-radius: 50%; object-fit: cover;'><br>";
    echo "<strong>$nome</strong><br>";
    echo "<button class='seguir-btn' data-user='$nome' style='margin-top: 5px; padding: 5px 10px; border: none; cursor: pointer; background-color: $btn_color; color: white;'>$btn_text</button>";
    echo "</div>";
}

echo "</div>";
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $('.seguir-btn').click(function() {
        var button = $(this);
        var user = button.data('user');
        button.prop('disabled', true);

        $.post("membros.php", { seguir: user }, function(data) {
            console.log("Resposta recebida:", data);

            button.prop('disabled', false);

            if (data.status === 'aceite') {
                button.text('Deixar de seguir').css({'background-color': '#dc3545', 'color': 'white'});
            } else if (data.status === 'pendente') {
                button.text('Cancelar pedido').css({'background-color': '#ffc107', 'color': 'black'});
            } else if (data.status === 'removido') {
                button.text('Seguir').css({'background-color': '#007bff', 'color': 'white'});
            } else {
                console.error("Status inesperado:", data.status);
            }
        }, "json")
        .fail(function(xhr, status, error) {
            console.error("Erro na solicitação: " + error);
            button.prop('disabled', false);
        });
    });
});

</script>
