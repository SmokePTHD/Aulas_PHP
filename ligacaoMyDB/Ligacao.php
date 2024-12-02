<?php
  $host = "localhost";
  $userdb = "goncalo123";
  $passowrd = "password1234";
  $db = "databasePAP";

  $conn = mysqli_connect($host, $userdb, $passowrd, $db);

  if (!$conn){
    die('Error: ' . mysqli_connect_error());
  }

  return $conn;
?>