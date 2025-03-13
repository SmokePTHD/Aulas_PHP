<?php // logout.php
  require_once 'header.php';

  if (isset($_SESSION['utilizador']))
  {
    destroiSessao();
    header("Location: login.php");
  }
  else echo "<div class='center'>Você não pode terminar a sessão porque ela não está activa.</div>";
?>
    </div>
  </body>
</html>
