<?php

  $db = parse_ini_file("config.ini");

  $connection = $db['connection'];
  $host = $db['host'];
  $port = $db['port'];
  $name = $db['name'];
  $user = $db['user'];
  $pass = $db['pass'];

  // Connect to MySQL
  $con = mysqli_connect($host, $user, $pass, $name) or die(); //  host, user, pass, db-name

?>
