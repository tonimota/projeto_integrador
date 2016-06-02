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
		echo "<center>$msg</center>";		
	}
	
	if(isset($_GET['responseDelete'])){
		$response = $_GET['responseDelete'];
		if($response != 0){
			$msg = "Excluido com sucesso";
		}else{
			$msg = "O registro esta sendo usado em outra tabela, portanto nao pode ser excluido";
		}
		
	}
	
//CONSULTAS DB
	// SELECT
	
	$stmt = odbc_exec($conn, "select * from Professor");
	
?>
<html>
<head>
	<title>Usuarios</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<script type='text/javascript' src='jquery-2.2.3.js'></script>
	<script type='text/javascript' src='scripts.js'></script>
</head>
<body>
	<header>
		<?php if ($_SESSION['showMenu'] == true) {?>
		<nav>
			<ul>
				<li><a href="users.php">Usuários</a></li>
				<li><a href="area.php">Area</a></li>
				<li><a href="assunto.php">Assunto</a></li>
				<li><a href="tipo_questao.php">Tipo Questão</a></li>
				<li><i class="fa fa-sign-out" aria-hidden="true"></i><a href="logout.php"> Sair</a></li>
			</ul>
		</nav>
		<?php }else{
			echo 'sem menu';
		}?>
	</header>
	<div id='wrapper'>
		<div id="btn-add">
			<a href="new_user.php" class='myButton2'>Inserir Usuário</a>
		</div>
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
							<a href='update_user.php?cod=<?php echo $area["codProfessor"] ?>&nome=<?php echo $area['nome']; ?>&email=<?php echo $area['email']; ?>&tipo=<?php echo $area['tipo']; ?>&senac_id=<?php echo $area['idSenac']; ?>'><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>
						</td>
						<td>
							<a class='delete' href='delete_user.php?cod=<?php echo $area["codProfessor"] ?>'><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></a>
						</td>
					</tr>
					
				<?php } ?>					

			</table>
		</div>
		<div id="msg-return">
			<?php echo $msg; ?>
		</div>
	</div>
	<footer>			
	</footer>
</body>
</html>