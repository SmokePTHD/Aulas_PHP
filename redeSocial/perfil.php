<?php // perfil.php
  require_once 'header.php';
  if (!$loggedin) die("</div></body></html>");
  echo "<h3>O seu perfil</h3>";
  $result = queryMysql("SELECT * FROM perfis WHERE utilizador='$utilizador'");
  if (isset($_POST['texto']))
  {
    $texto = ($_POST['texto']);
    $texto = preg_replace('/\s\s+/', ' ', $texto);
    if ($result->num_rows)
         queryMysql("UPDATE perfis SET texto='$texto' WHERE utilizador='$utilizador'");
    else queryMysql("INSERT INTO perfis VALUES('$utilizador', '$texto')");
  }
  else
  {
    if ($result->num_rows)
    {
      $row  = $result->fetch_array(MYSQLI_ASSOC);
      $texto = stripslashes($row['texto']);
    }
    else $texto = "";
  }
  $texto = stripslashes(preg_replace('/\s\s+/', ' ', $texto));
  if (isset($_FILES['image']['name']))
  {
    $saveto = "$utilizador.jpg"; // grava a imagem com o nome do utilizador e formato jpg
    move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
    $typeok = TRUE;
    switch($_FILES['image']['type'])
    {
      case "image/gif":   $src = imagecreatefromgif($saveto); break;
      case "image/jpeg":  
      case "image/pjpeg": $src = imagecreatefromjpeg($saveto); break;
      case "image/png":   $src = imagecreatefrompng($saveto); break;
      default:            $typeok = FALSE; break;
    }
    if ($typeok)
    {
      list($w, $h) = getimagesize($saveto); // width e height
      $max = 100; // valor máximo da miniatura da imagem
      $tw  = $w; // redimensionamento da imagem
      $th  = $h;
      if ($w > $h && $max < $w)
      {
        $th = $max / $w * $h;
        $tw = $max;
      } 
      elseif ($h > $w && $max < $h)
      {
        $tw = $max / $h * $w;
        $th = $max;
      }
      elseif ($max < $w)
      {
        $tw = $th = $max;
      }
      $tmp = imagecreatetruecolor($tw, $th);
      imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h); // cópia da imagem redimensionada
      imageconvolution($tmp, array(array(-1, -1, -1), array(-1, 16, -1), array(-1, -1, -1)), 8, 0); // para a imagem não desfocar
      imagejpeg($tmp, $saveto);
      imagedestroy($tmp); // apaga as imagens temporárias da memória
      imagedestroy($src);
    }
  }
  mostrarPerfil($utilizador);
echo <<<_END
      <form data-ajax='false' method='post'
        action='perfil.php' enctype='multipart/form-data'>
      <h3>Introduza ou edite os seus detalhes e/ou faça upload de uma imagem.</h3>
      <textarea name='texto'>$texto</textarea><br>
      Imagem: <input type='file' name='image' size='14'>
      <input type='submit' value='Guardar Perfil'>
      </form>
    </div><br>
  </body>
</html>
_END;
?>