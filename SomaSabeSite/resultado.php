<?php
require("ses_start.php");
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="Img/icone1.ico">
        <title>Menu Soma Sabe</title>
        <Style>
            .iconePagina{
                width: 13%;
                height: 12%;
                position: absolute;
                left: 4%;
                top: 2%;
            }
        </Style>
    </head>
    <body>
        <img src="Img/icone2.png" class="iconePagina">
        <a href="sair.php">SAIR</a><br>
		<hr>
		<?php
			
			$nomeUsuario=$_SESSION['nomeUsuario'];
			$emailUsuario=$_SESSION['emailUsuario'];
			// 1 registro
			echo("Nome: $nomeUsuario<br>");
			echo("Email: $emailUsuario<br>");
		?>
    </body>
</html>