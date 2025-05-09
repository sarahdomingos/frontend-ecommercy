<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            ["name" => "mostrar_recomendacao", "label" => "Mostrar recomendações feitas para você"],
            ["name" => "mostrar_adicao_carrinho", "label" => "Mostrar popup de adição ao carrinho"],
            ["name" => "mostrar_decricao", "label" => "Mostrar descrição do produto"],
            ["name" => "frete_estimado", "label" => "Calcular frete estimado"],
            ["name" => "pagamento_pix", "label" => "Permitir pagamento por pix"],
            ["name" => "remover_produto", "label" => "Permitir remoção de produto do carrinho"],
            ["name" => "resumo_final_pedido", "label" => "Exibir resumo final do pedido antes do pagamento"],
        ];
        
        foreach($features as $feat) {
            Config::create($feat);
        }
    }
}
