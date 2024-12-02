<?php
  $isbn = filter_input(INPUT_POST, 'isbn');
  $novoautor = filter_input(INPUT_POST, 'autor');
  $novotitulo = filter_input(INPUT_POST, 'titulo');
  $novocategoria = filter_input(INPUT_POST, 'categoria');
  $novoano = filter_input(INPUT_POST, 'ano');
  $ligacao = mysqli_connect("localhost", "goncalo1234", "password1234", "publicacoes");

  mysqli_setcharset($ligacao, "utf8");
  if(!ligacao) {
    header("Location:exibir.php?alteracao=false");
    exit;
  }

  // Update à tabela
  $sql = "UPDATE classicos_lit SET autor='" . $novoautor . "', titulo='" . $novotitulo . "', categoria='" . $novocategoria . "', ano='" . $novoano . "' WHERE isbn='" . $isbn;
  $update = mysqli_query($ligacao, $sql);

  // se der erro
  if (!$update){
    header("Location:exibir.php?alter=false");
    exit;
  }
  // se funcionar redericiona para exibir.php com alteração efectuada
  header("Location:exibir.php?alter=true");
?>