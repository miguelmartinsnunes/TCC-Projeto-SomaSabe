<?php
require("BDconnecta.php");

// 1. Receber e limpar dados do formulário
$nomeDigitado = trim($_POST['nomeUsuario'] ?? '');
$emailDigitado = trim($_POST['emailUsuario'] ?? '');
$senhaDigitada = $_POST['senha'] ?? '';

// 2. Validar preenchimento de todos os campos
if (empty($nomeDigitado) || empty($emailDigitado) || empty($senhaDigitada)) {
    echo "
        <script>
            alert('Por favor, preencha todos os campos (nome, e-mail e senha).');
            window.location.href = 'criarConta.php';    
        </script>
    ";
    exit;
}

// 3. Validar formato do e-mail
if (!filter_var($emailDigitado, FILTER_VALIDATE_EMAIL)) {
    echo "
        <script>
            alert('Por favor, insira um e-mail válido.');
            window.location.href = 'criarConta.php';
        </script>
    ";
    exit;
}

// 4. Verificar se o Nome de Utilizador já existe
$sqlCheckUser = "SELECT nomeUsuario FROM SomaSabe WHERE nomeUsuario = ?";
$stmtCheckUser = mysqli_prepare($BDconn, $sqlCheckUser);

if ($stmtCheckUser) {
    mysqli_stmt_bind_param($stmtCheckUser, "s", $nomeDigitado);
    mysqli_stmt_execute($stmtCheckUser);
    mysqli_stmt_store_result($stmtCheckUser);

    if (mysqli_stmt_num_rows($stmtCheckUser) > 0) {
        echo "
            <script>
                alert('Este nome de utilizador já está em uso. Escolha outro.');
                window.location.href = 'criarConta.php';
            </script>
        ";
        exit;
    }
    mysqli_stmt_close($stmtCheckUser);
}

// 5. Verificar se o E-mail já está em uso
$sqlCheckEmail = "SELECT emailUsuario FROM SomaSabeEmail WHERE emailUsuario = ?";
$stmtCheckEmail = mysqli_prepare($BDconn, $sqlCheckEmail);

if ($stmtCheckEmail) {
    mysqli_stmt_bind_param($stmtCheckEmail, "s", $emailDigitado);
    mysqli_stmt_execute($stmtCheckEmail);
    mysqli_stmt_store_result($stmtCheckEmail);

    if (mysqli_stmt_num_rows($stmtCheckEmail) > 0) {
        echo "
            <script>
                alert('Este e-mail já está registado em outra conta.');
                window.location.href = 'criarConta.php';
            </script>
        ";
        exit;
    }
    mysqli_stmt_close($stmtCheckEmail);
}

// 6. Iniciar Transação (Garante que ou insere em ambas as tabelas ou cancela tudo)
mysqli_begin_transaction($BDconn);

try {
    require("cryp2graph2.php");
    $senhaCrypto = FazSenha($nomeDigitado, $senhaDigitada);

    // Inserir Utilizador e Senha
    $sqlUser = "INSERT INTO SomaSabe (nomeUsuario, senha) VALUES (?, ?)";
    $stmtUser = mysqli_prepare($BDconn, $sqlUser);
    mysqli_stmt_bind_param($stmtUser, "ss", $nomeDigitado, $senhaCrypto);
    mysqli_stmt_execute($stmtUser);
    mysqli_stmt_close($stmtUser);

    // Inserir E-mail do Utilizador
    $sqlEmail = "INSERT INTO SomaSabeEmail (nomeUsuario, emailUsuario) VALUES (?, ?)";
    $stmtEmail = mysqli_prepare($BDconn, $sqlEmail);
    mysqli_stmt_bind_param($stmtEmail, "ss", $nomeDigitado, $emailDigitado);
    mysqli_stmt_execute($stmtEmail);
    mysqli_stmt_close($stmtEmail);

    // Confirmar alterações na banco de dados
    mysqli_commit($BDconn);

    echo "
        <script>
            alert('Registo realizado com sucesso!');
            window.location.href = 'login_Soma_Sabe.php';
        </script>
    ";
} catch (Exception $e) {
    // Em caso de erro, reverte todas as operações
    mysqli_rollback($BDconn);
    echo "
        <script>
            alert('Não foi possível concluir o registo. Tente novamente.');
            window.location.href = 'criarConta.php';
        </script>
    ";
}
?>