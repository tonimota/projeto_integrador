<?php
	session_start();
	if (!isset($_SESSION['showMenu'])) {
		header('Location: index.php');
	}

	include 'db.php';
	
	$stmt = odbc_exec($conn, "select * from TipoQuestao");
?>

<html>
<head>
	<meta charset="utf-8">
	<title>Tipo de Questão</title>
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
	<?php if($_SESSION['typeProfessor'] == 'A'){?>
		<div class="btn-add">
			<a href="new_tipo_questao.php" class='myButton2'>Inserir Tipo de Questão</a>
		</div>
	<?php } ?>
		<div class='table-holder'>
			<table>
				<tr>
					<th>ID</th>
					<th>Descricao</th>
					<?php if($_SESSION['typeProfessor'] == 'A'){?>
					<th>Alterar</th>
					<th>Excluir</th>
					<?php } ?>
				<tr>
			<?php
			
				while($tipo_questao = odbc_fetch_array($stmt)){ ?>
					<tr>
						<td>
							<?php echo $tipo_questao["codTipoQuestao"];?>
						</td>
						<td>
							<?php echo $tipo_questao["descricao"]; ?>
						</td>
						<?php if($_SESSION['typeProfessor'] == 'A'){?>
						<td>
							<a href='update_tipo_questao.php?cod=<?php echo $tipo_questao["codTipoQuestao"] ?>&description=<?php echo $tipo_questao['descricao']; ?>'><button class='my-button2'><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></button></a>
						</td>
						<td>
							<a href='delete_tipo_questao.php?cod=<?php echo $tipo_questao["codTipoQuestao"] ?>'><button class='my-button2'><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></button></a>
						</td>
						<?php } ?>
					</tr>
					
				<?php } ?>					

			</table>
		</div>
	</div>
	<footer>			
	</footer>
</body>
</html>