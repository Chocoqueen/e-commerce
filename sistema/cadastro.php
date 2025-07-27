<?php 
//include_once 'autenticar.php'; // Inclui o arquivo de autenticação
//include_once 'permissao.php'; // Inclui o arquivo de permissão
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌸 Boticário Schultz - Cadastro de Usuário</title>
    
    <!-- ===== BIBLIOTECAS EXTERNAS ===== -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

    <link rel="shortcut icon" href="img/maxon_red.ico" type="image/x-icon">
</head>

<body>

    <!-- ===== HEADER PRINCIPAL COM NAVEGAÇÃO ===== -->
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
        <h2 class="mb-4 text-center">Cadastro de Usuário</h2>
        
        <?php if (isset($_GET['erro'])): ?>
            <div class="alert alert-danger" role="alert">
                Ocorreu um erro no cadastro. Tente novamente.
            </div>
        <?php endif; ?>

        <form action="processa_cadastro.php" method="post">
            <div class="form-group">
                <label for="username">Nome:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
			<div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="mail" name="mail" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="permissao">Permissão:</label>
                <select class="form-control" id="permissao" name="permissao" required>
					<option value="Usuário">Usuário</option>
					<option value="Administrador">Administrador</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Cadastrar</button>
            <a href="cadastro_tabela.php" class="btn btn-danger">Cancelar</a>
        </form>
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

    <!-- Bootstrap JS e dependências -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
