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

        .logo-container h1 {
            color: #065f46;
            font-size: 20px;
            margin: 0;
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
    </style>
</head>

@php
    $user = session('user_data');
@endphp

<body>

    <header>
        <div class="logo-container">
            @if ($user)
                 <h1>Olá, {{$user["name"]}}</h1>
            @else 
                <h1>EcoMercy</h1>
            @endif
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
                font-size: 12px;
            ">
                    {{ session('cart_count', 0) }}
                </span>
            </a>
            <a href="{{ route('logout') }}" style="color: #065f46; text-decoration: none; font-weight: bold;">Sair</a>
        </div>
    </header>

    <div class="catalog-container">
        <h2>Recomendações feitas para você</h2>
        <div class="carousel">
            @foreach ($produtos["data"] as $recomendados)
                <div class="product-card">
                    <img src="{{ $recomendados['image_url'] }}" style="width: 30px;" alt="{{ $recomendados['name'] }}">
                    <div class="product-name">{{ $recomendados['name'] }}</div>
                    <div class="product-price">{{ $recomendados['description'] }}</div>
                    <div class="product-price">R$ {{ number_format($recomendados['price'], 2, ',', '.') }}</div>
                </div>
            @endforeach
        </div>
    
        <h2 style="margin-top: 40px;">Catálogo completo</h2>
        <div class="product-grid">
            @foreach ($produtos["data"] as $produto)
                <div class="product-card">
                    <img src="{{ $produto['image_url'] }}" style="width: 30px;" alt="{{ $produto['name'] }}">
                    <div class="product-name">{{ $produto['name'] }}</div>
                    <div class="product-price">{{ $produto['description'] }}</div>
                    <div class="product-price">R$ {{ number_format($produto['price'], 2, ',', '.') }}</div>
                </div>
            @endforeach
        </div>
    </div>
    <footer>
        &copy; {{ date('Y') }} EcoMercy. Produtos ecológicos com propósito.
    </footer>

</body>

</html>
