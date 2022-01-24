<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Estoque;


class ReservaServer extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {

            $estoqueAtual = Estoque::find($request->reserva['produtoId']);

            $reservas = Reserva::where('produtoId',$request->reserva['produtoId'])
            ->select('reservaqtd')->get();

            $totalReserva = $request->reserva['reserva'];

            foreach ($reservas as $reserva) {
                $totalReserva += $reserva->reservaqtd;
            }

            if($estoqueAtual->estoqueqtd < $totalReserva){
                throw new \Exception("Total do estoque menor que a reserva atual.", 1);
            } 

            $reserva = new Reserva;
                
            $reserva->produtoId = $request->reserva['produtoId'];
            $reserva->reservaqtd = $request->reserva['reserva'];

            $reserva->save();

            return ("Produto reservado com sucesso. Produto ID: ".$request->reserva['produtoId'].
                ". Reserva: ".$request->reserva['reserva']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
