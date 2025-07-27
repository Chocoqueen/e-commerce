<?php
include_once 'autenticar.php'; // Inclui o arquivo de autenticação
include_once 'permissao.php'; // Inclui o arquivo de permissão

// Define o caminho para o arquivo JSON
$json_file = 'data/usuarios.json';

// Lê o arquivo JSON e converte em um array PHP
$usuarios = json_decode(file_get_contents($json_file), true);

// Obtém o nome de usuário do parâmetro GET
$username = $_GET['username'];

// Percorre o array de usuários
foreach ($usuarios as $key => $usuario) {
    // Verifica se o nome de usuário é igual ao parâmetro
    if ($usuario['username'] == $username) {
        // Remove o elemento do array
        unset($usuarios[$key]);
        // Sai do loop
        break;
    }
}

// Converte o array atualizado em uma string JSON
$json_string = json_encode($usuarios);

// Salva a string JSON no arquivo
file_put_contents($json_file, $json_string);

// Redireciona para a página tabela
header('Location: cadastro_tabela.php');
?>