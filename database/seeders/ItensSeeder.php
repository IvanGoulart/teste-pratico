<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estoque;
use Illuminate\Support\Facades\DB;

class ItensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $estoques = Estoque::all();

        foreach ($estoques as $estoque) {
            DB::table('pedido_itens')->insert([
                'numero_do_pedido' => 10,
                'produtoId' => $estoque->id,
                'qtd' => $estoque->estoqueqtd - 10,
                'created_at' => now()
            ]);
        }
    }
}
