<?php // membros.php
  require_once 'header.php';
  if (!$loggedin) die("</div></body></html>");
  if (isset($_GET['ver']))
  {
    $ver = ($_GET['ver']);
    if ($ver == $utilizador) $nome = "O seu";
    else                $nome = "$ver";
    echo "<h3>Perfil do $nome</h3>";
    mostrarPerfil($ver);
    echo "<a data-role='button' data-transition='slide'
          href='mensagens.php?ver=$ver'>Ver mensagens do $nome</a>";
    die("</div></body></html>");
  }
  if (isset($_GET['adiciona'])) // adicionar como amigo na tabela
  {
    $adiciona = ($_GET['adiciona']);
    $result = queryMysql("SELECT * FROM amigos WHERE utilizador='$adiciona' AND amigo='$utilizador'");
    if (!$result->num_rows)
      queryMysql("INSERT INTO amigos VALUES ('$adiciona', '$utilizador')");
  }
  elseif (isset($_GET['remove'])) // remover amizade na tabela
  {
    $remove = ($_GET['remove']);
    queryMysql("DELETE FROM amigos WHERE utilizador='$remove' AND amigo='$utilizador'");
  }
  $result = queryMysql("SELECT utilizador FROM membros ORDER BY utilizador");
  $num    = $result->num_rows;
  echo "<h3>Outros  membros</h3><ul>";
  for ($j = 0 ; $j < $num ; ++$j)
  {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if ($row['utilizador'] == $utilizador) continue;
    echo "<li><a data-transition='slide' href='membros.php?ver=" .
      $row['utilizador'] . "'>" . $row['utilizador'] . "</a>";
    $seguir = "seguir";
    $result1 = queryMysql("SELECT * FROM amigos WHERE
      utilizador='" . $row['utilizador'] . "' AND amigo='$utilizador'"); // ver amigos
    $t1      = $result1->num_rows;
    $result1 = queryMysql("SELECT * FROM amigos WHERE
      utilizador='$utilizador' AND amigo='" . $row['utilizador'] . "'");
    $t2      = $result1->num_rows;
    if (($t1 + $t2) > 1) echo " &harr; é amigo mútuo";
    elseif ($t1)         echo " &larr; você está a seguir";
    elseif ($t2)       { echo " &rarr; está a segui-lo";
                         $seguir = "retribuir"; }
    if (!$t1) echo " [<a data-transition='slide'
      href='membros.php?adiciona=" . $row['utilizador'] . "'>$seguir</a>]";
    else      echo " [<a data-transition='slide'
      href='membros.php?remove=" . $row['utilizador'] . "'>Não seguir</a>]";
  }
?>
    </ul></div>
  </body>
</html>