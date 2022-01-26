<?php

namespace App\Functions;

use App\Models\Reserva;

class FunctionsReserva
{

    /**
     * Retorna o total reservado do produto
     * 
     */
    public static function getTotalReserva($produtoId, $reserva = 0) : int
    {
        $reservas = Reserva::where('produtoId', $produtoId)
            ->select('reservaqtd')->get();

        $totalReserva = $reserva;

        foreach ($reservas as $reserva) {
            $totalReserva += $reserva->reservaqtd;
        }

        return $totalReserva;
    }

    public static function atualizaEstoque($produtoId)
    {
        Reserva::where('produtoId', $produtoId)
            ->update(['baixa_no_estoque' => true]);
    }
}
