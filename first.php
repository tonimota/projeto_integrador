<?php
	session_start();
	if ($_SESSION['showMenu'] != true) {
		echo 'sem menu';
		
	}
?>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
</head>
<body>
<header>
	<nav>
		<ul>
			<li><a href="">Inicio</a></li>
			<li><a href="">Cadastrar</a></li>
			<li><a href="">Usuários</a></li>
			<li><i class="fa fa-sign-out" aria-hidden="true"></i><a href="logout.php"> Sair</a></li>
		</ul>
	</nav>
</header>


</body>
</html>