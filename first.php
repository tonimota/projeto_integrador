<?php
	session_start();
	if (!isset($_SESSION['showMenu'])) {
		header('Location: index.php');
	}

	include 'db.php';
	include 'crud_functions.php';

//CONSULTAS DB
	// SELECT
 	$result = select("select * from Professor", $conn);
	
	
	

	
?>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="style_popup.css">
<script type="text/javascript" src="jquery-2.2.3.js"></script>
<script type="text/javascript" src="script-popup.js"></script>
</head>
<body>
	<header>
		<?php if ($_SESSION['showMenu'] == true) {?>
		<nav>
			<ul>
				<li><a href="">Inicio</a></li>
				<li><a href="">Usuários</a></li>
				<li><i class="fa fa-sign-out" aria-hidden="true"></i><a href="logout.php"> Sair</a></li>
				<li><a href="new_user.php">Inserir Usuário</a></li>
			</ul>
		</nav>
		<?php }else{
			echo 'sem menu';
		}?>
	</header>

	<div id="element_to_pop_up">
	<a class="b-close">x</a>
		<form id="update_user">
			<h3>Preencha os campos</h3>
			<ul>
				<li>
					<div class="icon-form">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					</div>
					<input type="text" placeholder="Nome"></input>
				</li>
				<li>
					<div class="icon-form">
						<i class="fa fa fa-envelope" aria-hidden="true"></i>
					</div>
					<input type="email" placeholder="E-mail"></input>
				</li>
				<li id="button-contact-form">
					<button class="submit" type="submit">Enviar</button>
				</li>			
			</ul>
		</form>
	</div>

	<div id='wrapper'>
		<div class='table-holder'>
			<table>
				<tr>
					<th>Nome</th>
					<th>E-mail</th>
					<th>Tipo</th>
					<th>Alterar</th>
					<th>Excluir</th>
				<tr>
			<?php
				while($area = odbc_fetch_array($stmt)){
					echo ("<tr><td>".$area['nome']."</td>"."<td>".$area['email']."</td>"."<td>".$area['tipo']."</td>"."<td>"."<button class='my-button2' value='Alterar'></button>"."<td>"."<p> <a href='#'>Excluir</a></p>"."</td>"."</tr>");
				}					
			?>
			</table>
		</div>
	</div>
	<footer>			
	</footer>
</body>
</html>