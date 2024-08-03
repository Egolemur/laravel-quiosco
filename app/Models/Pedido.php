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
    
    public function user() {
        return $this->belongsTo(User::class);
    } // Esto es para que se pueda acceder al usuario que hizo el pedido

    public function productos() {
        return $this->belongsToMany(Producto::class, 'pedido_productos')->withPivot('cantidad');
    } // Esto es para que se pueda acceder a los productos que están en el pedido
}
