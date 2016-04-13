<?php


	if ($_POST['name'] != '' && $_POST['password'] != '') {
		$username = $_POST['name'];
		$password = $_POST['password'];
		print_r($username.'<br>'.$password);
	}else{
		$errMsg = 'Usuario ou senha incorretos';
		echo $errMsg;
	}

	

?>