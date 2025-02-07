<?php // login.php
  require_once 'header.php';
  $error = $utilizador = $password = "";
  if (isset($_POST['utilizador']))
  {
    $utilizador = ($_POST['utilizador']);
    $password = ($_POST['password']);
    if ($utilizador == "" || $password == "")
      $error = 'Não estão preenchidos todos os campos.';
    else
    {
      $result = queryMySQL("SELECT utilizador,password FROM membros WHERE utilizador='$utilizador' AND password='$password'");
      if ($result->num_rows == 0)
      {
        $error = "Login inválido";
      }
      else
      {
        $_SESSION['utilizador'] = $utilizador;
        $_SESSION['password'] = $password;
        die("<div class='center'>Você não está ligado. Por favor
             <a data-transition='slide' href='membros.php?view=$utilizador'>clique aqui</a>
             para continuar.</div></div>");
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