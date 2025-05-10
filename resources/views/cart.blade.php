<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Meu Carrinho - EcoMercy</title>
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

        .cart-container {
            padding: 30px 20px;
        }

        .cart-item {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .cart-item img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
        }

        .item-info {
            flex-grow: 1;
        }

        .item-name {
            font-size: 16px;
            color: #065f46;
            font-weight: bold;
        }

        .item-price {
            font-size: 16px;
            color: #444;
            margin-top: 5px;
        }

        .item-remove {
            background-color: transparent;
            border: none;
            color: #dc2626;
            cursor: pointer;
            font-size: 14px;
        }

        .total {
            text-align: right;
            margin-top: 30px;
            font-size: 18px;
            font-weight: bold;
            color: #065f46;
        }

        .purchase {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 10px;
        }

        .purchase-item {

            display: inline-block;
            background-color: #059669;
            color: white;
            padding: 12px 28px;
            border-radius: 30px;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .purchase-item:hover {
            background-color: #047857;
            cursor: pointer;
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

<body>

    <header>
        <a href="{{ route('catalog') }}">
            <div class="logo-container">
                <h1>EcoMercy</h1>
            </div>
        </a>
        <a href="{{ route('config') }}">
            <img src="{{ asset('img/config.svg') }}" style="width: 25px;" alt="">
        </a>
        <a href="{{ route('logout') }}" style="color: #065f46; text-decoration: none; font-weight: bold;">Sair</a>
    </header>

    <div class="cart-container">
        <h2>Seu Carrinho</h2>

        @php
            $total_final = 0;
        @endphp

        @foreach ($cartItems as $item)
            @php
                $total_final += $item['total'];
            @endphp

            @for ($i = 1; $i <= $item['quantity']; $i++)
                <div class="cart-item">
                    <img src="{{ asset('img/ecomercy.png') }}" alt="Produto {{ $item['product']['name'] }}">
                    <div class="item-info">
                        <div class="item-name">{{ $item['product']['name'] }}</div>
                        <div class="item-price">{{ $item['product']['description'] }}</div>
                        <div class="item-price">R$ {{ number_format($item['product']['price'], 2, ',', '.') }}</div>
                    </div>
                    @if (in_array("remover_produto", $features))
                        <button class="item-remove">Remover</button>
                    @endif
                </div>
            @endfor
        @endforeach




        @if(in_array("frete_estimado", $features))
            <!-- Parte do carrinho.blade.php -->
<div style="margin-top: 20px;">
    <label for="cep">Digite seu CEP:</label>
    <input type="text" id="cep" name="cep" placeholder="00000-000">
    <button id="btn-calcular-frete">Calcular Frete</button>
</div>

<div id="frete-resultados" style="margin-top: 15px;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnFrete = document.getElementById('btn-calcular-frete');
        if (btnFrete) {
            btnFrete.addEventListener('click', calcularFrete);
        }
    });

    function calcularFrete() {
        const cep = document.getElementById('cep').value.trim();
        const resultados = document.getElementById('frete-resultados');
        resultados.innerHTML = 'Calculando...';
        const userToken = @json(session('user_token'));

        if (!cep) {
            resultados.innerHTML = 'Por favor, digite um CEP válido.';
            return;
        }
            console.log('entrou 1');
        fetch('https://radbios.com.br/api/service/shipping/shipping', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + userToken,
            },
            body: JSON.stringify({
                postal_code: cep
            })
            
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data && Array.isArray(data.options)) {
                let html = '<h4>Opções de Entrega:</h4><ul>';
                data.options.forEach(opcao => {
                    html += `<li>
                        <strong>${opcao.nome}</strong> - R$ ${opcao.valor} 
                        (${opcao.prazo} dias úteis)
                        <button onclick="selecionarFrete('${opcao.id}', '${opcao.nome}', '${opcao.valor}')">
                            Selecionar
                        </button>
                    </li>`;
                });
                html += '</ul>';
                resultados.innerHTML = html;
            } else {
                resultados.innerHTML = 'Nenhuma opção de frete encontrada para este CEP.';
            }
        })
        .catch(error => {
            console.error(error);
            resultados.innerHTML = 'Erro ao calcular o frete. Tente novamente mais tarde.';
        });
    }

    // function selecionarFrete(id, nome, valor) {
    //     alert(`Você selecionou: ${nome} - R$ ${valor}`);

    //     fetch('/salvar-frete', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //         },
    //         body: JSON.stringify({
    //             id: id,
    //             nome: nome,
    //             valor: valor
    //         })
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         console.log('Frete salvo com sucesso', data);
    //     })
    //     .catch(error => {
    //         console.error('Erro ao salvar frete:', error);
    //     });
    // }
</script>


        @endif
        
        <div class="purchase">
            <div class="total">
                Total: R$ <span id="total-final">{{ number_format($total_final, 2, ',', '.') }}</span>
            </div>
            <a class="purchase-item" href="{{ route('checkout') }}">Continuar Compra</a>
        </div>

    </div>

    <footer>
        &copy; {{ date('Y') }} EcoMercy. Produtos ecológicos com propósito.
    </footer>

</body>

</html>
