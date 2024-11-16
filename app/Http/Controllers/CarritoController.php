<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Producto;

use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function add($id)
    {
        $product = Producto::find($id);

        if (!$product) {
            return redirect()->route('catalog')->with('error', 'Producto no encontrado.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('client.catalogo.catalogo')->with('success', 'Producto agregado al carrito.');
    }
}
