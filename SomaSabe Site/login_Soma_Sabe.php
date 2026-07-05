<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="icone1.ico">
    <title>login</title>
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
        .entrar{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 50px;
        }
        .campoDeLogin{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 40%;
            height: 70%;
            text-align: center;
        }
        #email{
            background-color: #f1f1f1;
            border: none;
            width: 50%;
            height: 10%;
            border-radius: 5px;
            position: absolute;
            left: 25%;
            top: 23%;
        }
        #senha{
            background-color: #f1f1f1;
            border: none;
            width: 50%;
            height: 10%;
            border-radius: 5px;
            position: absolute;
            left: 25%;
            top: 49%;
        }
        .email{
            position: absolute;
            top: 9%;
            left: 25%;
        }
        .senha{
            position: absolute;
            top: 35%;
            left: 25%;
        }
        #submit{
            position: absolute;
            bottom: 10%;
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
        .esqueci{
            position: absolute;
            left: 25%;
            top: 65%;
            color: black;
        }
        
    </style>
</head>
<body>
    <img src="icone2.png" class="iconePagina">
        <div class="campoDeLogin">
            <form id="formId" action="conexão.php" method="post">
                <label class="email"><h2>Email</h2></label><br>
                <input type="text" name="emailUsuario" id="email" placeholder="Ex:SomaSabe@gmail.com" required><br>
                <label class="senha"><h2>Senha</h2></label><br>
                <input type="password" name="senha" id="senha" placeholder="Ex:12$3$4" required>
                <a href="esqueceu_senha.html" class="esqueci">Esqueceu senha</a>
                <button id="submit" type="submit">Começar</button>
            </form>
        </div>
</body>
</html>