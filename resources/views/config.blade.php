<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Catálogo - EcoMercy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0fdf4;
            color: #333;
        }

        header {
            background-color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-container img {
            width: 40px;
            height: 40px;
        }

        .catalog-container {
            padding: 40px 20px;
        }

        h2 {
            color: #064e3b;
            margin-bottom: 10px;
        }

        .carousel {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            padding-bottom: 10px;
            scroll-behavior: smooth;
        }

        .carousel::-webkit-scrollbar {
            height: 6px;
        }

        .carousel::-webkit-scrollbar-thumb {
            background-color: #065f46;
            border-radius: 10px;
        }

        .product-card {
            background-color: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            text-align: center;
            min-width: 180px;
            max-width: 200px;
            flex: 0 0 auto;
        }

        .product-card img {
            width: 100%;
            height: 140px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-name {
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
            color: #065f46;
        }

        .product-price {
            color: #444;
            font-size: 14px;
            margin-top: 4px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 40px;
            margin-top: 40px;
        }

        footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #555;
        }

        .end-items {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .btn-submit {
            width: 100%;
            background-color: #059669;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #047857;
        }
        .logo-container h1 {
            color: #065f46;
            font-size: 20px;
            margin: 0;
        }

        .config-container {
            padding: 30px 20px;
        }

        h2 {
            color: #064e3b;
            margin-top: 30px;
            margin-bottom: 10px;
        }

        .feature-group {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
        }

        .feature-option {
            margin-bottom: 10px;
        }

        .feature-option label {
            margin-left: 8px;
            color: #065f46;
        }
    </style>
</head>

@php
    $user = session('user_data');
@endphp

<body>

    <header>
        <a href="{{ route('catalog') }}">
            <div class="logo-container">
                @if ($user)
                    <h1>Olá, {{ $user['name'] }}</h1>
                @else
                    <h1>EcoMercy</h1>
                @endif
            </div>
        </a>
        </div>
        <div class="end-items">
            <a href="{{ route('cart') }}" style="position: relative; color: #065f46; text-decoration: none;">
                <img src="{{ asset('img/cart.svg') }}" style="width: 25px;" alt="">
                <span id="cart-count"
                    style="
                position: absolute;
                top: -8px;
                right: -12px;
                background: #059669;
                color: white;
                border-radius: 50%;
                padding: 2px 6px;
                font-size: 12px;">
                    {{ session('cart_count', 0) }}
                </span>
            </a>
            <a href="{{ route('logout') }}" style="color: #065f46; text-decoration: none; font-weight: bold;">Sair</a>
        </div>
    </header>

    <div class="config-container">
        <h1>Configurações de Funcionalidades</h1>
    
        <form method="POST" action="">
            @csrf
    
            <!-- CATÁLOGO -->
            <h2>Catálogo</h2>
            <div class="feature-group">
                <div class="feature-option">
                    <input type="checkbox" id="mostrar_recomendacao" name="features[]" value="mostrar_recomendacao" checked>
                    <label for="mostrar_recomendacao">Mostrar recomendações feitas para você</label>
                </div>
                <div class="feature-option">
                    <input type="checkbox" id="mostrar_adicao_carrinho" name="features[]" value="mostrar_adicao_carrinho" checked>
                    <label for="mostrar_adicao_carrinho">Mostrar popup de adição ao carrinho</label>
                </div>
                <div class="feature-option">
                    <input type="checkbox" id="mostrar_adicao_carrinho" name="features[]" value="mostrar_decricao" checked>
                    <label for="mostrar_decricao">Mostrar descrição do produto</label>
                </div>
            </div>
    
            <!-- CARRINHO -->
            <h2>Carrinho</h2>
            <div class="feature-group">
                <div class="feature-option">
                    <input type="checkbox" id="frete_estimado" name="features[]" value="frete_estimado" checked>
                    <label for="frete_estimado">Calcular frete estimado</label>
                </div>
                <div class="feature-option">
                    <input type="checkbox" id="frete_estimado" name="features[]" value="remover_produto">
                    <label for="remover_produto">Permitir remoção de produto do carrinho</label>
                </div>
            </div>
    
            <!-- PAGAMENTO -->
            <h2>Pagamento</h2>
            <div class="feature-group">
                <div class="feature-option">
                    <input type="checkbox" id="pagamento_pix" name="features[]" value="pagamento_pix" checked>
                    <label for="pagamento_pix">Permitir pagamento por pix</label>
                </div>
                <div class="feature-option">
                    <input type="checkbox" id="pagamento_cartao" name="features[]" value="pagamento_cartao">
                    <label for="pagamento_cartao">Permitir pagamento por cartão de crédito</label>
                </div>
                <div class="feature-option">
                    <input type="checkbox" id="pagamento_boleto" name="features[]" value="pagamento_boleto">
                    <label for="pagamento_boleto">Permitir pagamento por boleto</label>
                </div>
                <div class="feature-option">
                    <input type="checkbox" id="resumo_final_pedido" name="features[]" value="resumo_final_pedido" checked>
                    <label for="resumo_final_pedido">Exibir resumo final do pedido antes do pagamento</label>
                </div>
            </div>
    
            <button type="submit" class="btn-submit">Salvar Configurações</button>
        </form>
    </div>

    <footer>
        &copy; {{ date('Y') }} EcoMercy. Produtos ecológicos com propósito.
    </footer>

</body>

</html>
