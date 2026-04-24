<?php
	$session=session_start();
	if (!$session) {
		die("Não foi possível recuperar a sessão. ");
	}
	if(!isset($_SESSION['CPFPessoa'])){
		ob_clean();
		header("location: login_Soma_Sabe.php");
	}
?>