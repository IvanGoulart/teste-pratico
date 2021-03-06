<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function itens()
    {
        return $this->hasMany(PedidoIten::class, 'numero_do_pedido', 'numero_do_pedido');
    }

}
