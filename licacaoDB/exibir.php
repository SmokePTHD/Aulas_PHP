<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

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
        if ( isset($_GET['alter']) ) {
            if ( $_GET['alter'] == "true" ) {
                echo "<p>Os dados foram alterados.</p>";
            } else {
                echo "<p>Erro ao alterar os dados.</p>";
            }
        }
    ?>
    <table>
        <tr class="cat">
            <td>ISBN</td>
            <td>Autor</td>
            <td>Títulos</td>
            <td>Categoria</td>
            <td>Ano</td>
        </tr>
        <?php
            // Establece a ligação com o mysql ALTERNATIVA AO LOGIN

        ?>
    </table>
</body>
</html>