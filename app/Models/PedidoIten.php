<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoIten extends Model
{
    use HasFactory;

    public function pedido()
    {
        return $this->hasOne(Pedido::class, 'numero_do_pedido', 'numero_do_pedido');
    }
}
