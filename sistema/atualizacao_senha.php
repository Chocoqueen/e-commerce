<?php 
// Caminho para o arquivo JSON
$json_file = 'data/usuarios.json';
$usuarios = json_decode(file_get_contents($json_file), true);

// Verifica se o método é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = $_POST['index'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Recupera os dados atuais do usuário
    $usuario_antigo = $usuarios[$index];

    // Atualiza apenas a senha
    $usuarios[$index] = [
        'username' => $username,
        'mail' => $usuario_antigo['mail'], // Mantém o e-mail antigo
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'permissao' => $usuario_antigo['permissao'] // Mantém a permissão
    ];

    // Salva no JSON
    file_put_contents($json_file, json_encode($usuarios, JSON_PRETTY_PRINT));

    // Redireciona com sucesso
    header('Location: cadastro_tabela.php?atualizacao=sucesso');
    exit;
}
