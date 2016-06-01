<?php 

	session_start();
	include 'db.php';
	if (!isset($_SESSION['showMenu'])) {
		header('Location: index.php');
	}

	if(!isset($_GET['cod'])){
		header('Location: assunto.php');
	}else{
		$cod = $_GET['cod'];
		
		$query = odbc_prepare($conn, "DELETE FROM Assunto where codAssunto=? ");
		$exec = odbc_execute($query, array($cod));
		$err = odbc_errormsg($conn);
		if($exec){
			$msg = "1";				
		}else{
			$msg = "0";
		}
		header ("Location: assunto.php?responseDelete=$msg");
	}
?>