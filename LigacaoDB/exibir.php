<html>
<head>
    <title>Editar Registos</title>
    <style type="text/css">
        table {
            border: 1px solid gray;
            padding: 2px;
        }
        td {
            border: 1px solid lightgray;
            font-size: 1em;
            padding: 2px;
        }
        .cat {
            font-family: Trebuchet MS;
            color: #0000FF;
        }
    </style>
</head>
<body>
    <p><a href="index.php">Home</a></p>
    <?php
        if (isset($_GET['alter'])) {
            if ($_GET['alter'] == "true") {
                echo "<p>Os dados foram alterados.</p>";
            } else {
                echo "<p>Erro ao alterar os dados.</p>";
            }
        }
    ?>
    <table>
        <tr class="cat">
            <td>Código Cliente</td>
            <td>Nome</td>
            <td>Data Nascimento</td>
            <td>Sexo</td>
            <td>Endereço</td>
            <td>Email</td>
            <td>Telefone</td>
            <td>SNS</td>
            <td>NIF</td>
            <td>Ação</td>
        </tr>
        <?php
            // Estabelecer ligação com a base de dados
            require_once 'login.php';
            $ligacao = new mysqli($hn, $un, $pw, $db);
            mysqli_set_charset($ligacao, "utf8");

            if ($ligacao->connect_error) {
                echo "Erro na ligação à base de dados.";
                exit;
            }

            // Query para obter os dados
            $sql = "SELECT * FROM Pacients ORDER BY id";
            $consulta = $ligacao->query($sql);

            if (!$consulta) {
                echo "Erro ao realizar a consulta.";
                exit;
            }

            // Mostrar os dados na tabela
            while ($dados = $consulta->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($dados['id']) . "</td>";
                echo "<td>" . htmlspecialchars($dados['name']) . "</td>";
                echo "<td>" . htmlspecialchars($dados['dateBirth']) . "</td>";
                echo "<td>" . htmlspecialchars($dados['sex']) . "</td>";
                echo "<td>" . htmlspecialchars($dados['address']) . "</td>";
                echo "<td>" . htmlspecialchars($dados['email']) . "</td>";
                echo "<td>" . htmlspecialchars($dados['phone']) . "</td>";
                echo "<td>" . htmlspecialchars($dados['sns']) . "</td>";
                echo "<td>" . htmlspecialchars($dados['nif']) . "</td>";
                echo "<td>";
                echo "<form action='editar.php' method='post'>";
                echo "<input type='hidden' name='id' value='" . htmlspecialchars($dados['id']) . "'>";
                echo "<input type='hidden' name='name' value='" . htmlspecialchars($dados['name']) . "'>";
                echo "<input type='hidden' name='dateBirth' value='" . htmlspecialchars($dados['dateBirth']) . "'>";
                echo "<input type='hidden' name='sex' value='" . htmlspecialchars($dados['sex']) . "'>";
                echo "<input type='hidden' name='address' value='" . htmlspecialchars($dados['address']) . "'>";
                echo "<input type='hidden' name='email' value='" . htmlspecialchars($dados['email']) . "'>";
                echo "<input type='hidden' name='phone' value='" . htmlspecialchars($dados['phone']) . "'>";
                echo "<input type='hidden' name='sns' value='" . htmlspecialchars($dados['sns']) . "'>";
                echo "<input type='hidden' name='nif' value='" . htmlspecialchars($dados['nif']) . "'>";
                echo "<button>Editar</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }

            $consulta->close();
            $ligacao->close();
        ?>
    </table>
</body>
</html>
