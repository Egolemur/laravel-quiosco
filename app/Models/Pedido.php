<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    // Los campos que se pueden asignar en masa.
    protected $fillable = [
        'user_id',
        'total'        
    ];
}
