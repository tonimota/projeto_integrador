<?php

	session_start();
	include 'db.php';
	if($_SESSION['tipoProfessor'] != 'A'){
		header('Location: users.php');
	}

	if(isset($_POST['new_user'])) {

		$name = $_POST['name'];
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$idSenac = $_POST['idSenac'];
		$tipo = $_POST['tipo'];

		if (empty($name) or empty($email) or empty($senha)) {

			$error = "<br><br><br><br><br><br>Erro ao Inserir dados";
			print_r($error);

		} else {
			$query = " INSERT INTO Professor (nome, email, senha, idSenac, tipo) VALUES ('$name','$email', HASHBYTES('SHA1', '$senha'), '$idSenac', '$tipo'); ";

			$exec = odbc_exec($conn, $query);
			
			if($exec){
				$msg = "1";
			}else{
				$msg = "0";
			}
			header ("Location: users.php?response=$msg");
			
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Novo Usuário</title>
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
					<input type="text" name="name" id="name" placeholder="Nome">
				</li>
				<li>
					<div class="icon-form">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</div>
					<input type="email" name="email" id="email" placeholder="E-mail">
				</li>
				<li>
					<div class="icon-form">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</div>
					<input type="password" name="senha" id="senha" placeholder="Senha">
				</li>
				<li>
					<div class="icon-form">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</div>
					<input type="text" name="idSenac" id="idSenac" placeholder="Id Senac">
				</li>
			</ul>
			<fieldset class="user_add">
				<input type="radio" class='rad1' name="tipo" id="tipo" value="A" checked>A
			</fieldset>
			<fieldset class="user_add">
				<input type="radio" class='rad1' name="tipo" id="tipo" value="P">P
			</fieldset>
			<button type="submit" name="new_user">Salvar</button>
		</form>
	</div>
</body>
</html>