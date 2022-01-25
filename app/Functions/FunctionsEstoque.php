<?php

namespace App\Functions;

use App\Models\Estoque;

class FunctionsEstoque
{

    /**
     * Retorna o estoque atual
     * 
     */
    public static function getEstoqueAtual($produtoId)
    {
        $estoqueAtual = Estoque::find($produtoId);

        return $estoqueAtual;
    }
}
