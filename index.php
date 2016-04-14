<?php

	include 'db.php';
	if (isset($_POST['name']) && isset($_POST['password'])) {
		if ($_POST['name'] != '' && $_POST['password'] != '') {
			$username = $_POST['name'];
			$password = $_POST['password'];
			print_r($username.'<br>'.$password);

		}else{
			$errMsg = 'Usuario ou senha incorretos';
		}
	}
	
	
?>

<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
</head>
<body>
<div id="container">
	<form method="post" action='' name='frmLogin'>
		<div id="thumb">
			<img src="img/default_large.png">			
		</div>
		<input type="text" name="name" id="name" placeholder="Login">
		<input type="password" name="password" id="password" placeholder="Senha">
		<p><?=$errMsg?></p>
		<fieldset>
			<button class="myButton" type="submit" name="btn_send"> Entrar </button> 
		</fieldset>
		<fieldset>
			<button class="myButton" type="submit" name="btn_new"> Cadastre-se </button> 
		</fieldset>
	</form>
</div>
</body>
</html>