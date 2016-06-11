<?php
	session_start();
	include 'db.php';
	if($_SESSION['typeProfessor'] != 'A'){
		header('Location: tipo_questao.php');
	}

	if(!isset($_GET['cod'])){
		header('Location: tipo_questao.php');
	}else{
		$cod = $_GET['cod'];
		
	}
	
	if(isset($_POST['update_tipo_questao'])){
		$description = $_POST['description'];
		
		if (empty($description)) {
			
			$msg = "";
		}else{
			
			$query = odbc_prepare($conn, "UPDATE TipoQuestao set codTipoQuestao=?, descricao=? where codTipoQuestao=? ");
			$exec = odbc_execute($query, array($cod, $description, $cod));

			if($exec){
				$msg = "1";
			}else{
				$msg = "0";
			}
			//header ("Location: tipo_questao.php?response=$msg");	
		}
	}
	$stmt = odbc_exec($conn, "select codTipoQuestao, descricao from TipoQuestao where codTipoQuestao = '$cod'");
	
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
				<?php while($tipo_questao = odbc_fetch_array($stmt)){ ?>
				<li>
					<div class="icon-form">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</div>
					<input type="text" placeholder="descri&ccedil;&atilde;o" name='description' value='<?php echo $tipo_questao["descricao"]; ?>'></input>
				</li>
				<li>
					<div class="icon-form">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</div>
					<input type="text" name="cod_tipo_questao" placeholder="Tipo" value='<?php echo $tipo_questao["codTipoQuestao"]; ?>'>
				</li>
				<?php } ?>
				<button type="submit" name="update_tipo_questao">Salvar</button>			
			</ul>
		</form>
	</div>
</div>
</body>
</html>