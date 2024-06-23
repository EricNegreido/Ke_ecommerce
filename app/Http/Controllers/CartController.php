<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $cart = []; // caso donde usuario no esta autenticado o no tiene articulo
        if(Auth::check()){
            $cart = Cart::where('user_id', Auth::id())->get();
        }
        return view('cart.index', compact('cart'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);
        if(Auth::check()){
            $cart = new Cart();
            $cart->user_id = Auth::id();
            $cart->product_id = $validated['id'];
            $cart->quantity =  $validated['quantity'];
            $cart->save();
            return "Se agrego un producto";  
        }
    return "No se pudo agregar el producto";  


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $validated = $request->validate([
            'id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart->quantity =  $validated['quantity'];
        $cart->update();

        return "Se Actualizo el Carrito"; 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cart $cart)
    {
        $cart->delete();

        return "Se Elimino el Carrito"; 
    }
}
