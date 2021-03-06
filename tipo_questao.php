<?php
	session_start();

	include 'db.php';

	$pp = 20;

	if(isset($_GET['p'])){
		$p = $_GET['p']; 
	}else{
		$p = 1;
	}
	if (isset($_POST['search_'])){
		$ser_btn = $_POST['search'];
		$stmt = odbc_exec($conn, "select * from TipoQuestao where descricao like '%$ser_btn%' order by descricao offset(".(($pp * $p) - $pp).") ROWS FETCH NEXT (".$pp.") ROWS ONLY");
		$count = odbc_exec($conn, "select count(*) as count from TipoQuestao where descricao like '%$ser_btn%'");
	}elseif(isset($_GET['s'])){
		$ser_btn = $_GET['s'];
		$stmt = odbc_exec($conn, "select * from TipoQuestao where descricao like '%$ser_btn%' order by descricao offset(".(($pp * $p) - $pp).") ROWS FETCH NEXT (".$pp.") ROWS ONLY");
		$count = odbc_exec($conn, "select count(*) as count from TipoQuestao where descricao like '%$ser_btn%'");
	}else{
		$stmt = odbc_exec($conn, "select * from TipoQuestao order by descricao offset(".(($pp * $p) - $pp).") ROWS FETCH NEXT (".$pp.") ROWS ONLY");
		$count = odbc_exec($conn, "select count(*) as count from TipoQuestao");
	}
	
	$a = odbc_fetch_array($count);

	$count = $a['count'];
	
	$pages = ceil($count/$pp);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tipo de Quest&atilde;o</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<script type='text/javascript' src='jquery-2.2.3.js'></script>
</head>
<body>
	<header>
		<?php include 'menu.php'; ?>
	</header>
	<div id='wrapper'>
		<section class='btn-action'>
			
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
				<tr>
			<?php
			
				while($tipo_questao = odbc_fetch_array($stmt)){ ?>
					<tr>
						<td>
							<?php echo $tipo_questao["codTipoQuestao"];?>
						</td>
						<td>
							<?php echo utf8_encode($tipo_questao["descricao"]); ?>
						</td>
						
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
	
		<footer>
			<p><a href="documentacao_pi.pdf" target="blank_">Manual do usuário</a></p>
		</footer>
	</div>

	<footer>			
	</footer>

</body>
</html>