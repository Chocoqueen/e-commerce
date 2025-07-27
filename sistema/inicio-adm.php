<?php 
include_once 'autenticar.php';
$json_file = 'data/usuarios.json';
$usuarios = json_decode(file_get_contents($json_file), true);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌸 Boticário Schultz - Perfumaria & Cosméticos</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
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
                    <li class="nav-item"><a class="nav-link" href="inicio-adm.php">Inicio</a></li>
					<li class="nav-item"><a class="nav-link" href="Cadastro_tabela.php">Cadastro</a></li>
                    <li class="nav-item"><a class="nav-link" href="logoff">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <div class="container-fluid mt-4">
        <div class="row">
		
            <!-- Sidebar com Filtros -->
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="section-title mb-0">
                            <i class="fas fa-filter" style="color: #e91e63;"></i>
                            Filtrar Produtos
                        </h3>
                    </div>
                    <div class="card-body p-3">
                        <!-- Filtro Perfumes -->
                        <div class="filter-group mb-3">
                            <h6 class="filter-title">
                                <i class="fas fa-spray-can" style="color: #e91e63;"></i>
                                Perfumes
                            </h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="perfumesMasculinos" value="perfumes-masculinos" onchange="aplicarFiltros()">
                                <label class="form-check-label" for="perfumesMasculinos">Perfumes Masculinos</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="perfumesFemininos" value="perfumes-femininos" onchange="aplicarFiltros()">
                                <label class="form-check-label" for="perfumesFemininos">Perfumes Femininos</label>
                            </div>
                        </div>

                        <!-- Filtro Hidratantes -->
                        <div class="filter-group mb-3">
                            <h6 class="filter-title">
                                <i class="fas fa-tint" style="color: #2196f3;"></i>
                                Hidratantes
                            </h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="hidratantesMasculinos" value="hidratantes-masculinos" onchange="aplicarFiltros()">
                                <label class="form-check-label" for="hidratantesMasculinos">Hidratantes Masculinos</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="hidratantesFemininos" value="hidratantes-femininos" onchange="aplicarFiltros()">
                                <label class="form-check-label" for="hidratantesFemininos">Hidratantes Femininos</label>
                            </div>
                        </div>

                        <!-- Filtro Promoções -->
                        <div class="filter-group mb-3">
                            <h6 class="filter-title">
                                <i class="fas fa-tags" style="color: #f44336;"></i>
                                Ofertas
                            </h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="promocoes" value="promocoes" onchange="aplicarFiltros()">
                                <label class="form-check-label" for="promocoes">Promoções</label>
                            </div>
                        </div>

                        <!-- Botões de Controle -->
                        <div class="filter-controls mt-4">
                            <button type="button" class="btn btn-primary btn-sm btn-block mb-2" onclick="mostrarTodos()">
                                <i class="fas fa-eye"></i> Mostrar Todos
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm btn-block" onclick="limparFiltros()">
                                <i class="fas fa-eraser"></i> Limpar Filtros
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Área Principal -->
            <div class="col-lg-9 col-md-8">
                <!-- Produtos Filtrados -->
                <div class="card mb-4" id="produtosFiltrados" style="display: none;">
                    <div class="card-header">
                        <h3 class="section-title mb-0">
                            <i class="fas fa-search" style="color: #e91e63;"></i>
                            Produtos Filtrados
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row" id="listaProdutosFiltrados"></div>
                    </div>
                </div>

                <!-- Carrinho -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="section-title mb-0">
                            <i class="fas fa-shopping-cart" style="color: #e91e63;"></i>
                            Carrinho de Compras
                        </h3>
                    </div>
                    <div class="card-body">
                        <div id="carrinhoVazio" class="empty-cart">
                            <i class="fas fa-shopping-cart"></i>
                            <h4>Seu carrinho está vazio</h4>
                            <p>Que tal explorar nossos produtos incríveis? 💕</p>
                        </div>
                        <ul class="list-unstyled" id="itensCarrinho"></ul>
                        <div id="totalCarrinho" class="total-price mt-4" style="display: none;">
                            <i class="fas fa-calculator" style="margin-right: 10px;"></i>
                            Total: R$ 0,00
                        </div>
                        <button type="button" id="botaoEnviarPedido" class="btn btn-success btn-lg btn-block mt-4" style="display: none;" onclick="enviarPedido()">
                            <i class="fas fa-paper-plane"></i> Finalizar Pedido 💕
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detalhes do Produto -->
    <div class="modal fade" id="detalheProdutoModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detalheTitulo">
                        <i class="fas fa-info-circle" style="color: #e91e63;"></i>
                        Detalhes do Produto
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <img id="detalheImagem" src="/placeholder.svg" alt="" class="img-fluid rounded mb-3" style="max-height: 400px; border: 3px solid #e91e63;">
                        </div>
                        <div class="col-md-6">
                            <h4 id="detalheNome" class="product-name mb-3"></h4>
                            <p id="detalhePreco" class="product-price h3 mb-4"></p>
                            <div class="form-group">
                                <label for="quantidadeProduto" class="font-weight-bold">
                                    <i class="fas fa-sort-numeric-up"></i> Quantidade:
                                </label>
                                <div class="input-group" style="max-width: 150px;">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button" onclick="alterarQuantidade(-1)">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="number" class="form-control text-center font-weight-bold" id="quantidadeProduto" value="1" min="1" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" onclick="alterarQuantidade(1)">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h6><i class="fas fa-star" style="color: #ffc107;"></i> Produto Original</h6>
                                <h6><i class="fas fa-truck" style="color: #4caf50;"></i> Entrega Rápida</h6>
                                <h6><i class="fas fa-shield-alt" style="color: #2196f3;"></i> Garantia de Qualidade</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-lg" onclick="adicionarAoCarrinho()">
                        <i class="fas fa-cart-plus"></i> Adicionar ao Carrinho 💕
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Fechar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Rodapé -->
    <footer class="footer py-4">
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
                        © 2025 Todos os direitos reservados | Desenvolvido com <i class="fas fa-heart" style="color: #e91e63;"></i> e muito carinho
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        let proximoIdPedido = 1;
        let produtoAtual = {};
        
        const produtosDatabase = [
            { nome: 'Lily Eau de Parfum', preco: 189.90, imagem: 'img/Lily.jpg', categoria: 'perfumes-femininos', descricao: '75ml - Floral Feminino Delicado' },
            { nome: 'Floratta Blue', preco: 199.90, imagem: 'img/Florata.jpg', categoria: 'perfumes-femininos', descricao: '75ml - Floral Aquático Refrescante' },
            { nome: 'Malbec Rose', preco: 179.90, imagem: 'img/Malbec.R', categoria: 'perfumes-femininos', descricao: '100ml - Floral Frutado Elegante' },
            { nome: 'Nativa SPA Quinoa', preco: 59.90, imagem: 'img/Hd.1.jpg', categoria: 'hidratantes-femininos', descricao: '400ml - Hidratação Intensa Natural' },
            { nome: 'Cuide-se Bem Açaí', preco: 69.90, imagem: 'img/H.2.jpg', categoria: 'hidratantes-femininos', descricao: '250ml - Antioxidante Poderoso' },
            { nome: 'Tododia Ameixa', preco: 49.90, imagem: 'img/H.3.jpg', categoria: 'hidratantes-femininos', descricao: '400ml - Hidratação Diária Suave' },
            { nome: 'Malbec Black', preco: 199.90, imagem: 'img/PM.1.jpg', categoria: 'perfumes-masculinos', descricao: '100ml - Amadeirado Intenso Marcante' },
            { nome: 'Kaiak Extremo', preco: 169.90, imagem: 'img/PM.2.jpg', categoria: 'perfumes-masculinos', descricao: '100ml - Aquático Masculino Vibrante' },
            { nome: 'Coffee Man', preco: 149.90, imagem: 'img/PM.3.jpg', categoria: 'perfumes-masculinos', descricao: '100ml - Oriental Gourmand Sedutor' },
            { nome: 'Men Expert Hidratante', preco: 34.90, imagem: 'img/Hm.1.jpg', categoria: 'hidratantes-masculinos', descricao: '200ml - Cuidado Especializado Masculino' },
            { nome: 'Barba Forte Pós-Barba', preco: 29.90, imagem: 'img/Hm.2.jpg', categoria: 'hidratantes-masculinos', descricao: '100ml - Cuidado Pós-Barba Refrescante' },
            { nome: 'Cuide-se Bem Homem', preco: 27.90, imagem: 'img/Hm.3.jpg', categoria: 'hidratantes-masculinos', descricao: '250ml - Hidratação Masculina Completa' },
            { nome: 'Kit Lily + Hidratante', preco: 199.90, imagem: 'img/Of.1.jpg', categoria: 'promocoes', descricao: 'Perfume 75ml + Hidratante 250ml - Economia de R$ 85,90!' },
            { nome: 'Combo Malbec Masculino', preco: 299.90, imagem: 'img/Of.2.jpg', categoria: 'promocoes', descricao: 'Perfume + Desodorante + Pós-Barba - Economia de R$ 99,90!' }
        ];

        function aplicarFiltros() {
            const filtrosSelecionados = [];
            const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            checkboxes.forEach(checkbox => filtrosSelecionados.push(checkbox.value));
            
            if (filtrosSelecionados.length === 0) {
                document.getElementById('produtosFiltrados').style.display = 'none';
                return;
            }
            
            const produtosFiltrados = produtosDatabase.filter(produto => 
                filtrosSelecionados.includes(produto.categoria)
            );
            
            exibirProdutosFiltrados(produtosFiltrados);
        }

        function exibirProdutosFiltrados(produtos) {
            const container = document.getElementById('listaProdutosFiltrados');
            const secaoProdutos = document.getElementById('produtosFiltrados');
            
            container.innerHTML = '';
            
            if (produtos.length === 0) {
                container.innerHTML = `
                    <div class="col-12 text-center">
                        <div class="alert alert-info">
                            <i class="fas fa-search"></i>
                            <h5>Nenhum produto encontrado</h5>
                            <p>Tente ajustar os filtros para encontrar produtos.</p>
                        </div>
                    </div>
                `;
            } else {
                produtos.forEach(produto => {
                    const produtoHTML = `
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card product-card" onclick="abrirDetalhes('${produto.nome}', ${produto.preco}, '${produto.imagem}')">
                                <img src="${produto.imagem}" class="card-img-top" alt="${produto.nome}">
                                <div class="card-body text-center">
                                    <h6 class="product-name">${produto.nome}</h6>
                                    <p class="product-price">R$ ${produto.preco.toFixed(2)}</p>
                                    <small class="text-muted">${produto.descricao}</small>
                                    ${produto.categoria === 'promocoes' ? '<p class="text-success font-weight-bold mt-2"><i class="fas fa-fire"></i> OFERTA ESPECIAL!</p>' : ''}
                                </div>
                            </div>
                        </div>
                    `;
                    container.innerHTML += produtoHTML;
                });
            }
            
            secaoProdutos.style.display = 'block';
            secaoProdutos.scrollIntoView({ behavior: 'smooth', block: 'start' });
            mostrarNotificacao(`${produtos.length} produto(s) encontrado(s)! 🔍`, 'info');
        }

        function mostrarTodos() {
            exibirProdutosFiltrados(produtosDatabase);
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => checkbox.checked = true);
            mostrarNotificacao('Mostrando todos os produtos! 🌟', 'success');
        }

        function limparFiltros() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => checkbox.checked = false);
            document.getElementById('produtosFiltrados').style.display = 'none';
            mostrarNotificacao('Filtros limpos! 🧹', 'info');
        }

        function abrirDetalhes(nome, preco, imagemUrl) {
            produtoAtual = { nome: nome, preco: preco, imagem: imagemUrl };
            
            document.getElementById('detalheTitulo').innerHTML = `
                <i class="fas fa-info-circle" style="color: #e91e63;"></i> ${nome}
            `;
            document.getElementById('detalheNome').textContent = nome;
            document.getElementById('detalheImagem').src = imagemUrl;
            document.getElementById('detalheImagem').alt = nome;
            document.getElementById('detalhePreco').textContent = `R$ ${preco.toFixed(2)}`;
            document.getElementById('quantidadeProduto').value = 1;
            
            $('#detalheProdutoModal').modal('show');
        }

        function alterarQuantidade(delta) {
            const input = document.getElementById('quantidadeProduto');
            const quantidadeAtual = parseInt(input.value);
            const novaQuantidade = quantidadeAtual + delta;
            
            if (novaQuantidade >= 1) {
                input.value = novaQuantidade;
                input.style.transform = 'scale(1.1)';
                setTimeout(() => input.style.transform = 'scale(1)', 200);
            }
        }

        function adicionarAoCarrinho() {
            const quantidade = parseInt(document.getElementById('quantidadeProduto').value);
            const subtotal = quantidade * produtoAtual.preco;
            
            const listaCarrinho = document.getElementById("itensCarrinho");
            const carrinhoVazio = document.getElementById("carrinhoVazio");
            
            carrinhoVazio.style.display = 'none';
            
            const listItem = document.createElement("li");
            listItem.classList.add("cart-item");
            listItem.innerHTML = `
                <div class="d-flex justify-content-between align-items-center">
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center mb-2">
                            <img src="${produtoAtual.imagem}" alt="${produtoAtual.nome}"
                                 style="width: 60px; height: 60px; object-fit: cover; border-radius: 10px; margin-right: 15px; border: 2px solid #e91e63;">
                            <div>
                                <h6 class="product-name mb-1">${produtoAtual.nome}</h6>
                                <small class="text-muted">
                                    <i class="fas fa-sort-numeric-up"></i> Quantidade: ${quantidade} × R$ ${produtoAtual.preco.toFixed(2)}
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="text-right ml-3">
                        <div class="product-price h6 mb-2">
                            <i class="fas fa-tag"></i> R$ ${subtotal.toFixed(2)}
                        </div>
                        <button type='button' class='btn btn-danger btn-sm' onclick='removerItem(this)' title="Remover item">
                            <i class="fas fa-trash"></i> Remover
                        </button>
                    </div>
                </div>
            `;
            
            listaCarrinho.appendChild(listItem);
            atualizarTotalCarrinho();
            verificarItensCarrinho();
            $('#detalheProdutoModal').modal('hide');
            
            listItem.style.transform = 'scale(1.05)';
            listItem.style.transition = 'transform 0.3s ease';
            setTimeout(() => listItem.style.transform = 'scale(1)', 300);
            
            mostrarNotificacao('Produto adicionado ao carrinho! 💕', 'success');
        }

        function removerItem(botaoRemover) {
            const item = botaoRemover.closest('.cart-item');
            item.style.animation = 'slideOutLeft 0.4s ease forwards';
            
            setTimeout(() => {
                item.remove();
                atualizarTotalCarrinho();
                verificarItensCarrinho();
                mostrarNotificacao('Item removido do carrinho', 'info');
            }, 400);
        }

        function atualizarTotalCarrinho() {
            const itens = document.getElementById("itensCarrinho").children;
            let totalGeral = 0;
            
            for (let i = 0; i < itens.length; i++) {
                const textoItem = itens[i].textContent;
                const matches = textoItem.match(/R\$ ([\d,]+\.?\d*)/g);
                
                if (matches && matches.length > 0) {
                    const ultimoPreco = matches[matches.length - 1];
                    const valor = parseFloat(ultimoPreco.replace('R$ ', '').replace(',', ''));
                    totalGeral += valor;
                }
            }
            
            const elementoTotal = document.getElementById("totalCarrinho");
            elementoTotal.innerHTML = `
                <i class="fas fa-calculator" style="margin-right: 10px;"></i>
                Total: R$ ${totalGeral.toFixed(2)}
            `;
            
            elementoTotal.style.display = itens.length > 0 ? 'block' : 'none';
        }

        function verificarItensCarrinho() {
            const listaCarrinho = document.getElementById("itensCarrinho");
            const botaoEnviarPedido = document.getElementById("botaoEnviarPedido");
            const carrinhoVazio = document.getElementById("carrinhoVazio");
            
            const temItens = listaCarrinho.children.length > 0;
            
            if (temItens) {
                botaoEnviarPedido.style.display = "block";
                carrinhoVazio.style.display = "none";
            } else {
                botaoEnviarPedido.style.display = "none";
                carrinhoVazio.style.display = "block";
            }
        }

        function enviarPedido() {
            const itensCarrinho = document.getElementById('itensCarrinho').children;
            
            const pedido = {
                id: proximoIdPedido++,
                itens: [],
                status: 'pedido',
                total_pedido: 0
            };

            for (let item of itensCarrinho) {
                const textoItem = item.textContent;
                const nomeElement = item.querySelector('.product-name');
                const nome = nomeElement ? nomeElement.textContent.trim() : '';
                
                const quantidadeMatch = textoItem.match(/Quantidade: (\d+)/);
                const quantidade = quantidadeMatch ? parseInt(quantidadeMatch[1]) : 1;
                
                const precoMatches = textoItem.match(/R\$ ([\d,]+\.?\d*)/g);
                let precoUnitario = 0;
                
                if (precoMatches && precoMatches.length >= 2) {
                    precoUnitario = parseFloat(precoMatches[0].replace('R$ ', '').replace(',', ''));
                }
                
                pedido.itens.push({
                    nome: nome,
                    quantidade: quantidade,
                    preco_unitario: precoUnitario
                });
                
                pedido.total_pedido += precoUnitario * quantidade;
            }

            const botaoEnviar = document.getElementById('botaoEnviarPedido');
            const textoOriginal = botaoEnviar.innerHTML;
            botaoEnviar.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
            botaoEnviar.disabled = true;

            $.ajax({
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(pedido),
                timeout: 10000,
                success: function (response) {
                    console.log('✅ Resposta do servidor:', response);
                    mostrarNotificacao('🎉 Pedido enviado com sucesso! Obrigado pela preferência! 💕', 'success');
                    limparCarrinho();
                },
                error: function (xhr, status, error) {
                    console.error('❌ Erro ao enviar o pedido:', error);
                    let mensagemErro = 'Erro ao enviar o pedido. ';
                    if (status === 'timeout') {
                        mensagemErro += 'Tempo limite excedido.';
                    } else if (status === 'error') {
                        mensagemErro += 'Erro de conexão com o servidor.';
                    } else {
                        mensagemErro += `Status: ${status}`;
                    }
                    mostrarNotificacao(mensagemErro, 'error');
                },
                complete: function() {
                    botaoEnviar.innerHTML = textoOriginal;
                    botaoEnviar.disabled = false;
                }
            });
        }

        function limparCarrinho() {
            document.getElementById('itensCarrinho').innerHTML = '';
            document.getElementById('totalCarrinho').style.display = 'none';
            document.getElementById('botaoEnviarPedido').style.display = 'none';
            document.getElementById('carrinhoVazio').style.display = 'block';
        }

        function mostrarNotificacao(mensagem, tipo = 'info') {
            const notificacao = document.createElement('div');
            notificacao.className = `alert alert-${tipo === 'success' ? 'success' : tipo === 'error' ? 'danger' : 'info'} alert-dismissible fade show`;
            notificacao.style.cssText = `
                position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;
                box-shadow: 0 8px 25px rgba(0,0,0,0.2); border-radius: 15px; border: 2px solid #e91e63;
            `;
            
            notificacao.innerHTML = `
                ${mensagem}
                <button type="button" class="close" onclick="this.parentElement.remove()">
                    <span>&times;</span>
                </button>
            `;
            
            document.body.appendChild(notificacao);
            setTimeout(() => {
                if (notificacao.parentElement) {
                    notificacao.remove();
                }
            }, 5000);
        }

        const estilosAnimacao = document.createElement('style');
        estilosAnimacao.textContent = `
            @keyframes slideOutLeft {
                from { opacity: 1; transform: translateX(0); }
                to { opacity: 0; transform: translateX(-100%); }
            }
            .btn { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
            .fa-spinner { animation: spin 1s linear infinite; }
            .filter-group { border-bottom: 1px solid #eee; padding-bottom: 15px; }
            .filter-title { color: #333; font-weight: 600; margin-bottom: 10px; }
            .form-check { margin-bottom: 8px; }
            .form-check-input:checked { background-color: #e91e63; border-color: #e91e63; }
            .form-check-label { font-size: 0.9em; color: #666; cursor: pointer; }
            .filter-controls .btn { font-size: 0.85em; padding: 8px 12px; }
        `;
        document.head.appendChild(estilosAnimacao);

        window.onload = function () {
            console.log('🌸 Boticário Schultz - Sistema iniciado com sucesso!');
            verificarItensCarrinho();
            setTimeout(() => {
                mostrarNotificacao('Bem-vindo ao Boticário Schultz! 🌸 Use os filtros para encontrar seus produtos favoritos! 💕', 'success');
            }, 1000);
        };
    </script>
</body>
</html>
