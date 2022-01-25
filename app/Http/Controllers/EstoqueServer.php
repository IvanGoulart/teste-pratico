<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Functions\FunctionsEstoque;
use App\Functions\FunctionsReserva;
use App\Models\Reserva;
use App\Repositories\RepositoryEstoqueInterface;
use Illuminate\Http\Request;

class EstoqueServer extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function finalizar(Request $request)
    {

        $produtosReservados = Reserva::select('produtoId')
            ->where('baixa_no_estoque', false)
            ->groupBy('produtoId')->get();

        try {
            foreach ($produtosReservados as $reserva) {

                $totalReserva = FunctionsReserva::getTotalReserva($reserva->produtoId);
                $buscaEstoque = FunctionsEstoque::getEstoqueAtual($reserva->produtoId);

                Estoque::where('id', $reserva->produtoId)
                    ->update(['estoqueqtd' => $buscaEstoque - $totalReserva]);

                FunctionsReserva::atualizaEstoque($reserva->produtoId, $request->numero_do_pedido);
            }

            return "Estoque atualizado com sucesso para as reservas do pedido: " . $request->numero_do_pedido;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
