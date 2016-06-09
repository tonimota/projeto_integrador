<?php
	session_start();
	include 'db.php';

	if(!isset($_GET['cod'])){
		header('Location: tipo_questao.php');
	}else{
		$cod = $_GET['cod'];
		$description = $_GET['description'];
	}
	
	if(isset($_POST['update_tipo_questao'])){
		$description = $_POST['description'];
		
		if (empty($description)) {
			
			$error = "<br><br><br><br><br><br>Erro ao Inserir dados";
			print_r($error);
		}else{
			
			$query = odbc_prepare($conn, "UPDATE TipoQuestao set descricao=? where codTipoQuestao=? ");
			$exec = odbc_execute($query, array($description, $cod));
			echo odbc_errormsg($conn);
			if($exec){
				$mensag = "<br><br><br><br><br><br>Você alterou com sucesso<br>";
			}else{
				$mensag = '<br><br><br><br><br><br>Erro<br>';
			}
			
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
</head>
<body>
	<header>
		<?php include 'menu.php'; ?>
	</header>
<div id='up-form'>
	<div id="element_to_pop_up">
		<form id="update_tipo_questao" name='frmUpdate' method='post' action=''>
			<h3>Preencha os campos</h3>
			<ul>
				<li>
					<div class="icon-form">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</div>
					<input type="text" placeholder="Descricao" name='description' value='<?php echo $description; ?>'></input>
				</li>
				<button type="submit" name="update_tipo_questao">Salvar</button>			
			</ul>
		</form>
	</div>
</div>
</body>
</html>