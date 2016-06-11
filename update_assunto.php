<?php
	session_start();
	include 'db.php';
	if($_SESSION['tipoProfessor'] != 'A'){
		header('Location: assunto.php');
	}

	if(!isset($_GET['cod'])){
		header('Location: users.php');
	}else{
		$cod = $_GET['cod'];
		$codArea = $_GET['codArea'];
		$description = $_GET['description'];
	}
	
	if(isset($_POST['update_assunto'])){
		$description = $_POST['description'];
		$codArea = $_POST['codArea'];
		
		if (empty($description)) {
			
			$error = "<br><br><br><br><br><br>Preencha o(s) campo(s)";
			print_r($error);
		}else{
			
			$query = odbc_prepare($conn, "UPDATE Assunto set descricao=?, codArea=?  where codAssunto=? ");
			$exec = odbc_execute($query, array($description, $codArea, $cod));
			
			if($exec){
				$msg = "1";
			}else{
				$msg = "0";
			}
			header ("Location: assunto.php?response=$msg");
		}
	}
	$stmt = odbc_exec($conn, "select * from Area");
?>
<!DOCTYPE html>
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
			<form id="update_assunto" name='frmUpdate' method='post' action=''>
				<h3>Preencha os campos</h3>
				<ul>
					<li>
						<div class="icon-form">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
						</div>
						<input type="text" placeholder="descri&ccedil;&atilde;o" name='description' value='<?php echo $description; ?>'></input>
					</li>
					<li>
						<div class="icon-form">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
						</div>
						<select name='codArea' id='codArea'>
						<?php while($area = odbc_fetch_array($stmt)){
							if($area['descricao'] == $codArea){ ?>
								<option selected value='<?php echo $area["codArea"]; ?>'><?php echo $area['descricao']; ?></option>
							<?php }else{ ?>
								<option value='<?php echo $area["codArea"]; ?>'><?php echo $area['descricao']; ?></option>
							<?php } ?>
							
						<?php } ?>
						</select>
					</li>
					<button type="submit" name="update_assunto">Salvar</button>			
				</ul>
			</form>
		</div>
	</div>
</body>
</html>