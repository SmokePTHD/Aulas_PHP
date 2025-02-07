<!DOCTYPE html>
<html>
  <head>
    <title>Início</title>
  </head>
  <body>
<?php // index.php
  session_start();
  require_once 'header.php';
  echo "<div class='center'>Bem-vindo a gpsi22,";
  if ($loggedin) echo " $utilizador, você está ligado.";
  else           echo ' por favor registe-se ou entre.';
  echo <<<_END
      </div><br>
    </div>
    <div data-role="footer">
      <h4><i><a href='http://www.epb.pt' target='_blank'>Rede social da turma de gpsi22</a></i></h4>
    </div>
_END;
?>
  </body>
</html>
