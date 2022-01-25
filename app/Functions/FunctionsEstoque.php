<?php

namespace App\Functions;

use App\Models\Estoque;
use App\Models\Pedido;

class FunctionsEstoque
{
    /**
     * Retorna o estoque atual
     * 
     */
    public static function getEstoqueAtual($produtoId) : int
    {
        $estoqueAtual = Estoque::find($produtoId);

        if (empty($estoqueAtual)) {
            return "Produto " . $produtoId . " não existe para este pedido";
        }

        return $estoqueAtual->estoqueqtd;
    }

    /**
     * Verifica se o pedido existe
     */

    public static function validaPedido($numero_do_pedido)
    {
        $buscaNumeroDoPedido = Pedido::where('numero_do_pedido', $numero_do_pedido)->first();

        if (empty($buscaNumeroDoPedido)) {
            throw new \Exception("Pedido " . $numero_do_pedido . " não encontrado.", 1);
        }
    }

    /**
     * Verifica de o produto existe para o pedido
     * 
     */
    public static function validaProduto($produtoId, $numero_do_pedido)
    {

        $validaProduto = Pedido::with('itens')->whereHas('itens', function ($query) use ($produtoId, $numero_do_pedido) {
            $query->where('produtoId', $produtoId);
        })->where('numero_do_pedido', $numero_do_pedido)->first();

        if (empty($validaProduto)) {
            throw new \Exception("Produto " . $produtoId . " não encontrado para o pedido: " . $numero_do_pedido, 1);
        }
    }
}
