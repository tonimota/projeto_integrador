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
					<li><a href="">Cadastrar</a></li>
					<li><a href="">Usuários</a></li>
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
						<th>Cod. Usuario</th>
						<th>Nome</th>
						<th>E-mail</th>
						<th>Id Senac</th>
						<th>Tipo</th>
					</tr>

					<?php foreach ($result as $key=>$value) {
						print_r($value);
						print_r($key);

						?>	
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<?php }?>
				</table>
			</div>
		</div>

		<footer>
			
		</footer>

	</body>
	</html>
<?php } ?>