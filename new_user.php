<?php

session_start();
include 'db.php';

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

		$od = odbc_exec($conn, $query);
		$mensag = "<br><br><br><br><br><br>Você inseriu com sucesso<br>";
		print_r($mensag);
	}
}
?>

<html>
<head>
	<title>Novo Usuário</title>
	<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
</head>
<body>
<header>
			<?php if ($_SESSION['showMenu'] == true) {?>
			<nav>
				<ul>
					<li><a href="">Inicio</a></li>
					<li><a href="">Cadastrar</a></li>
					<li><a href="">Usuários</a></li>
					<li><i class="fa fa-sign-out" aria-hidden="true"></i><a href="logout.php"> Sair</a></li>
					<li><a href="new_user.php">Inserir Usuário</a></li>
				</ul>
			</nav>
			<?php }else{
				echo 'sem menu';
			}?>
		</header>
<div id="new_user">
	<form method="POST" action='' name='frmUser'>
		<input type="text" name="name" id="name" placeholder="name">
		<input type="email" name="email" id="email" placeholder="e-mail">
		<input type="password" name="senha" id="senha" placeholder="senha">
		<input type="text" name="idSenac" id="idSenac" placeholder="idSenac">
		<labe>A</label<input type="radio" name="tipo" id="tipo" value="A" checked>
		<input type="radio" name="tipo" id="tipo" value="P">
		<button type="submit" name="new_user">Salvar</button>
	</form>
</div>
</body>
</html>