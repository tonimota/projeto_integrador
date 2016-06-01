<?php
	session_start();
	if (!isset($_SESSION['showMenu'])) {
		header('Location: index.php');
	}

	include 'db.php';
	
	if(isset($_GET['response'])){
		$response = $_GET['response'];
		if($response != 0){
			$msg = "Efetuado com sucesso";
		}else{
			$msg = "Erro ao conectar com o banco de dados";
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
		
		echo "<center>$msg</center>";
			
	}
	
	$stmt = odbc_exec($conn, "select ASS.codAssunto, ASS.descricao, AR.codArea, AR.descricao as area from assunto ASS inner join area AR on ASS.codArea = AR.codArea");
?>

<html>
<head>
	<title>Assunto</title>
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
		<a href="new_assunto.php" class='my-button'>Inserir Assunto</a>
		<div class='table-holder'>
			<table>
				<tr>
					<th>ID</th>
					<th>Descricao</th>
					<th>Area</th>
					<th>Alterar</th>
					<th>Excluir</th>
				<tr>
			<?php
			
				while($assunto = odbc_fetch_array($stmt)){ ?>
					<tr>
						<td>
							<?php echo $assunto["codAssunto"];?>
						</td>
						<td>
							<?php echo $assunto["descricao"]; ?>
						</td>
						<td>
							<?php echo $assunto["area"]; ?>
						</td>
						<td>
							<a href='update_assunto.php?cod=<?php echo $assunto["codAssunto"] ?>&codArea=<?php echo $assunto['codArea']?>&description=<?php echo $assunto['descricao']; ?>'><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>
						</td>
						<td>
							<a class='delete' href='delete_assunto.php?cod=<?php echo $assunto["codAssunto"] ?>'><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></a>
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