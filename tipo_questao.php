<?php
	session_start();

	include 'db.php';

	
	$count = odbc_exec($conn, "select count(*) as count from TipoQuestao");
	$a = odbc_fetch_array($count);

	$count = $a['count'];
	if(isset($_GET['p'])){
		$p = $_GET['p']; 
	}else{
		$p = 1;
	}
	
	$pp = 20;
	$stmt = odbc_exec($conn, "select * from TipoQuestao order by codTipoQuestao offset(".(($pp * $p) - $pp).") ROWS FETCH NEXT (".$pp.") ROWS ONLY");
	$pages = ceil($count/$pp);
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
		<?php include 'menu.php'; ?>
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
		<?php if($pages > 1 ){?>
		<div class="pages">
			<ul>
				<?php for($i = 1; $i <= $pages; $i++){?>
					<li>
						<a href='users.php?p=<?php echo $i; ?>'><?php echo $i; ?></a>
					</li>
				<?php } ?>
			</ul>
		</div>
		<?php } ?>
	</div>
	<footer>			
	</footer>
</body>
</html>