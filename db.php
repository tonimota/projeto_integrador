<?php

	$user = "TSI";
	$password = "SistemasInternet123";
	$db = "SenaQuiz";
  	$server = "koo2dzw5dy.database.windows.net";

  	$dsn = "Driver={SQL Server};Server=$server;Port=1433;Database=$db;";

  	// $conn = new PDO("dblib:host=$server;dbname=$db", "$user", "$password");
  	// var_dump($conn);
// $conn = odbc_connect($dsn, $user, $password);
// var_dump($conn); 

  	if (odbc_connect($dsn, $user, $password)) {
  		echo 'conectado';
  	}else{
  		echo 'erro';
  	}



?>