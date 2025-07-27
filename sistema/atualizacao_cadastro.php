<?php 
//include_once 'autenticar.php'; // Inclui o arquivo de autenticação
//include_once 'permissao.php'; // Inclui o arquivo de permissão

// Define o caminho para o arquivo JSON
$json_file = 'data/usuarios.json';

// Lê o arquivo JSON e converte em um array PHP
$usuarios = json_decode(file_get_contents($json_file), true);

// Verifica se o método é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera os dados do formulário
    $index = $_POST['index'];
    $username = $_POST['username'];
	$mail = $_POST['mail'];
    $password = $_POST['password'];
    $permissao = $_POST['permissao'];

    // Recupera a senha salva no arquivo JSON
    $senha_salva = $usuarios[$index]['password'];

    // Atualiza o usuário no array
    $usuarios[$index] = [
        'username' => strtolower($username), // Converte o nome de usuário para minúsculo
        'mail' => $mail, // Senha atualizada
        'password' => $senha_salva, // Senha atualizada
        'permissao' => $permissao // Permissão escolhida no formulário
    ];

    // Salva o array atualizado no arquivo JSON
    file_put_contents($json_file, json_encode($usuarios, JSON_PRETTY_PRINT));

    // Redireciona para a página da tabela com uma mensagem de sucesso
    header('Location: cadastro_tabela.php?atualizacao=sucesso');
    exit;
}
