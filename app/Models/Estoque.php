<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'produtoId');
    }
}
