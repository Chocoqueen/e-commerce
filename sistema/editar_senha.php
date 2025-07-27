<?php 
// include_once 'autenticar.php';
// include_once 'permissao.php';

$json_file = 'data/usuarios.json';
$usuarios = json_decode(file_get_contents($json_file), true);

$username = $_GET['username'] ?? '';
$index = null;

foreach ($usuarios as $i => $usuario) {
    if ($usuario['username'] === $username) {
        $index = $i;
		$mail = $usuario['email'] ?? '';
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌸 Boticário Schultz - Redefinir Senha</title>

    <!-- ===== Bibliotecas Externas ===== -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/maxon_red.ico" type="image/x-icon">
</head>
<body>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <span class="navbar-brand brand-title">
                <i class="fas fa-spa" style="color: #e91e63; margin-right: 10px;"></i>
                Boticário Schultz
                <small style="font-size: 0.6em; display: block; margin-top: -5px;">Perfumaria & Cosméticos</small>
            </span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="inicio-adm.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="cadastro_tabela.php">Cadastro</a></li>
                    <li class="nav-item"><a class="nav-link" href="logoff.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ===== CONTEÚDO PRINCIPAL ===== -->
    <div class="container my-5">
        <div class="mx-auto" style="max-width: 500px;">
            <h2 class="text-center mb-4">Redefinir Senha - <?php echo htmlspecialchars($username); ?></h2>

            <?php if (isset($_GET['erro'])): ?>
                <div class="alert alert-danger text-center">Erro ao atualizar senha. Tente novamente.</div>
            <?php endif; ?>

            <?php if (isset($_GET['sucesso'])): ?>
                <div class="alert alert-success text-center">Senha atualizada com sucesso.</div>
            <?php endif; ?>

            <form action="atualizacao_senha.php" method="post">
                <input type="hidden" name="index" value="<?php echo $index; ?>">
                <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
				<input type="hidden" name="mail" value="<?php echo $mail; ?>">
                <div class="form-group">
                    <label for="password">Nova Senha:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-warning">Atualizar Senha</button>
                    <a href="cadastro_tabela.php" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== RODAPÉ ===== -->
    <footer class="footer py-4 bg-light mt-auto">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="mb-3">
                        <i class="fas fa-spa" style="color: #e91e63;"></i> 
                        Boticário Schultz
                    </h5>
                    <p class="mb-2">Perfumaria & Cosméticos de Qualidade</p>
                    <p class="mb-3 text-muted">Produtos originais • Entrega rápida • Atendimento especializado</p>
                    <div class="social-links mb-3">
                        <a href="#" class="text-decoration-none mx-2">
                            <i class="fab fa-instagram" style="color: #e91e63; font-size: 1.5rem;"></i>
                        </a>
                        <a href="#" class="text-decoration-none mx-2">
                            <i class="fab fa-facebook" style="color: #2196f3; font-size: 1.5rem;"></i>
                        </a>
                        <a href="#" class="text-decoration-none mx-2">
                            <i class="fab fa-whatsapp" style="color: #4caf50; font-size: 1.5rem;"></i>
                        </a>
                    </div>
                    <p class="mb-0 text-muted">
                        © 2025 Todos os direitos reservados |
                        Desenvolvido com <i class="fas fa-heart" style="color: #e91e63;"></i> e muito carinho
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
