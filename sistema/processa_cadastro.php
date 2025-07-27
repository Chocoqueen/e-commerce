<?php
// Caminho para o arquivo JSON
$json_file = 'data/usuarios.json';

// Verifica se os dados do formulário foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
    $username = trim($_POST['username']);
	$mail = $_POST['mail'];
    $password = $_POST['password'];
    $permissao = $_POST['permissao'];

    // Validação básica
    if (empty($username) || empty($password) || empty($permissao)) {
        header("Location: cadastro.php?erro=1");
        exit;
    }

    // Lê os dados existentes do arquivo JSON
    if (file_exists($json_file)) {
        $usuarios = json_decode(file_get_contents($json_file), true);
    } else {
        $usuarios = [];
    }

    // Verifica se o nome de usuário já existe
    foreach ($usuarios as $usuario) {
        if ($usuario['username'] === $username) {
            // Redireciona com erro
            header("Location: cadastro.php?erro=1");
            exit;
        }
    }

    // Cria um novo usuário com senha criptografada
    $novo_usuario = [
        'username' => $username,
		'mail' => $mail,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'permissao' => $permissao
    ];

    // Adiciona ao array de usuários
    $usuarios[] = $novo_usuario;

    // Salva de volta no arquivo JSON
    if (file_put_contents($json_file, json_encode($usuarios, JSON_PRETTY_PRINT))) {
        // Redireciona para a página da tabela
        header("Location: cadastro_tabela.php");
        exit;
    } else {
        // Falha ao salvar
        header("Location: cadastro.php?erro=1");
        exit;
    }
} else {
    // Se o formulário não foi enviado corretamente
    header("Location: cadastro.php");
    exit;
}
?>