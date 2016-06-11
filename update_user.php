<?php
	session_start();
	include 'db.php';
	if($_SESSION['typeProfessor'] != 'A'){
		header('Location: users.php');
	}

	if(!isset($_GET['cod'])){
		header('Location: users.php');
	}else{
		$cod = $_GET['cod'];
		$stmt = odbc_exec($conn, "select * from Professor where codProfessor = $cod");
	}
	
	if(isset($_POST['update_user'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$type = $_POST['type'];
		$senac_id = $_POST['senac_id'];
		
		if (empty($name) or empty($email) or empty($type)) {
			
			$error = "<br><br><br><br><br><br>Preencha o(s) campo(s)";
			print_r($error);
		}else{
			
			$query = odbc_prepare($conn, "UPDATE Professor set nome=?, email=?, idSenac=?, tipo=? where codProfessor=? ");
			$exec = odbc_execute($query, array($name, $email, $senac_id, $type, $cod));
			echo odbc_errormsg($conn);
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
	<title>Editar</title>
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
<div id='up-form'>
	<div id="element_to_pop_up">
		<form id="update_user" name='frmUpdate' method='post' action=''>
			<h3>Preencha os campos</h3>
			
			<ul>
			<?php while($user = odbc_fetch_array($stmt)){?>
				<li>
					<div class="icon-form">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</div>
					<input type="text" placeholder="Nome" name='name' value='<?php echo $user['nome']; ?>'></input>
				</li>
				<li>
					<div class="icon-form">
						<i class="fa fa fa-envelope" aria-hidden="true"></i>
					</div>
					<input type="email" placeholder="E-mail" name='email' value='<?php echo $user['email']; ?>'></input>
				</li>
				<li>
					<div class="icon-form">
						<i class="fa fa fa-hashtag" aria-hidden="true"></i>
					</div>
					<input type="text" placeholder="ID Senac" name='senac_id' value='<?php echo $user['idSenac']; ?>'></input>
				</li>
				<?php if($_SESSION['typeProfessor'] == 'A'){?>
				<li id="button-contact-form_2">
					<?php if($user['tipo'] == 'A'){?>
						<input type="radio" name='type' class="tipo_up" value="A" checked>
						<label for="check1">A</label>
						
						<input type="radio" name='type' class="tipo_up" value="P">
						<label for="check1">P</label>
					<?php }else{?>
						<input type="radio" name='type' class="tipo_up" value="A">
						<label for="check1">A</label>
					
						<input type="radio" name='type' class="tipo_up" value="P" checked>
						<label for="check1">P</label>
					<?php } ?>
				</li>
				<?php } ?>
			<?php } ?>
				<button type="submit" name="update_user">Salvar</button>			
			</ul>
			
		</form>
	</div>
</div>
</body>
</html>