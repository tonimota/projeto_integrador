<?php
	session_start();
	if (!isset($_SESSION['showMenu'])) {
		header('Location: index.php');
	}

	include 'db.php';

	//CONSULTA DB
	$stmt = odbc_prepare($conn, "select * from Professor");

    odbc_execute($stmt);
    echo odbc_errormsg($conn);
   	//print_r(odbc_fetch_array($stmt));
   	$result = odbc_fetch_array($stmt);
    $rows = odbc_num_rows($stmt);
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
		<?php if ($_SESSION['showMenu'] == true) {?>
		<nav>
			<ul>
				<li><a href="">Inicio</a></li>
				<li><a href="">Usuários</a></li>
				<li><i class="fa fa-sign-out" aria-hidden="true"></i><a href="logout.php"> Sair</a></li>
				<li><a href="new_user.php">Inserir Usuário</a></li>
			</ul>
		</nav>
		<?php }else{
			echo 'sem menu';
		}?>
	</header>
<div id='up-form'>
	<div id="element_to_pop_up">
	<a class="b-close">x</a>
		<form id="update_user">
			<h3>Preencha os campos</h3>
			<ul>
				<li>
					<div class="icon-form">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</div>
					<input type="text" placeholder="Nome"></input>
				</li>
				<li>
					<div class="icon-form">
						<i class="fa fa fa-envelope" aria-hidden="true"></i>
					</div>
					<input type="email" placeholder="E-mail"></input>
				</li>
				<li id="button-contact-form">
					<button class="submit" type="submit">Enviar</button>
				</li>			
			</ul>
		</form>
	</div>
</div>
</body>
</html>