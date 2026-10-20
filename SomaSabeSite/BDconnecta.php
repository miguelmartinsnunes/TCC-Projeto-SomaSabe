<?php
	try {
		ini_set("display_errors","1");
		$BDconn=mysqli_connect("192.168.15.13","root","Raul2016","ServidorHeitor");
		if (!$BDconn) {
			die("Não foi possível conexão com o BD. ");
		}
		// Adiciona esta linha para permitir que o try...catch apanhe erros de SQL
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	} catch (Exception $e) {
		die("O servidor indicou um erro.");
	}
?>