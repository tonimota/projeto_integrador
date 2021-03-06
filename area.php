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
	}
	
	if(isset($_GET['responseDelete'])){
		$response = $_GET['responseDelete'];
		if($response != 0){
			$msg = "Exclu&iacute;do com sucesso";
		}else{
			$msg = "O registro est&aacute; sendo usado em outra tabela, portanto nao pode ser exclu&iacute;do";
		}
	}
	
	$pp = 20;
	if(isset($_GET['p'])){
		$p = $_GET['p']; 
	}else{
		$p = 1;
	}
	if (isset($_POST['search_'])){
		$ser_btn = $_POST['search'];
		$stmt = odbc_exec($conn, "select * from Area where descricao like '%$ser_btn%' order by descricao offset(".(($pp * $p) - $pp).") ROWS FETCH NEXT (".$pp.") ROWS ONLY");
		$count = odbc_exec($conn, "select count(*) as count from Area where descricao like '%$ser_btn%'");
	}elseif(isset($_GET['s'])){
		$ser_btn = $_GET['s'];
		$stmt = odbc_exec($conn, "select * from Area where descricao like '%$ser_btn%' order by descricao offset(".(($pp * $p) - $pp).") ROWS FETCH NEXT (".$pp.") ROWS ONLY");
		$count = odbc_exec($conn, "select count(*) as count from Area where descricao like '%$ser_btn%'");
	}else{
		$stmt = odbc_exec($conn, "select * from Area order by descricao offset(".(($pp * $p) - $pp).") ROWS FETCH NEXT (".$pp.") ROWS ONLY");
		$count = odbc_exec($conn, "select count(*) as count from Area");
	}
	
	$a = odbc_fetch_array($count);

	$count = $a['count'];
	
	$pages = ceil($count/$pp);
?>
<!DOCTYPE html>
<html>
<head>
	<title>&Aacute;rea</title>
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
		<section class='btn-action'>
			<div class='action'>
				<?php if($_SESSION['tipoProfessor'] == 'A'){?>
					<div class="btn-add">
						<a href="new_area.php" class='myButton2'>Inserir &Aacute;rea</a>
					</div>
				<?php } ?>
			</div>
			<form class='action -off' method="POST">
				<i class="fa fa-search fa-1x" aria-hidden="true"></i>
				<input type="text" name="search">
				<input type='submit' name="search_">
			</form>
		</section>
		<div class='table-holder'>
			<table>
				<tr>
					<th>ID</th>
					<th>Descri&ccedil;&atilde;o</th>
					<?php if($_SESSION['tipoProfessor'] == 'A'){?>
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
							<?php echo utf8_encode($area["descricao"]); ?>
						</td>
						<?php if($_SESSION['tipoProfessor'] == 'A'){?>
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
		<div class="pages">
			<ul>
				<?php for($i = 1; $i <= $pages; $i++){ 
					if ($i == $p) {
						if (isset($_POST['search_']) || isset($_GET['s'])){?>
							<li>
								<a class='page-active' href="area.php?p=<?php echo $i; ?>&s=<?php echo $ser_btn?>"><?php echo $i; ?></a>
							</li>
						<?php }else{ ?>
							<li>
								<a class='page-active' href="area.php?p=<?php echo $i; ?>"><?php echo $i; ?></a>
							</li>
						<?php } ?>
					<?php } else { 
						if (isset($_POST['search_']) || isset($_GET['s'])){?>
							<li>
								<a href="area.php?p=<?php echo $i; ?>&s=<?php echo $ser_btn?>"><?php echo $i; ?></a>
							</li>
						<?php }else{ ?>
							<li>
								<a href='area.php?p=<?php echo $i; ?>'><?php echo $i; ?></a>
							</li>
						<?php } ?>	
					<?php } ?>
				<?php } ?>
			</ul>
		</div>
		<?php } ?>
		<?php if(isset($msg)){?>
		<div class="msg-return">
			<?php echo "<div class='style-msg'>$msg</div>"; ?>
		</div>
		<?php } ?>
		<footer>
			<p><a href="documentacao_pi.pdf" target="blank_">Manual do usuário</a></p>
		</footer>
	</div>
	<script type="text/javascript">
		$('.msg-return').delay(2000).fadeOut();
	</script>
</body>
</html>