<?php
	session_start();
	include 'db.php';


	if(!isset($_GET['cod'])){
		header('Location: users.php');
	}else{
		$cod = $_GET['cod'];
		$description = $_GET['description'];
	}
	
	if(isset($_POST['update_area'])){
		$description = $_POST['description'];
		
		if (empty($description)) {
			
			$error = "<br><br><br><br><br><br>Erro ao Inserir dados";
			print_r($error);
		}else{
			
			$query = odbc_prepare($conn, "UPDATE Area set descricao=? where codArea=? ");
			$exec = odbc_execute($query, array($description, $cod));
			
			if($exec){
				$msg = "1";
			}else{
				$msg = "0";
			}
			header ("Location: area.php?response=$msg");
		}
	}
	
?>
<html>
<head>
	<title>Editar</title>
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
	<div id='up-form'>
		<div id="element_to_pop_up">
			<form id="update_area" name='frmUpdate' method='post' action=''>
				<h3>Preencha os campos</h3>
				<ul>
					<li>
						<div class="icon-form">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
						</div>
						<input type="text" placeholder="Descricao" name='description' value='<?php echo $description; ?>'></input>
					</li>
					<button type="submit" name="update_area">Salvar</button>			
				</ul>
			</form>
		</div>
	</div>
</body>
</html>