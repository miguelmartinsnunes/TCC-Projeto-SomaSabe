<?php
	try {
		ini_set("display_errors","1");
		$BDconn=mysqli_connect("localhost","servidorweb","Kaiser251299","SomaSabe");
		if ($BDconn) {
			echo("Conexão com o BD realizada. ");
		} else {
			die("Não foi possível conexão com o BD. ");
		}
	} catch (Exception $e) {
		die("O servidor indicou o erro: ".$e->getMessage().".");
	}
?>