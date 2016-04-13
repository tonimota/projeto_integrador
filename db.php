<?php
  $server = "localhost";
  $db = "teste";
  $user = "root";
  $password = "root";
  $dsn = "Driver={SQL Server};Server=$server;Port=1433;Database=$db;";

  $connect = odbc_connect($dsn,
              $user,
              $password);

?>