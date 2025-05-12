# Para executar o sistema, é necessário cumprir os seguintes requisitos:
- Ter instalado o php versão 8.2 ou superior;
- Ter instalado o Laravel 11;
- Clonar o repositório do github com o comando <pre> ```git clone https://github.com/sarahdomingos/frontend-ecommercy.git ``` </pre>
- Entrar na pasta do repositório com o comando <pre> ``` cd frontend-ecommercy ``` </pre>
- Copiar todo o conteúdo do arquivo .env.example e colar dentro do seu próprio arquivo .env;
- Na primeira vez que clonar o repositório, é necessário acessar o arquivo ``` app\Providers\AppServiceProvider.php ``` e comentar a seguinte linha de código: ```View::share('features', Config::where("actived", true)->pluck("name")->toArray());```
- Após comentar, rodar o comando <pre> ``` php artisan migrate ``` </pre>
- Após a construção das tabelas, descomentar a linha de código que foi comentada anteriormente e rodar o comando <pre> ```php artisan db:seed``` </pre>
- Com todas as etapas concluídas, rodar o comando <pre> ``` php artisan serve``` </pre> que irá iniciar o sistema dentro do localhost.
