<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Login - EcoMercy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #F2E4C9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            gap: 30px;
        }

        .login-container {
            background-color: white;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            text-align: center;
            color: #065f46;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #444;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #bbb;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group input:focus {
            border-color: #059669;
            outline: none;
        }

        .btn-submit {
            width: 100%;
            background-color: #059669;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #047857;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #065f46;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <img src="{{ asset('img/ecomercy.png') }}" style="width: 30%" alt="">

    <div class="login-container">
        <h2>Entrar no EcoMercy</h2>
        @if ($errors->any())
            <div style="color: red; text-align: center; margin-bottom: 10px;">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ url('/login') }}">
            @csrf

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit" class="btn-submit">Entrar</button>
        </form>

        <a href="/" class="back-link">← Voltar para a página inicial</a>
    </div>
</body>

</html>
