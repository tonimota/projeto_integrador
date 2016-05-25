<?php

session_start();
include 'db.php';

if(isset($_POST['new_area'])) {

	$description = $_POST['description'];

	if (empty($description)) {

		$error = "<br><br><br><br><br><br>Erro ao Inserir dados";
		print_r($error);

	} else {
		$query = " INSERT INTO Area (descricao) VALUES ('$description'); ";

		$od = odbc_exec($conn, $query);
		$mensag = "<br><br><br><br><br><br>Você inseriu com sucesso<br>";
		print_r($mensag);
	}
}
?>

<html>
<head>
	<title>Nova Area</title>
	<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
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
			<button type="submit" name="new_area">Salvar</button>
		</form>
	</div>
</body>
</html>