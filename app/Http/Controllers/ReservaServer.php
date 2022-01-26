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

            foreach ($request->reserva as $reserva) {

                /**
                 * Validação de pedido
                 */
                FunctionsEstoque::validaPedido($reserva['numero_do_pedido']);
                /**
                 * validação de produtos
                 */
                FunctionsEstoque::validaProduto($reserva['produtoId'], $reserva['numero_do_pedido']);

                $estoqueAtual = FunctionsEstoque::getEstoqueAtual($reserva['produtoId']);

                $totalReserva = FunctionsReserva::getTotalReserva($reserva['produtoId'], $reserva['reserva']);

                if ($estoqueAtual < $totalReserva) {
                    throw new \Exception("Total do estoque menor que a reserva atual. Reservados: " . $totalReserva
                        . " estoque: " . $estoqueAtual, 1);
                }

                $criarReserva = new Reserva;

                $criarReserva->produtoId = $reserva['produtoId'];
                $criarReserva->reservaqtd = $reserva['reserva'];
                $criarReserva->numero_do_pedido = $reserva['numero_do_pedido'];

                $criarReserva->save();
            }


            return ("Produto reservado com sucesso.");
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
