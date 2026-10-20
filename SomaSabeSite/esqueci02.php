<?php
    require("BDconnecta.php");
    $nomeDigitado = trim($_POST['nomeUsuario'] ?? '');

    if (empty($nomeDigitado)) {
        echo "
            <script>
                alert('Por favor, preencha o campo nome!');
                window.location.href = 'esqueci01.php';    
            </script>
            ";
            exit;
        }
    $sql = "SELECT emailUsuario FROM SomaSabeEmail WHERE nomeUsuario = ?";
    $stmt = mysqli_prepare($BDconn, $sql);
    if (!$stmt) {
		echo "
			<script>
    			alert('Não foi possível preparar a consulta no BD');
    			window.location.href = 'esqueci01.php';
			</script>
		";
		exit;
    }
    mysqli_stmt_bind_param($stmt, "s", $nomeDigitado);
    $exec = mysqli_stmt_execute($stmt);
    if (!$exec) {
        echo "
            <script>
                alert('Não foi possível executar consulta no BD.');
                window.location.href = 'esqueci01.php';
            </script>
        ";
        exit;
    }
    $result = mysqli_stmt_get_result($stmt);
    if (!$result) {
        echo "
            <script>
                alert('Não foi possível obter o resultado da consulta no BD.');
                window.location.href = 'esqueci01.php';
            </script>
        ";
        exit;
    }
    $linhaBD = mysqli_fetch_assoc($result);
	if (!$linhaBD) {
		echo"
			<script>
				alert('Nome de utilizador não localizado.');
				window.location.href = 'esqueci01.php';
			</script>
		";
		exit;
	}


    $emailPessoa = $linhaBD['emailUsuario'];

    require("cryp2graph2.php");

    mysqli_stmt_free_result($stmt);
    $novaSenhaTexto = CriaAlgo(8);
    $novaSenhaCripto = FazSenha($nomeDigitado, $novaSenhaTexto);


    $sqlUpdate = "UPDATE SomaSabe SET senha = ?, tipoSenha = ? WHERE nomeUsuario = ?";
    $stmtUpdate = mysqli_prepare($BDconn, $sqlUpdate);
    $tipoSenha = "S";
    if(!$stmtUpdate){
        die("Erro na preparação da consulta");
    }
    $bindParam=mysqli_stmt_bind_param($stmtUpdate, "sss", $novaSenhaCripto, $tipoSenha, $nomeDigitado);
    if(!$bindParam){
        echo("nao foi possivel fazer a acão!");
        exit;
    }
    $stmtExecuteSenha=mysqli_stmt_execute($stmtUpdate);
    if(!$stmtExecuteSenha){
        echo("nao foi possivel realizar a ação!");
        exit;
    }
    require('email.php');
    $assunto = "Recuperacao de Senha";
    $mensagem = "Ola!<br>Sua nova senha de acesso e: <b>" . $novaSenhaTexto . "</b>";
    $enviado = mandarEmail("Usuario", $emailPessoa, $assunto, $mensagem);
    if ($enviado) {
    echo "<script>
				alert('Uma nova senha foi gerada e enviada para: " . $emailPessoa . "');
				window.location.href = 'login_Soma_Sabe.php';
			</script>
        ";
    } else {
        echo "<script>
				alert('Sua nova senha foi gerada, mas houve um erro no envio do e-mail.');
				window.location.href = 'login_Soma_Sabe.php';
			</script>
        ";
        exit;
    }
?>