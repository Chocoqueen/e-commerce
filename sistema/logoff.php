<?php
session_start();
unset($_SESSION['usuario']); // Remove o usuário da sessão
session_destroy(); // Destrói a sessão
header('Location: ../index.php'); // Redireciona para a página de login
exit;
?>
