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
				echo"
					<script>
						alert('Preencha o email.');
						window.location.href = 'login_Soma_Sabe.php';
					</script>
				";
				exit;
			}
			if (empty($senhaDigitada)) {
				echo"
					<script>
						alert('Preencha a senha.');
						window.location.href = 'login_Soma_Sabe.php';
					</script>
				";
				exit;
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
				echo "
					<script>
    					alert('Não foi possível preparar a consulta no BD. Error: " . mysqli_error($BDconn) . "');
    					window.location.href = 'login_Soma_Sabe.php';
					</script>
				";
				exit;
			}
			
			// Vincula o email digitado ao "?" da consulta SQL
			mysqli_stmt_bind_param($stmt, "s", $emailDigitado);
			
			$exec = mysqli_stmt_execute($stmt);
			if (!$exec) {
				echo"
					<script>
						alert('Não foi possível executar consulta no BD.');
						window.location.href = 'login_Soma_Sabe.php';
					</script>
				";
				exit;
			}
			
			// Vincula as colunas retornadas do banco às variáveis do PHP
			$result = mysqli_stmt_bind_result($stmt, $senha, $nomeUsuario, $emailUsuario);
			if (!$result) {
				echo"
					<script>
						alert('Não foi possível recuperar dados do BD.');
						window.location.href = 'login_Soma_Sabe.php';
					</script>
				";
				exit;
			}
			
			$linhaBD = mysqli_stmt_fetch($stmt);
			if (!$linhaBD) {
				echo"
					<script>
						alert('Combinação de Nome de Usuário/Senha não localizado.');
						window.location.href = 'login_Soma_Sabe.php';
					</script>
				";
				exit;
			}
			require("cryp2graph2.php");
			if ( checasenha($senhaDigitada,$senha) ) {
				$session=session_start();
				if (!$session) {
					echo"
						<script>
							alert('Não possível iniciar a sessão.');
							window.location.href = 'login_Soma_Sabe.php';
						</script>
					";
					exit;
				}
				$_SESSION['nomeUsuario']=$nomeUsuario;
				$_SESSION['emailUsuario']=$emailUsuario;
				ob_clean();
				header("Location: resultado.php");
			} else {
				echo"
					<script>
						alert('Combinação de Nome de Usuário/Senha não localizado!');
						window.location.href = 'login_Soma_Sabe.php';
					</script>
				";
				exit;
			}
		
		?>
	</body>
</html>