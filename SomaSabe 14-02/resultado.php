<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
    </head>
    <body>
        <a href="sair.php">SAIR</a><br>
		<hr>
		<?php
			require("sessao.php");
			$senha=$_SESSION['senhaUsuario'];
			$nomeUsuario=$_SESSION['nomeUsuario'];
			$email=$_SESSION['email'];
			// 1 registro
			echo("Nome: $nomeUsuario<br>");
			echo("Email: $email<br>");
		?>
    </body>
</html>