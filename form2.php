<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Nome: <input type="text" name="nome"><p />
E-mail: <input type="text" name="email"><p />
Website: <input type="text" name="website"><p />
Comentário:<br />
<textarea name="comment" rows="5" cols="40"></textarea><p />
Género:<br />
<input type="radio" name="genero" value="feminino"> feminino
<input type="radio" name="genero" value="masculino"> masculino
<input type="radio" name="genero" value="outro"> outro
</form>	