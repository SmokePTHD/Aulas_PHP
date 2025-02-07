<?php // amigos.php
  require_once 'header.php';
  if (!$loggedin) die("</div></body></html>");
  if (isset($_GET['ver'])) $ver = ($_GET['ver']);
  else                      $ver = $utilizador;
  if ($ver == $utilizador)
  {
    $nome1 = $nome2 = "Os seus";
    $nome3 =          "Você está";
  }
  else
  {
    $nome1 = "<a data-transition='slide' href='membros.php?ver=$ver'>$ver</a>"; // data-transition é jquery
    $nome2 = "$ver";
    $nome3 = "$ver é";
  }
  mostrarPerfil($ver);
  $seguidores = array();
  $aseguir = array();
  $result = queryMysql("SELECT * FROM amigos WHERE utilizador='$ver'");
  $num    = $result->num_rows; // o operador de objeto, -> , é usado para aceder métodos e propriedades de um objeto 
  for ($j = 0 ; $j < $num ; ++$j)
  {
    $row           = $result->fetch_array(MYSQLI_ASSOC); // MYSQLI_ASSOC - os itens da matriz (array) usarão o nome da coluna como uma chave de índice
    $seguidores[$j] = $row['amigo'];
  }
  $result = queryMysql("SELECT * FROM amigos WHERE amigo='$ver'");
  $num    = $result->num_rows;
  for ($j = 0 ; $j < $num ; ++$j)
  {
      $row           = $result->fetch_array(MYSQLI_ASSOC);
      $aseguir[$j] = $row['utilizador'];
  }
  $mutuos    = array_intersect($seguidores, $aseguir); // intersecção (o que é comum) de arrays para descobrir amigos mútuos
  $seguidores = array_diff($seguidores, $mutuos); // array_diff para os amigos não comuns
  $aseguir = array_diff($aseguir, $mutuos);
  $amigos   = FALSE;
  echo "<br>";
  if (sizeof($mutuos)) // sizeof retorna o número de elementos de um array
  {
    echo "<span class='subhead'>$nome2 amigos mútuos</span><ul>";
    foreach($mutuos as $amigo)
      echo "<li><a data-transition='slide' href='membros.php?ver=$amigo'>$amigo</a>";
    echo "</ul>";
    $amigos = TRUE;
  }
  if (sizeof($seguidores))
  {
    echo "<span class='subhead'>$nome2 seguidores</span><ul>";
    foreach($seguidores as $amigo)
      echo "<li><a data-transition='slide' href='membros.php?ver=$amigo'>$amigo</a>";
    echo "</ul>";
    $amigos = TRUE;
  }
  if (sizeof($aseguir))
  {
    echo "<span class='subhead'>$nome3 a seguir</span><ul>";
    foreach($aseguir as $amigo)
      echo "<li><a data-transition='slide' href='membros.php?ver=$amigo'>$amigo</a>";
    echo "</ul>";
    $amigos = TRUE;
  }
  if (!$amigos) echo "<br>Você ainda não tem amigos.";
?>