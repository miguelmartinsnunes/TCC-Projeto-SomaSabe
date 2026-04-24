<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
	</head>
	<body>
		<?php
			$email=$_POST['email'];
			$senhaDigitada=$_POST['senhaUsuario'];
			if (empty($email)) {
				die("Preencha o email.");
			}
			if (empty($senhaDigitada)) {
				die("Preencha a senha.");
			}
			require("BDconnecta.php");		
			$sql ="select nomeUsuario, senha from SomaSabe";
			$sql.="		where ";
			$sql.="			email = ? ";
			$stmt=mysqli_prepare($BDconn, $sql);
			if (!$stmt) {
				die("Não foi possível preparar a consulta no BD. ");
			}
			$param=mysqli_stmt_bind_param($stmt, "s", $email);
			if (!$param) {
				die("Não foi possível vincular parâmetro da consulta no BD. ");
			}
			$exec=mysqli_stmt_execute($stmt);
			if (!$exec) {
				die("Não foi possível executar consulta no BD. ");
			}
			$result=mysqli_stmt_bind_result($stmt,$nomeUsuario,$senha);
			if (!$result) {
				die("Não foi possível recuperar dados do BD. ");
			}
			$linhaBD=mysqli_stmt_fetch($stmt);
			if (!$linhaBD) {
				die("Não foi possível localizar CPF no banco de dados. ");
			}
			require("cryp2graph2.php");
			if ( checasenha($senhaDigitada,$senha) ) {
				$session=session_start();
				if (!$session) {
					die("Não possível iniciar a sessão. ");
				}
				$_SESSION['email']=$email;
				$_SESSION['nomeUsuario']=$nomeUsuario;
				ob_clean();
				header("Location: resultado.php");
			} else {
				echo("Combinação de CPF/Senha não localizado! ");
			}
		?>
	</body>
</html>