<?php

namespace App\Http\Controllers;

use App\Http\Resources\PedidoCollection;
use Carbon\Carbon;
use App\Models\Pedido;
use App\Models\PedidoProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PedidoCollection(Pedido::with('user')->with('productos')->where('estado', 0)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Almacena el pedido en la base de datos
        $pedido = Pedido::create([
            'user_id' => Auth::user()->id,
            'total' => $request->total,        
        ]);

        // Obtener el ID del pedido
        $id = $pedido->id;

        // Obtener los productos del pedido
        $productos = $request->productos;

        // Formatear un arreglo de productos para guardarlos en la base de datos
        $pedido_productos = [];

        foreach ($productos as $producto) {
            $pedido_productos[] = [
                'pedido_id' => $id,
                'producto_id' => $producto['id'],
                'cantidad' => $producto['cantidad'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        // Guardar los productos en la base de datos
        PedidoProducto::insert($pedido_productos); // Con el metodo insert se puede guardar varios registros a la vez
        
        // Devolver un mensaje de confirmación
        return [
            'message' => 'Pedido creado correctamente.'
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        $pedido->estado = 1;
        $pedido->save();
        return [
            'pedido' => $pedido
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
