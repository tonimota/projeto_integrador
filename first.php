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
	<title>Usuarios</title>
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
				while($area = odbc_fetch_array($stmt)){ ?>
					<tr>
						<td>
							<?php echo $area['nome']; ?>
						</td>
						<td>
							<?php echo $area['email']; ?>
						</td>
						<td>
							<?php echo $area['tipo']; ?>
						</td>
						<td>
							<a href='update.php?cod=<?php echo $area["codProfessor"] ?>&nome=<?php echo $area['nome']; ?>&email=<?php echo $area['email']; ?>&tipo=<?php echo $area['tipo']; ?>&senac_id=<?php echo $area['idSenac']; ?>'><button class='my-button2' value='Alterar'></button></a>
						</td>
						<td>
							<p> <a href='#'>Excluir</a></p>
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