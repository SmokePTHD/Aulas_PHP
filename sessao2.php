<?php
session_start();
echo "A cor favorita é " . $_SESSION["favcor"] . ".<br />";
echo "O animal favorito é " . $_SESSION["favanimal"] . ".";
?>