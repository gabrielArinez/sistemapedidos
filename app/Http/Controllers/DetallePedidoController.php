<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use App\Models\DetallePedido;
use Illuminate\Http\Request;

class DetallePedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener el menu del cliente  
        $menuConfig = config('adminlte_clientes.menu');
        config(['adminlte.menu' => $menuConfig]);

        // Obtener el carrito de la sesión
        $carrito = session()->get('carrito', []);
        $total = 0;

        // Procesar cada item del carrito
        foreach ($carrito as $id_producto => &$item) {
            // Obtener el producto
            $producto = Producto::find($id_producto);
            if ($producto) {
                // Agregar el objeto producto completo al item del carrito
                $item['producto'] = $producto;
                // Calcular el precio con descuento
                $descuento = $producto->promociones ? $producto->promociones->descuento : 0;
                $precioConDescuento = $producto->precio * (1 - $descuento / 100);
                // Actualizar el subtotal
                $item['subtotal'] = $precioConDescuento * $item['cantidad'];
                $total += $item['subtotal'];
            }
        }

        return view('pedido.detalle_pedido', compact('carrito', 'total'));
    }
    public function agregarAlCarrito(Request $request)
    {
        $producto = Producto::find($request->id_producto);
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $carrito = session()->get('carrito', []);

        // Si el producto ya está en el carrito, actualizar cantidad
        if (isset($carrito[$request->id_producto])) {
            $carrito[$request->id_producto]['cantidad'] += $request->cantidad;
        } else {
            // Si no, agregar nuevo item
            $carrito[$request->id_producto] = [
                'id_producto' => $request->id_producto,
                'cantidad' => $request->cantidad,
                'precio_unitario' => $producto->precio
            ];
        }

        session()->put('carrito', $carrito);
        return response()->json(['success' => true]);
    }
    public function eliminarDelCarrito($id_producto)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id_producto])) {
            unset($carrito[$id_producto]);
            session()->put('carrito', $carrito);
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }
    public function actualizarCantidad(Request $request)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$request->id_producto])) {
            $carrito[$request->id_producto]['cantidad'] = $request->cantidad;
            session()->put('carrito', $carrito);
        }

        return response()->json(['success' => true]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
