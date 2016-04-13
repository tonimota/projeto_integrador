<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
</head>
<body>
<div id="container">
	<form method="post" action="login.php">
		<div id="thumb">
			<img src="img/default_large.png">			
		</div>
		<input type="text" name="name" value="Nome">
		<input type="password" name="password" value="Senha">
		<fieldset>
			<button class="myButton" type="submit" name="btn_send"> Entrar </button> 
		</fieldset>
		<fieldset>
			<button class="myButton" type="submit" name="btn_new"> Cadastre-se </button> 
		</fieldset>
	</form>
</div>
</body>
</html>