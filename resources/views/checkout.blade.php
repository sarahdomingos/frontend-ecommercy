<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Finalizar Pedido - EcoMercy</title>
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

        .checkout-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        h2 {
            color: #065f46;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #064e3b;
        }

        select, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #065f46;
            color: white;
            margin-top: 30px;
            cursor: pointer;
            font-weight: bold;
        }

        .pix-info {
            margin-top: 30px;
            background-color: #e6f4ea;
            padding: 20px;
            border-left: 4px solid #22c55e;
            border-radius: 6px;
            display: none;
        }

        .pix-info p {
            margin: 5px 0;
        }

        .alert {
            margin-top: 20px;
            color: #dc2626;
            font-weight: bold;
            font-size: 14px;
        }

        footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>

<header>
    <div class="logo-container">
        <h1>EcoMercy</h1>
    </div>
    <a href="{{ route('logout') }}" style="color: #065f46; text-decoration: none; font-weight: bold;">Sair</a>
</header>

<div class="checkout-container">
    <h2>Finalizar Pedido</h2>

    <form id="paymentForm" onsubmit="return showPixInfo(event)">
        <label for="paymentMethod">Escolha a forma de pagamento:</label>
        <select id="paymentMethod" name="paymentMethod" required>
            <option value="">Selecione</option>
            <option value="pix">PIX</option>
            <option value="boleto" disabled>Boleto (Indisponível)</option>
            <option value="cartao" disabled>Cartão de crédito (Indisponível)</option>
        </select>

        <button type="submit">Finalizar Pedido</button>
    </form>

    <div id="pixDetails" class="pix-info">
        <h3>Pagamento via PIX</h3>
        <div style="display: flex; ">
            <p><strong>Código de Pagamento:</strong> <input type="text" id="copyText" value="ferFvdrErfefdVdfv_r23sde.fe_wfdfsfWE4EF23gbbc_" readonly
                style="padding: 8px 40px 8px 12px; border: 1px solid #ccc; border-radius: 5px; width: 250px;"></p>
     
         <button id="copyButton" onclick="copyToClipboard()" style="
             background: none;
             border: none;
             cursor: pointer;
             font-size: 14px;
             color: #065f46;
         ">
             <img src="{{ asset('img/copy.svg') }}" style="width: 10%; display:flex; align-items:center; flex-direction:row; justify-content:center; align-content:center">
         </button>
        </div>
        
        <p><strong>Valor:</strong> R$ 79,90</p>
        <p><strong>Instituição:</strong> Banco Fictício 999</p>
        <p><strong>Nome:</strong> EcoMercy LTDA</p>
        <div class="alert">
            O pedido só será liberado mediante o pagamento, que deve ser feito em até <strong>30 minutos</strong>, ou será automaticamente cancelado.
        </div>
        <p style="margin-top: 20px; font-size: 13px; color: #666;">
            ⚠️ Este sistema é fictício, desenvolvido apenas para fins acadêmicos. Nenhum pagamento real será processado.
        </p>
        <div style="position: relative; display: inline-block;">

            
        </div>
        
        <script>
        function copyToClipboard() {
            const copyText = document.getElementById("copyText");
            const copyButton = document.getElementById("copyButton");
        
            copyText.select();
            copyText.setSelectionRange(0, 99999); // Para dispositivos móveis
            document.execCommand("copy");
        
            // Troca o conteúdo do botão para "Copiado!"
            const originalContent = copyButton.innerHTML;
            copyButton.innerHTML = "✅ Copiado!";
            
            // Volta ao ícone depois de 2 segundos
            setTimeout(() => {
                copyButton.innerHTML = originalContent;
            }, 2000);
        }
        </script>
        
    </div>
</div>

<footer>
    &copy; {{ date('Y') }} EcoMercy. Projeto acadêmico de e-commerce ecológico.
</footer>

<script>
    function showPixInfo(event) {
        event.preventDefault();

        const selected = document.getElementById("paymentMethod").value;
        if (selected === "pix") {
            document.getElementById("pixDetails").style.display = "block";
        } else {
            alert("Atualmente, apenas o pagamento via PIX está disponível.");
        }

        return false;
    }
</script>

</body>
</html>
