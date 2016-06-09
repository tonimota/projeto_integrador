<?php 

	session_start();
	include 'db.php';

	if(!isset($_GET['cod'])){
		header('Location: users.php');
	}else{
		$cod = $_GET['cod'];
		
		$tables = array('Evento','Questao');
		$result = 0;
		foreach($tables as $value){
			$query = odbc_prepare($conn, "SELECT * FROM $value T where T.codProfessor=?");
			$exec = odbc_execute($query, array($cod));
			//echo "rows ".odbc_num_rows($query).' '.$value."<br>";
			if(odbc_num_rows($query) > 0){
				$result = $result + 1;
				//echo $value.' '.$result."<br>";
			}
		}
		
		if($result == 0){
			$query = odbc_prepare($conn, "DELETE FROM Professor where codProfessor=? ");
			$exec = odbc_execute($query, array($cod));
			$err = odbc_errormsg($conn);
			$msg = "1";
			echo 'sucesso';
		}else{
			$msg = "0";
			echo 'erro';
		}
		
		header ("Location: users.php?response=$msg");
	}
	include 'menu.php';
?>