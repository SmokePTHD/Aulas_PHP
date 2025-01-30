<p><a href="index.php"> Home </a></p>
<?php
    require_once 'login.php';
    $ligacao = new mysqli($hn, $un, $pw, $db);
    mysqli_set_charset($ligacao, "utf8");

    if ($ligacao->connect_error) die("Erro Fatal!");

    // Eliminar registos
    if (isset($_POST['delete']) && isset($_POST['id'])) {
        $id = get_post($ligacao, 'id');
        $query = "DELETE FROM Pacients WHERE id = '$id'";
        $result = $ligacao->query($query);
        if (!$result) {
            echo "Falha ao eliminar registo: " . $ligacao->error . "<br><br>";
        }
    }

    // Inserir registos
    if (
        isset($_POST['name']) &&
        isset($_POST['dateBirth']) &&
        isset($_POST['sex']) &&
        isset($_POST['address']) &&
        isset($_POST['email']) &&
        isset($_POST['phone']) &&
        isset($_POST['sns']) &&
        isset($_POST['nif'])
    ) {
        $name = get_post($ligacao, 'name');
        $dateBirth = get_post($ligacao, 'dateBirth');
        $sex = get_post($ligacao, 'sex');
        $address = get_post($ligacao, 'address');
        $email = get_post($ligacao, 'email');
        $phone = get_post($ligacao, 'phone');
        $sns = get_post($ligacao, 'sns');
        $nif = get_post($ligacao, 'nif');

        $query = "INSERT INTO Pacients (name, dateBirth, sex, address, email, password, phone, sns, nif) 
                  VALUES ('$name', '$dateBirth', '$sex', '$address', '$email', NULL, '$phone', '$sns', '$nif')";
        $result = $ligacao->query($query);
        if (!$result) {
            echo "Falha ao inserir registo: " . $ligacao->error . "<br><br>";
        } else {
            echo "Registo inserido com sucesso!<br><br>";
        }
    }

    // Formulário de inserção
    echo <<<_END
    <form action="ins_elim.php" method="post">
    <pre>
    Nome            <input type="text" name="name" required>
    Data Nascimento <input type="date" name="dateBirth" required>
    Sexo            <input type="text" name="sex" required>
    Endereço        <input type="text" name="address">
    Email           <input type="email" name="email">
    Telefone        <input type="text" name="phone">
    SNS             <input type="text" name="sns">
    NIF             <input type="text" name="nif">
    <input type="submit" value="Adicionar Registo">
    </pre>
    </form>
    _END;

    // Exibição dos registos
    $query = "SELECT * FROM Pacients ORDER BY id";
    $result = $ligacao->query($query);
    if (!$result) die("Falha no acesso à base de dados");

    $rows = $result->num_rows;
    for ($j = 0; $j < $rows; ++$j) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $id = htmlspecialchars($row['id']);
        $name = htmlspecialchars($row['name']);
        $dateBirth = htmlspecialchars($row['dateBirth']);
        $sex = htmlspecialchars($row['sex']);
        $address = htmlspecialchars($row['address']);
        $email = htmlspecialchars($row['email']);
        $phone = htmlspecialchars($row['phone']);
        $sns = htmlspecialchars($row['sns']);
        $nif = htmlspecialchars($row['nif']);

        echo <<<_END
        <form action="ins_elim.php" method="post">
        <pre>
        ID: $id
        Nome: $name
        Data Nascimento: $dateBirth
        Sexo: $sex
        Endereço: $address
        Email: $email
        Telefone: $phone
        SNS: $sns
        NIF: $nif
        <input type="hidden" name="id" value="$id">
        <input type="submit" name="delete" value="Apagar Registo" onclick="return confirmarEliminacao();">
        </pre>
        </form>
        _END;
    }

    $result->close();
    $ligacao->close();

    function get_post($ligacao, $var) {
        return $ligacao->real_escape_string($_POST[$var]);
    }
?>
<script>
function confirmarEliminacao() {
    return confirm('Tem certeza que deseja apagar este registo?');
}
</script>