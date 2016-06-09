<?php
if (!isset($_SESSION['showMenu'])) {
	header('Location: index.php');
}

 if ($_SESSION['showMenu'] == true) {?>

<nav>
	<ul>
		<li><a href="users.php">Usu&aacute;rios</a></li>
		<li><a href="area.php">&Aacute;rea</a></li>
		<li><a href="assunto.php">Assunto</a></li>
		<li><a href="tipo_questao.php">Tipo Quest&atilde;o</a></li>
		<li><i class="fa fa-sign-out" aria-hidden="true"></i><a href="logout.php"> Sair</a></li>
	</ul>
</nav>

<?php } ?>