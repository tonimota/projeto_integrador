<?php
	session_start();


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
	
	// $stmt = odbc_exec($conn, "select * from Area");
	
	$count = odbc_exec($conn, "select count(*) as count from Area");
	$a = odbc_fetch_array($count);

	$count = $a['count'];
	if(isset($_GET['p'])){
		$p = $_GET['p']; 
	}else{
		$p = 1;
	}
	
	$pp = 20;
	$stmt = odbc_exec($conn, "select * from Area order by codArea offset(".(($pp * $p) - $pp).") ROWS FETCH NEXT (".$pp.") ROWS ONLY");
	$pages = ceil($count/$pp);
?>

<html>
<head>
	<title>Area</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<script type='text/javascript' src='jquery-2.2.3.js'></script>
	<script type='text/javascript' src='scripts.js'></script>
</head>
<body>
	<header>
		<?php include 'menu.php'; ?>
	</header>
	<div id='wrapper'>
	<?php if($_SESSION['typeProfessor'] == 'A'){?>
		<div class="btn-add">
			<a href="new_area.php" class='myButton2'>Inserir Area</a>
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
			
				while($area = odbc_fetch_array($stmt)){ ?>
					<tr>
						<td>
							<?php echo $area["codArea"];?>
						</td>
						<td>
							<?php echo $area["descricao"]; ?>
						</td>
						<?php if($_SESSION['typeProfessor'] == 'A'){?>
						<td>
							<a href='update_area.php?cod=<?php echo $area["codArea"] ?>&description=<?php echo $area['descricao']; ?>'><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>
						</td>
						<td>
							<a class='delete' href='delete_area.php?cod=<?php echo $area["codArea"] ?>'><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></a>
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
	</div>
	<footer>			
	</footer>
</body>
</html>