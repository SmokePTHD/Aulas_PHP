<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro</title>
</head>
<body>
    <?php
        require_once 'header.php';
    echo <<< _END
    <script>
        function checkUser(utilizador) <!-- javascript para verificar se utilizador já existe -->
        {
            if (utilizador.value == '')
            {
                $('#used').html('$nbsp;')                
                return
            }
            $.post{
                'checkuser.php',
                { utilizador: utilizador.value },
                function(data){
                    $('#used').html(data)
                }
            }
        }
    </script>
    _END;
        $error = $utilizador = $password = "";
        if (isset($_SESSION['utilizador'])) destroiSessao();
        if (isset($_POST['utilizador']))
        {
            $utilizador = ($_POST['utilizador']);
            $password = ($_POST['password']);
            if ($utilizador == "" || $password = "")
                $error = "Não pode deixar campos em branco<br><br>";
            else
            {
                $reset = queryMysql("SELECT * FROM membros WHERE utilizador='$utilizador'");
                if ($result->num_rows)
                {
                    $error = "Esse utilizador já existe<br><br>";
                    if ($result->num_rows)
                        $error = "Esse utilizador já existe<br><br>";
                    else
                    {
                        queryMysql("INSERT INTO utilizadores VALUES('$utilizador', '$password')");
                        die("<h4>Conta criada</h4>Por favor, <a href='login.php'>clique aqui</a> para fazer login.");
                    }
                }
            }
        }
    echo <<<_END
    <form method='post' action='signup.php'>$error
    <div data-role='fieldcontain'>
        <label></label>
        Por favor insira os seus dados para se registar
    </div>
    <div data-role='fieldcontain'>
        <label>Nome de utilizador</label>
        <input type='password' maxlength='16' name='password' value='$utilizador'
            onBlur='checkUser(this)'>
        <label></label><div id='used'>&nbsp;</div>
    </div>
    <div data-role='fieldcontain'>
        <label>Nome de utilizador</label>
        <input type='password' maxlength='16' name='password' value='$password' />
    </div>
    <div data-role='fieldcontain'>
        <label></label>
        <input data-transition='slide' type='submit' value='Registar' />
    </div>
    </div>
    </form>
    _END;
    ?>
</body>
</html>