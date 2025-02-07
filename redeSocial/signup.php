<!DOCTYPE html>
<html>
  <head>
    <title>Registo</title>
  </head>
  <body>
<?php // signup.php
  require_once 'header.php';
echo <<<_END
  <script>
    function checkUser(utilizador) <!-- javascript para verificar se utilizador já existe -->
    {
      if (utilizador.value == '')
      {
        $('#used').html('&nbsp;')
        return
      }
      $.post
      (
        'checkuser.php',
        { utilizador : utilizador.value },
        function(data)
        {
          $('#used').html(data)
        }
      )
    }
  </script>  
_END;
  $error = $utilizador = $password = "";
  if (isset($_SESSION['utilizador'])) destroiSessao();
  if (isset($_POST['utilizador']))
  {
    $utilizador = ($_POST['utilizador']);
    $password = ($_POST['password']);
    if ($utilizador == "" || $password == "")
      $error = 'Preencha todos os campos<br><br>';
    else
    {
      $result = queryMysql("SELECT * FROM membros WHERE utilizador='$utilizador'");
      if ($result->num_rows)
        $error = 'Esse nome de utilizador já existe<br><br>';
      else
      {
        queryMysql("INSERT INTO membros VALUES('$utilizador', '$password')");
        die('<h4>Conta criada</h4>Por favor entre.</div></body></html>');
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
        <input type='text' maxlength='16' name='utilizador' value='$utilizador'
          onBlur='checkUser(this)'>
        <label></label><div id='used'>&nbsp;</div>
      </div>
      <div data-role='fieldcontain'>
        <label>Password</label>
        <input type='text' maxlength='16' name='password' value='$password'> <!-- mudar texto para password para ocultar a mesma -->
      </div>
      <div data-role='fieldcontain'>
        <label></label>
        <input data-transition='slide' type='submit' value='Registar'>
      </div>
    </div>
_END;
?>
  </body>
</html>