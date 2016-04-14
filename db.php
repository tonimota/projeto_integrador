<?php

	$user = "TSI";
	$password = "SistemasInternet123";
	$db = "SenaQuiz";
  	$server = "koo2dzw5dy.database.windows.net";

  	$dsn = "Driver={SQL Server};Server=$server;Port=1433;Database=$db;";

  	if (odbc_connect($dsn, $user, $password)) {
  		
  	}else{
  		echo 'erro ao conectar com o banco de dados';
  	}



?>