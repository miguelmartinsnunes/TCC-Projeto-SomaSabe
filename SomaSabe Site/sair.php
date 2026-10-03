<?php
require("ses_start.php");

// 1. Limpa todas as variáveis da sessão
$_SESSION = array();

// 2. Destrói a sessão no servidor
session_destroy();

// 3. Redireciona e encerra
header("Location: Soma_Sabe.html");
exit;
?>