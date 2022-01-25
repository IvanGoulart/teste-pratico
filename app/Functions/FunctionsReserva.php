<?php

namespace App\Functions;

use App\Models\Reserva;

class FunctionsReserva
{

    /**
     * Retorna o total reservado do produto
     * 
     */
    public static function getTotalReserva($produtoId, $reserva)
    {
        $reservas = Reserva::where('produtoId', $produtoId)
            ->select('reservaqtd')->get();

        $totalReserva = $reserva;

        foreach ($reservas as $reserva) {
            $totalReserva += $reserva->reservaqtd;
        }

        return $totalReserva;
    }
}
