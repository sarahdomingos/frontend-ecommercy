<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>EcoMercy - Loja Ecológica</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #F2E4C9;
            color: #2f4f4f;
        }

        header {
            background-color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .logo-container-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-container-body img {
            width: 10%;
            height: 10%;
        }

        .logo-container h1 {
            color: #065f46;
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .login-link {
            color: #065f46;
            font-weight: bold;
            text-decoration: none;
        }

        .login-link:hover {
            color: #022c22;
        }

        main {
            padding: 80px 20px;
            text-align: center;
        }

        main h2 {
            font-size: 36px;
            color: #064e3b;
            margin-bottom: 20px;
        }

        main p {
            max-width: 600px;
            margin: 0 auto 30px;
            font-size: 18px;
            color: #444;
        }

        .btn-register {
            display: inline-block;
            background-color: #059669;
            color: white;
            padding: 12px 28px;
            border-radius: 30px;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-register:hover {
            background-color: #047857;
            cursor: pointer;
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
        <a href="{{ route('login') }}" class="login-link">Entrar</a>
    </header>

    <main>
    <div class="logo-container-body">
    <img src="{{ asset('img/ecomercy.png') }}" alt="EcoMercy Logo">
        <h2>Produtos ecológicos ao seu alcance</h2>
        <p>Compre com consciência. No EcoMercy, você encontra produtos sustentáveis que respeitam o planeta e promovem um estilo de vida mais verde.</p>
        <a href="" class="btn-register">Criar Conta</a>
    </div>
    </main>

    <footer>
        &copy; {{ date('Y') }} EcoMercy. Todos os direitos reservados.
    </footer>

</body>
</html>
