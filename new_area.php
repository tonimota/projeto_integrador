<?php

	session_start();
	include 'db.php';

	if(isset($_POST['new_area'])) {

		$description = $_POST['description'];

		if (empty($description)) {

			$error = "<br><br><br><br><br><br>Preecha a descricao";
			print_r($error);

		} else {
			$query = " INSERT INTO Area (descricao) VALUES ('$description'); ";

			$exec = odbc_exec($conn, $query);
			
			if($exec){
				$msg = "1";
			}else{
				$msg = "0";
			}
			header ("Location: area.php?response=$msg");
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
	<script type='text/javascript' src='jquery-2.2.3.js'></script>
	<script type='text/javascript' src='scripts.js'></script>
</head>
<body>
	<header>
		<?php include 'menu.php'; ?>
	</header>
	<div id="new_user">
		<form method="POST" action='' name='frmUser'>
			<input type="text" name="description" id="description" placeholder="Descricao">
			<button type="submit" name="new_area">Salvar</button>
		</form>
	</div>
</body>
</html>