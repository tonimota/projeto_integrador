<?php
	session_start();
	if (!isset($_SESSION['showMenu'])) {
		header('Location: index.php');
	}

	include 'db.php';
	include 'crud_functions.php';

//CONSULTAS DB
	// SELECT
 	$result = select("select * from Professor", $conn);
	
	
	

	
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
					<li><a href="first.php">Inicio</a></li>
					<li><a href="">Cadastrar</a></li>
					<li><a href="">Usuários</a></li>
					<li><i class="fa fa-sign-out" aria-hidden="true"></i><a href="logout.php"> Sair</a></li>
					<li><a href="new_user.php">Inserir Usuário</a></li>
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
						<th>Editar</th>
						<th>Deletar</th>
					<tr>
				<?php foreach($result as $area){ ?>
						<tr>
							<td>
								<?php echo $area['nome'];?>
							</td>
							<td>
								<?php echo $area['email'];?>
							</td>
							<td>
								<?php echo $area['tipo'];?>
							</td>
							<td>
								<input type='submit' value='Alterar'>
							</td>
							<td>
								<a href='#'>Excluir</a>
							</td>
						</tr>
				<?php } ?>
				</table>
			</div>
		</div>
		<footer>			
		</footer>
	</body>
	</html>