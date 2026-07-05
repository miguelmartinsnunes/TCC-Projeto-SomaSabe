<?php
	$session=session_start();
	if (!$session) {
		die("Não foi possível recuperar a sessão. ");
	}
	if(!isset($_SESSION['nomeUsuario'])){
		ob_clean();
		header("location: login_Soma_Sabe.php");
		exit;
	}
?>