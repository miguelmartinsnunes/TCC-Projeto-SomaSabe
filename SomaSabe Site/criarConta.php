<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="icone1.ico">
        <title>inscrever-se</title>
        <script>
        // Largura da viewport
        console.log(window.innerWidth);

        // Altura da viewport
        console.log(window.innerHeight);

    </script>
    <style>
        body{
            background-color: #ffffff;
        }
        .iconePagina{
            width: 16%;
            height: 15%;
            position: absolute;
            left: 4%;
            top: 2%;
        }
        .campoCriarConta{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 40%;
            height: 70%;
            text-align: center;
        }
        
        #nomeUsuario{
            position: absolute;
            top: -6%;
            left:25%;
        }
        .nomeUsuario{
            background-color: #f1f1f1;
            border: none;
            width: 50%;
            height: 10%;
            border-radius: 5px;
            position: absolute;
            left: 25%;
            top: 9%;
        }
        .email{
            background-color: #f1f1f1;
            border: none;
            width: 50%;
            height: 10%;
            border-radius: 5px;
            position: absolute;
            left: 25%;
            top: 35%;
        }
        #email{
            position: absolute;
            top: 21%;
            left: 25%;
        }
        .senha{
            background-color: #f1f1f1;
            border: none;
            width: 50%;
            height: 10%;
            border-radius: 5px;
            position: absolute;
            left: 25%;
            top: 61%;
        }
        #senha{
            position: absolute;
            top: 47%;
            left: 25%;    
        }
        .submit{
            position: absolute;
            bottom: 7%;
            left: 25%;
            width: 50%;
            height: 10%;
            background-color: green;
            border: none;
            border-radius: 25px;
            color: white;
            text-decoration: none;
            font-size: 80%;
            text-align: center;
        }
        .submit:hover{
            background-color: darkgreen;
        }
        
    </style>
    </head>
    <body>
        <img src="icone2.png" class="iconePagina">
        <form id="conta" action="conexãoCriarConta.php" method="post">
            <div class="campoCriarConta">
                <label id="nomeUsuario"><h2>Crie Seu Nome</h2></label><br>
                <input type="text" class="nomeUsuario" name="nomeUsuario" placeholder="Ex:SomaSabe" required><br>
                <label id="email"><h2>Crie Seu E-mail</h2></label><br>
                <input type="email" class="email" name="emailUsuario" placeholder="Ex:SomaSabe@gmail.com" required><br>
                <label id="senha"><h2>Crie Sua Senha</h2></label><br>
                <input type="password" class="senha" name="senha" placeholder="Ex:Som@Sab&1324" required>
                <a>
                    <button class="submit">
                        criar conta
                    </button>
                </a>
            </div>
        </form>
    </body>
</html>