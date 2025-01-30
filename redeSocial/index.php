<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <title>Início</title>
</head>
<body>
    <?php
        session_start();
        require_once 'header.php';

        echo "<div class='center'>Bem-vindo a gpsi22,";
        if ($loggedin) echo " $utilizador, você está ligado.";
        else echo ' por favor, faça entre ou registre-se.';
        echo <<<_END
                </div><br>
            </div>
            <div data-role="footer">
                <h4><i><a href='https://epb.pt/' target="_blank">Rede social da turma gpsi22</a></i></h4>
            </div>
        _END;
    ?>
</body>
</html>