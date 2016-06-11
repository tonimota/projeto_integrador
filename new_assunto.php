<?php

	session_start();
	include 'db.php';
	if($_SESSION['tipoProfessor'] != 'A'){
		header('Location: assunto.php');
	}

	if(isset($_POST['new_assunto'])) {

		$description = $_POST['description'];
		$codArea = $_POST['codArea'];

		if (empty($description)) {

			$error = "<br><br><br><br><br><br>Preecha a descri&ccedil;&atilde;o";
			print_r($error);

		} else {
			$query = " INSERT INTO Assunto (descricao, codArea) VALUES ('$description', '$codArea'); ";

			$exec = odbc_exec($conn, $query);
			
			if($exec){
				$msg = "1";
			}else{
				$msg = "0";
			}
			header ("Location: assunto.php?response=$msg");
		}
	}
	
	$stmt = odbc_exec($conn, "select * from Assunto");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Novo Assunto</title>
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
	<div id="element_to_pop_up">
	<div id="new_user">
		<form method="POST" action='' name='frmUser'>
		<ul>
			<li>
				<div class="icon-form">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
				</div>
			<input type="text" name="description" id="description" placeholder="Descri&ccedil;&atilde;o">
			</li>
			<select name='codArea' id='codArea'>
			<?php while($area = odbc_fetch_array($stmt)){ ?>
				<option value='<?php echo $area["codArea"]; ?>'><?php echo utf8_encode($area['descricao']); ?></option>
			<?php } ?>
			</select>
			<button type="submit" name="new_assunto">Salvar</button>
			</ul>
		</form>
	</div>
	</div>
</body>
</html>