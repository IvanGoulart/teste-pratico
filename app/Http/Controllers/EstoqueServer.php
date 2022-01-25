<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Functions\FunctionsEstoque;
use App\Functions\FunctionsReserva;
use App\Models\Reserva;
use Illuminate\Http\Request;

class EstoqueServer extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

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

            return "Estoque atualizado com sucesso";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
