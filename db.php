<?php
  $server = "koo2dzw5dy.database.windows.net.senaquiz";
  $db = "SenaQuiz";
  $user = "TSI";
  $password = "SistemasInternet123";
  $dsn = "Driver={SQL Server};Server=$server;Port=1433;Database=$db;";

  $connect = odbc_connect($dsn,
              $user,
              $password);

?>