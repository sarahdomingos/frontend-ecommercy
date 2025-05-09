
<?php

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('home');
});

Route::view('/login', 'login')->name('login');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $response = Http::post('http://auth.radbios.com.br/api/login', [
        'email' => $request->email,
        'password' => $request->password,
    ]);

    if ($response->successful()) {
        $data = $response->json();
        session(['user_token' => $data['access_token'], 'user_data' => $data['user']]);
        // dd($data);
        return redirect()->route('catalog');
    }
    return back()->withErrors(['email' => 'Credenciais inválidas'])->withInput();
});

Route::get('/logout', function () {
    session()->forget(['user_token', 'user_data']);
    session()->flush();
    return redirect('/login');
})->name('logout');


Route::get('/catalog', function () {

    $response = Http::get('https://radbios.com.br/api/service/catalog/products');

    if ($response->successful()) {
        $produtos = $response->json();
    } else {
        $produtos = []; // fallback vazio
    }

    // dd($produtos);

    return view('catalog', compact('produtos'));
})->name('catalog');

Route::get('/cart', function () {
    $token = session('user_token');

    if (!$token) {
        return redirect('/login');
    }

    $response = Http::withToken($token)->get('https://cart.radbios.com.br/api/cart');
    $countResponse = Http::withToken($token)->get('https://cart.radbios.com.br/api/cart/count');
    

    if ($response->successful() && $countResponse->successful()) {
        $cartItems = $response->json()['data'];
        $cartCount = $countResponse->json()['count'] ?? 0;
        session(['cart_count' => $cartCount]);

        // dd($cartCount);

        return view('cart', [
            'cartItems' => $cartItems,
        ]);
    } else {
        return redirect()->back()->with('error', 'Erro ao carregar o carrinho.');
    }
})->name('cart');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/config', function () {
    return view('config');
})->name('config');

Route::post('/config', function (Request $request) {
    $features = Config::pluck("name")->toArray();
    foreach($features as $feat) {
        $status = null;

        if(in_array($feat, $request->features)) {
            $status = true;
        }
        else {
            $status = false;
        }

        Config::where("name", $feat)->update([
            "actived" => $status
        ]);
    }

    return redirect()->back();
})->name('config');