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
	$count = odbc_exec($conn, "select count(*) as count from Professor");
	$a = odbc_fetch_array($count);

	$count = $a['count'];
	if(isset($_GET['p'])){
		$p = $_GET['p']; 
	}else{
		$p = 1;
	}
	
	$pp = 20;
	$stmt = odbc_exec($conn, "select * from Professor order by nome offset(".(($pp * $p) - $pp).") ROWS FETCH NEXT (".$pp.") ROWS ONLY");
	$pages = $count/$pp;
	
	if(is_float ($pages)){
		$pages = $pages + 1;
	};

	
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
	<?php if($_SESSION['typeProfessor'] == 'A'){?>
		<div class="btn-add">
			<a href="new_user.php" class='myButton2'>Inserir Usuário</a>
		</div>
	<?php } ?>
		
		<div class="btn-add">
			<a href="update_user.php?cod=<?php echo $_SESSION["codProfessor"] ?>" class='myButton2'>Alterar meus dados</a>
		</div>
		<div class='table-holder'>
			<table>
				<tr>
					<th>Nome</th>
					<th>E-mail</th>
					<th>Tipo</th>
					<?php if($_SESSION['typeProfessor'] == 'A'){?>
					<th>Alterar</th>
					<th>Excluir</th>
					<?php } ?>
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
						<?php if($_SESSION['typeProfessor'] == 'A'){?>
						<td>
							<a href='update_user.php?cod=<?php echo $area["codProfessor"] ?>'><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>
						</td>
						<td>
							<a class='delete' href='delete_user.php?cod=<?php echo $area["codProfessor"] ?>'><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></a>
						</td>
						<?php } ?>
					</tr>
					
				<?php } ?>					

			</table>
		</div>
		<?php if($pages > 1 ){?>
		<div>
			<ul>
				<?php for($i = 1; $i <= $pages; $i++){?>
					<li>
						<a href='users.php?p=<?php echo $i; ?>'><?php echo $i; ?></a>
					</li>
				<?php } ?>
			</ul>
		</div>
		<?php } ?>
		
		<?php if(isset($msg)){?>
		<div class="msg-return">
			<?php echo "<div class='style-msg'>$msg</div>"; ?>
		</div>
		<?php } ?>
	</div>
	<footer>			
	</footer>
	<script type="text/javascript">
		$('.msg-return').delay(2000).fadeOut();
	</script>
</body>
</html>