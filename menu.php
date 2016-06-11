<?php
include('integracao/loginFunc.php');
lidaBasicAuthentication ('../../portal/naoautorizado.php');
if(!isset($_SESSION['codProfessor'])){
	header('Location: index.php');
}
if (isset($_SESSION['showMenu']) && $_SESSION['showMenu']) {?>

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