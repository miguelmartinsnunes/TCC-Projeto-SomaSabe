<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
	</head>
	<body>
		<?php
			$emailDigitado=$_POST['emailUsuario'];
			$senhaDigitada=$_POST['senha'];
			if (empty($emailDigitado)) {
				die("Preencha o email.");
			}
			if (empty($senhaDigitada)) {
				die("Preencha a senha.");
			}
			require("BDconnecta.php");		
			$sql = "SELECT s.senha, s.nomeUsuario, e.emailUsuario 
					FROM SomaSabe s
					INNER JOIN SomaSabeEmail e ON s.nomeUsuario = e.nomeUsuario
					WHERE e.emailUsuario = ?";

					//o somaSabe "s" e a SomaSabeEmail "e", serve para dizer que a tabela SomaSabe vai ser chamada de "s" e a tabela SomaSabeEmail vai ser chamada de "e"
					//ai eu pego s.senha, s.nomeUsuario, e.emailUsuario, que são as colunas que eu quero pegar do banco de dados e sendo essas letras com ponto o nome de cada tabela
			
			$stmt = mysqli_prepare($BDconn, $sql);
			if (!$stmt) {
				die("Não foi possível preparar a consulta no BD. Error: " . mysqli_error($BDconn));
			}
			
			// Vincula o email digitado ao "?" da consulta SQL
			mysqli_stmt_bind_param($stmt, "s", $emailDigitado);
			
			$exec = mysqli_stmt_execute($stmt);
			if (!$exec) {
				die("Não foi possível executar consulta no BD. ");
			}
			
			// Vincula as colunas retornadas do banco às variáveis do PHP
			$result = mysqli_stmt_bind_result($stmt, $senha, $nomeUsuario, $emailUsuario);
			if (!$result) {
				die("Não foi possível recuperar dados do BD. ");
			}
			
			$linhaBD = mysqli_stmt_fetch($stmt);
			if (!$linhaBD) {
				die("Não foi possível localizar o Email no banco de dados. ");
			}
			require("cryp2graph2.php");
			if ( checasenha($senhaDigitada,$senha) ) {
				$session=session_start();
				if (!$session) {
					die("Não possível iniciar a sessão. ");
				}
				$_SESSION['nomeUsuario']=$nomeUsuario;
				$_SESSION['emailUsuario']=$emailUsuario;
				ob_clean();
				header("Location: resultado.php");
			} else {
				echo("Combinação de Nome de Usuário/Senha não localizado! ");
			}
		?>
	</body>
</html>