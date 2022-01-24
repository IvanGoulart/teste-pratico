<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EstoquesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            DB::table('estoques')->insert([
                'produto' => Str::random(10),
                'estoqueqtd' => sprintf("%03d", mt_rand(1, 1000)),
                'created_at' => now()
            ]);
        }
    }
}
