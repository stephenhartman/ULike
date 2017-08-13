<?php
  $serverName = "localhost";
  $use = "group3";
  $password = "ulikeourproject";
  $dbName = "group3";

  //Create connection
  $databaseConnect = new mysqli($serverName, $use, $password, $dbName);

  if ($databaseConnect->connect_error){
    die("Connection to the server failed");
  }

 ?>
