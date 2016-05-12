<?php
	session_start();
	if (!isset($_SESSION['showMenu'])) {
		header('Location: index.php');
	}

	include 'db.php';

//CONSULTAS DB
	// SELECT
	
	$stmt = odbc_exec($conn, "select * from Professor");
	echo odbc_errormsg($conn);
	
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
				<li><a href="index.php">Inicio</a></li>
				<li><a href="first.php">Usuários</a></li>
				<li><a href="new_user.php">Inserir Usuário</a></li>
				<li><i class="fa fa-sign-out" aria-hidden="true"></i><a href="logout.php"> Sair</a></li>
			</ul>
		</nav>
		<?php }else{
			echo 'sem menu';
		}?>
	</header>
	<div id='wrapper'>
		<div class='table-holder'>
			<table>
				<tr>
					<th>Nome</th>
					<th>E-mail</th>
					<th>Tipo</th>
					<th>Alterar</th>
					<th>Excluir</th>
				<tr>
			<?php
				while($area = odbc_fetch_array($stmt)){
					echo ("<tr><td>".$area['nome']."</td>"."<td>".$area['email']."</td>"."<td>".$area['tipo']."</td>"."<td>"."<a href='update.php'><button type='submit' class='my-button2' value='Alterar'></button></a>"."<td>"."<a href='#'><i class='fa fa-trash fa-2x' aria-hidden='true'></i>
</a>"."</td>"."</tr>");
				}					
			?>
			</table>
		</div>
	</div>
	<footer>			
	</footer>
</body>
</html>