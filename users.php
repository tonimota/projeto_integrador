<?php
	session_start();
	if (!isset($_SESSION['showMenu'])) {
		header('Location: index.php');
	}

	include 'db.php';

	if(isset($_GET['response'])){
		$response = $_GET['response'];
		if($response != 0){
			$msg = "Excluido com sucesso";
		}else{
			$msg = "O registro esta sendo usado em outra tabela, portanto nao pode ser excluido";
		}
		
		echo $msg;
			
	}
	
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
<script type="text/javascript">
		
</script>
</head>
<body>
	<header>
		<?php if ($_SESSION['showMenu'] == true) {?>
		<nav>
			<ul>
				<li><a href="users.php">Usuários</a></li>
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
							<a href='update_user.php?cod=<?php echo $area["codProfessor"] ?>&nome=<?php echo $area['nome']; ?>&email=<?php echo $area['email']; ?>&tipo=<?php echo $area['tipo']; ?>&senac_id=<?php echo $area['idSenac']; ?>'><button class='my-button2'><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></button></a>
						</td>
						<td>
							<a href='delete_user.php?cod=<?php echo $area["codProfessor"] ?>'><button class='my-button2'><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></button></a>
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