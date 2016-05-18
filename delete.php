<?php 

	session_start();
	include 'db.php';
	if (!isset($_SESSION['showMenu'])) {
		header('Location: index.php');
	}

	if(!isset($_GET['cod'])){
		header('Location: first.php');
	}else{
		$cod = $_GET['cod'];
		
		$query = odbc_prepare($conn, "DELETE FROM Professor where codProfessor=? ");
		$exec = odbc_execute($query, array($cod));
		echo odbc_errormsg($conn);
		if($exec){
			$mensag = "<br><br><br><br><br><br>Você excluiu com sucesso<br>";
		}else{
			$mensag = '<br><br><br><br><br><br>Erro ao excluir<br>';
		}
	}

?>