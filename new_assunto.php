<?php

	session_start();
	include 'db.php';

	if(isset($_POST['new_assunto'])) {

		$description = $_POST['description'];
		$codArea = $_POST['codArea'];

		if (empty($description)) {

			$error = "<br><br><br><br><br><br>Preecha a descricao";
			print_r($error);

		} else {
			$query = " INSERT INTO Assunto (descricao, codArea) VALUES ('$description', '$codArea'); ";

			$exec = odbc_exec($conn, $query);
			
			if($exec){
				$msg = "1";
			}else{
				$msg = "0";
			}
			//header ("Location: assunto.php?response=$msg");
		}
	}
	
	$stmt = odbc_exec($conn, "select * from Assunto");
?>

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
	<div id="new_user">
		<form method="POST" action='' name='frmUser'>
			<input type="text" name="description" id="description" placeholder="Descricao">
			<select name='codArea' id='codArea'>
			<?php while($area = odbc_fetch_array($stmt)){ ?>
				<option value='<?php echo $area["codArea"]; ?>'><?php echo $area['descricao']; ?></option>
			<?php } ?>
			</select>
			<button type="submit" name="new_assunto">Salvar</button>
		</form>
	</div>
</body>
</html>