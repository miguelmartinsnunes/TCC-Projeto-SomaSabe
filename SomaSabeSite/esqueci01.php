<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="Img/icone1.ico">
        <title>Recuperação de conta</title>
        <style>
        body{
            background-color: #ffffff;
        }
        .iconePagina{
            width: 13%;
            height: 12%;
            position: absolute;
            left: 4%;
            top: 2%;
        }
        .esqueciSenha{
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
            top: 25%;
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
            top: 40%;
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
        @media (max-width: 900px){

            /* Página: um item embaixo do outro, no centro da tela  */
            body{
                margin: 0;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
            }

            /*  Logo */
            .iconePagina{
                position: static;
                width: 180px;
                height: auto;
                margin: 8px 0 0 0;
                margin-top: -40px;

            }

            /*  Caixa de criar conta  */
            #esqueci{
                width: 90%;
                max-width: 420px;
                margin-top: 40px;
            }
            .esqueciSenha{
                position: static;
                transform: none;
                width: 100%;
                height: auto;
            }
            .esqueciSenha br{
                display: none;
            }

            /*  Textos e campos: um embaixo do outro  */
            #nomeUsuario{
                position: static;
                display: block;
                text-align: left;
            }
            .nomeUsuario{
                position: static;
                display: block;
                width: 100%;
                height: 44px;
                padding: 0 12px;
                box-sizing: border-box;
            }

            /*  Botão  */
            .submit{
                position: static;
                width: 100%;
                height: 48px;
                margin-top: 26px;
                font-size: 16px;
            }
        }
        @media (max-width: 480px){
            .iconePagina{
                width: 130px;
            }
        }
        </style>
    </head>
    <body>
        <img src="Img/icone2.png" class="iconePagina">
        <form id="esqueci" action="esqueci02.php" method="post">
            <div class="esqueciSenha">
                <label id="nomeUsuario"><h2>Digite Seu Nome</h2></label><br>
                <input type="text" class="nomeUsuario" name="nomeUsuario" placeholder="Ex:SomaSabe" required><br>
                <button type="submit" class="submit">
                    Enviar
                </button>
            </div>
        </form>
    </body>
</html>