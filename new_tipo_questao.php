<?php

	session_start();
	include 'db.php';

	if(isset($_POST['new_tipo_questao'])) {

		$description = $_POST['description'];
		$cod_tipo_questao = $_POST['cod_tipo_questao'];

		if (empty($description) || empty($cod_tipo_questao)) {

			$error = "<br><br><br><br><br><br>Preencha os campos";
			print_r($error);

		} else {
			$query = " INSERT INTO TipoQuestao (codTipoQuestao, descricao) VALUES ('$cod_tipo_questao', '$description')";

			$exec = odbc_exec($conn, $query);

			if($exec){
				$msg = "1";
			}else{
				$msg = "0";
			}
			header ("Location: tipo_questao.php?response=$msg");

		}
	}
?>

<html>
<head>
	<title>Novo Tipo de Questão</title>
	<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
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
			<input type="text" name="description" id="description" placeholder="Descricao">
			</li>
			<li>
				<div class="icon-form">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
				</div>
			<input type="text" name="cod_tipo_questao" id="cod_tipo_questao" placeholder="tipo questao">
			</li>
			<button type="submit" name="new_tipo_questao">Salvar</button>
		</ul>
		</form>
	</div>
	</div>
</body>
</html>