<?php // mensagens.php
  require_once 'header.php';
  if (!$loggedin) die("</div></body></html>");
  if (isset($_GET['ver'])) $ver = ($_GET['ver']);
  else                      $ver = $utilizador;
  if (isset($_POST['texto']))
  {
    $texto = ($_POST['texto']);
    if ($texto != "")
    {
      $tipomsg   = substr(($_POST['tipomsg']),0,1);
      $hora = time();
      queryMysql("INSERT INTO mensagens VALUES(NULL, '$utilizador', '$ver', '$tipomsg', '$hora', '$texto')");
    }
  }
  if ($ver != "")
  {
    if ($ver == $utilizador) $nome1 = $nome2 = "As suas";
    else
    {
      $nome1 = "<a href='membros.php?ver=$ver'>$ver</a>";
      $nome2 = "$ver";
    }
    echo "<h3>$nome1 mensagens</h3>";
    mostrarPerfil($ver);
    echo <<<_END
      <form method='post' action='mensagens.php?ver=$ver'>
        <fieldset data-role="controlgroup" data-type="horizontal">
          <legend>Escreva aqui a sua mensagem</legend>
          <input type='radio' name='tipomsg' id='publica' value='0' checked='checked'>
          <label for="publica">Pública</label>
          <input type='radio' name='tipomsg' id='privada' value='1'>
          <label for="privada">Privada</label>
        </fieldset>
      <textarea name='texto'></textarea>
      <input data-transition='slide' type='submit' value='Enviar'>
    </form><br>
_END;
    date_default_timezone_set('UTC');
    if (isset($_GET['apaga']))
    {
      $apaga = ($_GET['apaga']);
      queryMysql("DELETE FROM mensagens WHERE id='$apaga' AND destin='$utilizador'");
    }
    $query  = "SELECT * FROM mensagens WHERE destin='$ver' ORDER BY hora DESC";
    $result = queryMysql($query);
    $num    = $result->num_rows;
    for ($j = 0 ; $j < $num ; ++$j)
    {
      $row = $result->fetch_array(MYSQLI_ASSOC);
      if ($row['tipomsg'] == 0 || $row['autor'] == $utilizador || $row['destin'] == $utilizador)
      {
        echo date('M jS \'y g:ia:', $row['hora']);
        echo " <a href='mensagens.php?ver=" . $row['autor'] .
             "'>" . $row['autor']. "</a> ";
        if ($row['tipomsg'] == 0)
          echo "escreveu: &quot;" . $row['mensagem'] . "&quot; ";
        else
          echo "escreveu em privado: <span class='privado'>&quot;" .
            $row['mensagem']. "&quot;</span> ";
        if ($row['destin'] == $utilizador)
          echo "[<a href='mensagens.php?ver=$ver" .
               "&apaga=" . $row['id'] . "'>Apagar</a>]";
        echo "<br>";
      }
    }
  }
  if (!$num)
    echo "<br><span class='info'>Não há mensagens</span><br><br>";
	echo "<br><a data-role='button' href='mensagens.php?ver=$ver'>Atualizar mensagens</a>";
?>
    </div><br>
  </body>
</html>