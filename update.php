<?php
	session_start();
	include 'db.php';
	if (!isset($_SESSION['showMenu'])) {
		header('Location: index.php');
	}

<<<<<<< HEAD
	if(!isset($_GET['cod'])){
		header('Location: first.php');
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
			
			$query = odbc_prepare($conn, "UPDATE TABLE Professor (nome, email, idSenac, tipo) VALUES (?, ?, ?, ?)");
			echo odbc_errormsg($query)
			odbc_execute($query, array($name, $email, $senac_id, $type));
			if(odbc_num_rows($query) > 0){
				$mensag = "<br><br><br><br><br><br>Você alterou com sucesso<br>";
			}else{
				echo 'erro';
			}
		
		}
	}
	
	

	//CONSULTA DB
	
	
=======
	include 'db.php';
>>>>>>> bb531ab385fc9cc5b58ee0771cb339fa67bc8e89
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
<<<<<<< HEAD
		
=======
		<nav>
			<ul>
				<li><a href="index.php">Inicio</a></li>
				<li><a href="first.php">Usuários</a></li>
				<li><a href="new_user.php">Inserir Usuário</a></li>
				<li><i class="fa fa-sign-out" aria-hidden="true"></i><a href="logout.php"> Sair</a></li>				
			</ul>
		</nav>
>>>>>>> bb531ab385fc9cc5b58ee0771cb339fa67bc8e89
		<?php }else{
			echo 'sem menu';
		}?>
	</header>
<div id='up-form'>
	<div id="element_to_pop_up">
	<a class="b-close">x</a>
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
				<li>
					<div class="icon-form">
						<i class="fa fa fa-envelope" aria-hidden="true"></i>
					</div>
					<input type="text" placeholder="Tipo" name='type' value='<?php echo $type; ?>'></input>
				</li>
				<li id="button-contact-form">
					<button class="submit" type="submit" name='update_user'>Enviar</button>
				</li>			
			</ul>
		</form>
	</div>
</div>
</body>
</html>