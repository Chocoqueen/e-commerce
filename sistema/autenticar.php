<!-- Inicia a sessão -->

<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    // Se não estiver logado, redireciona para a tela de login
    header('Location: ../login.php');
    exit;
}
?>