<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Caminho para o arquivo JSON onde os dados de login estão armazenados
    $json_file = 'sistema/data/usuarios.json';
    
    // Lê o arquivo JSON existente
    $usuarios = file_exists($json_file) ? json_decode(file_get_contents($json_file), true) : [];
    
    // Verifica se o usuário existe e se a senha está correta
    $usuarioEncontrado = false;
    foreach ($usuarios as $usuario) {
        if (strtolower($usuario['username']) === strtolower($_POST['username']) && password_verify($_POST['password'], $usuario['password'])) {
            $usuarioEncontrado = true;
            break;
        }
    }

    if ($usuarioEncontrado) {
        // Usuário autenticado com sucesso
        // Inicie uma sessão ou redirecione para a página protegida
        session_start();
        $_SESSION['usuario'] = $_POST['username'];
        // Obtém a permissão do usuário
        $permissao = $usuario['permissao'];
        // Redireciona para a página correspondente à permissão
        switch ($permissao) {
            case 'Administrador':
                header('Location: sistema/inicio-adm.php');
                break;
            case 'Usuário':
                header('Location: sistema/inicio.php');
                break;
            default:
                header('Location: index.php?erro=login');
        }
        exit;
    } else {
        // Usuário ou senha inválidos
        // Redirecione de volta para a página de login com uma mensagem de erro
        header('Location: login.php?erro=login');
        exit;
    }    
}
?>