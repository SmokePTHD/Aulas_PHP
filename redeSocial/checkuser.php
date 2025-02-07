<?php // checkuser.php
  require_once 'funcoes.php';

  if (isset($_POST['utilizador']))
  {
    $utilizador = ($_POST['utilizador']);
    $result = queryMysql("SELECT * FROM membros WHERE utilizador='$utilizador'");
    if ($result->num_rows)
		// Unicode Hex Character Code &#x2718 e &#x2714
    echo  "<span class='taken'>&nbsp;&#x2718; " .
            "O nome de utilizador '$utilizador' não está disponível</span>";
    else
      echo "<span class='available'>&nbsp;&#x2714; " .
           "O nome de utilizador '$utilizador' está disponível</span>";
  }
?>
