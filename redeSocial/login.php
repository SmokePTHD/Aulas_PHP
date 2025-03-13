<?php // login.php
  session_start();
  require_once 'header.php';
  require_once 'database.php';
  $error = $utilizador = $password = "";
  
  if (isset($_POST['utilizador']))
  {
    $utilizador = ($_POST['utilizador']);
    $password = ($_POST['password']);

    if ($utilizador == "" || $password == "")
      $error = 'Não estão preenchidos todos os campos.';
    else
    {
      $smtp = $ligacao->prepare('SELECT utilizador, password FROM membros WHERE utilizador=?');
      $smtp->bind_param('s', $utilizador);
      $smtp->execute();
      $smtp->store_result();
      $smtp->bind_result($db_utilizador, $db_password);
      $smtp->fetch();

      if ($smtp->num_rows == 0)
      {
        $error = "Login inválido";
      }
      else
      {
        if (password_verify($password, $db_password))
        {
          $_SESSION['utilizador'] = $utilizador;
          $_SESSION['password'] = $password;

          header("Location: membros.php?view=$utilizador");
        }
        else
        {
          $error = "Login inválido";
        }
      }
    }
  }
echo <<<_END
  <html>
  <body>
      <form method='post' action='login.php'>
        <div data-role='fieldcontain'>
          <span class='error'>$error</span>
        </div>
        <div data-role='fieldcontain'>
          Por favor introduza os dados
        </div>
        <div data-role='fieldcontain'>
          <label>Nome de utilizador</label>
          <input type='text' maxlength='16' name='utilizador' value='$utilizador'>
        </div>
        <div data-role='fieldcontain'>
          <label>Password</label>
          <input type='password' maxlength='16' name='password' value='$password'>
        </div>
        <div data-role='fieldcontain'>
          <input data-transition='slide' type='submit' value='Entrar'>
        </div>
      </form>
    </div>
  </body>
</html>
_END;
?>