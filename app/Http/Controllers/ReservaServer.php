<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Functions\FunctionsEstoque;
use App\Functions\FunctionsReserva;

class ReservaServer extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            /**
             * Validação de pedido
             */
            FunctionsEstoque::validaPedido($request->reserva['numero_do_pedido']);
            /**
             * validação de produtos
             */
            FunctionsEstoque::validaProduto($request->reserva['produtoId'], $request->reserva['numero_do_pedido']);

            $estoqueAtual = FunctionsEstoque::getEstoqueAtual($request->reserva['produtoId']);
            $totalReserva = FunctionsReserva::getTotalReserva($request->reserva['produtoId'], $request->reserva['reserva']);

            if ($estoqueAtual < $totalReserva) {
                throw new \Exception("Total do estoque menor que a reserva atual. Reservados: " . $totalReserva
                    . " estoque: " . $estoqueAtual, 1);
            }

            $reserva = new Reserva;

            $reserva->produtoId = $request->reserva['produtoId'];
            $reserva->reservaqtd = $request->reserva['reserva'];
            $reserva->numero_do_pedido = $request->reserva['numero_do_pedido'];

            $reserva->save();

            return ("Produto reservado com sucesso." . " Pedido: " . $request->reserva['numero_do_pedido'] . " Produto ID: " . $request->reserva['produtoId'] .
                ". Reserva: " . $request->reserva['reserva']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
