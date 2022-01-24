<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estoque;
use Illuminate\Support\Facades\DB;

class PedidosSeeder extends Seeder
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
            DB::table('pedidos')->insert([
                'produtoId' => $estoque->id,
                'qtd' => $estoque->estoqueqtd,
                'created_at' => now()
            ]);
        }
    }
}
