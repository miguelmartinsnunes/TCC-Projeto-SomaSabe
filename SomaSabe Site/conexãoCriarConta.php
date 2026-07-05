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
        <title>CriarConta</title>
    </head>
    <body>
        <?php
            $nomeDigitado=$_POST['nomeUsuario'];
			$senhaDigitada=$_POST['senha'];
            if (empty($nomeDigitado)) {
				echo"
					<script>
						alert('Preencha o nome.');
						window.location.href = 'criarConta.php';
					</script>
				";
				exit;
			}
			if (empty($senhaDigitada)) {
				echo"
					<script>
						alert('Preencha a senha.');
						window.location.href = 'criarConta.php';
					</script>
				";
				exit;
			}
			require("BDconnecta.php");
            // Verifica se o usuário já existe
            $sqlCheck = "SELECT nomeUsuario FROM SomaSabe WHERE nomeUsuario = ?";
            $stmtCheck = mysqli_prepare($BDconn, $sqlCheck);
            if (!$stmtCheck) {
                echo "
                    <script>
                        alert('Erro ao verificar usuário: " . mysqli_error($BDconn) . "');
                        window.location.href = 'criarConta.php';
                    </script>
                ";
                exit;
            }
            mysqli_stmt_bind_param($stmtCheck, "s", $nomeDigitado);
            mysqli_stmt_execute($stmtCheck);
            mysqli_stmt_store_result($stmtCheck);

            if (mysqli_stmt_num_rows($stmtCheck) > 0) {
                echo "
                    <script>
                        alert('Esse nome de usuário já está em uso. Escolha outro.');
                        window.location.href = 'criarConta.php';
                    </script>
                ";
                exit;
            }
            mysqli_stmt_close($stmtCheck);
            $sql=" insert into SomaSabe (nomeUsuario,senha) values (?,?) ";
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
            require("cryp2graph2.php");
            $senhaCrypto=FazSenha($nomeDigitado,$senhaDigitada);
            $param=mysqli_stmt_bind_param($stmt, "ss", $nomeDigitado, $senhaCrypto);
            if (!$param) {
                echo "
                    <script>
                        alert('Não consegui vincular parâmetro da consulta no BD');
                        window.location.href = 'login_Soma_Sabe.php';
                    </script>
                ";
                exit;
			}
			$exec=mysqli_stmt_execute($stmt);
			if (!$exec) {
                echo "
                    <script>
                        alert('Não consegui executar cadastro no BD');
                        window.location.href = 'login_Soma_Sabe.php';
                    </script>
                ";
                exit;
			}
            if (isset($_POST['emailUsuario'])) {

                $emailUsuario = $_POST['emailUsuario'];
				$sqlEmails=" insert into SomaSabeEmail (nomeUsuario, emailUsuario) values (?,?) ";
				$stmtEmails=mysqli_prepare($BDconn,$sqlEmails);
				if (!$stmtEmails) {
                    echo "
                        <script>
                            alert('Não consegui preparar o cadastro de emails no BD');
                            window.location.href = 'login_Soma_Sabe.php';
                        </script>
                    ";
                    exit;
				}
                $paramEmail = mysqli_stmt_bind_param($stmtEmails, "ss", $nomeDigitado, $emailUsuario);
				if (!$paramEmail) {
                    echo "
                        <script>
                           alert('Não consegui vincular parâmetro de emails no cadastro do BD');
                           window.location.href = 'login_Soma_Sabe.php';
                        </script>
                    "; 
                    exit;
				}
                $execEmail = mysqli_stmt_execute($stmtEmails);
                if (!$execEmail) {
                    echo "
                        <script>
                            alert('Não consegui executar o cadastro de email no BD');
                            window.location.href = 'login_Soma_Sabe.php';
                        </script>
                    ";
                    exit;
                }
			}
            echo "
                <script>
                    alert('cadastro realizado com sucesso!');
                    window.location.href = 'login_Soma_Sabe.php';
                </script>
                    ";
        ?>
    </body>
</html>