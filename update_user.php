<?php
	session_start();
	include 'db.php';
	if (!isset($_SESSION['showMenu'])) {
		header('Location: index.php');
	}

	if(!isset($_GET['cod'])){
		header('Location: users.php');
	}else{
		$cod = $_GET['cod'];
		$name = $_GET['nome'];
		$email = $_GET['email'];
		$type = $_GET['tipo'];
		$senac_id = $_GET['senac_id'];
	}
	
	if(isset($_POST['update_user'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$type = $_POST['type'];
		$senac_id = $_POST['senac_id'];
		
		if (empty($name) or empty($email) or empty($type)) {
			
			$error = "<br><br><br><br><br><br>Erro ao Inserir dados";
			print_r($error);
		}else{
			
			$query = odbc_prepare($conn, "UPDATE Professor set nome=?, email=?, idSenac=?, tipo=? where codProfessor=? ");
			$exec = odbc_execute($query, array($name, $email, $senac_id, $type, $cod));
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
		<?php if ($_SESSION['showMenu'] == true) {?>

			<ul>
				<li><a href="users.php">Usuários</a></li>
				<li><a href="new_user.php">Inserir Usuário</a></li>
				<li><i class="fa fa-sign-out" aria-hidden="true"></i><a href="logout.php"> Sair</a></li>
			</ul>

		<?php }else{
			echo 'sem menu';
		}?>
	</header>
<div id='up-form'>
	<div id="element_to_pop_up">
		<form id="update_user" name='frmUpdate' method='post' action=''>
			<h3>Preencha os campos</h3>
			<ul>
				<li>
					<div class="icon-form">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</div>
					<input type="text" placeholder="Nome" name='name' value='<?php echo $name; ?>'></input>
				</li>
				<li>
					<div class="icon-form">
						<i class="fa fa fa-envelope" aria-hidden="true"></i>
					</div>
					<input type="email" placeholder="E-mail" name='email' value='<?php echo $email; ?>'></input>
				</li>
				<li>
					<div class="icon-form">
						<i class="fa fa fa-envelope" aria-hidden="true"></i>
					</div>
					<input type="text" placeholder="ID Senac" name='senac_id' value='<?php echo $senac_id; ?>'></input>
				</li>
				<li id="button-contact-form_2">
				<input type="radio" name='update_user' class="tipo_up" value="A" checked>
						<label for="check1">A</label>
						<input type="radio" name='update_user' class="tipo_up" value="P">
						<label for="check1">P</label>
				</li>
				<button type="submit" name="update_user">Salvar</button>			
			</ul>
		</form>
	</div>
</div>
</body>
</html>