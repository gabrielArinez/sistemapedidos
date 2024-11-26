<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PedidoController extends Controller
{
    public function index()
    {
        // Configurar menú
        $menuConfig = config('adminlte_clientes.menu');
        config(['adminlte.menu' => $menuConfig]);

        // Obtener pedidos del cliente autenticado
        $pedidos = Pedido::where('id_cliente', Auth::guard('cliente')->id())
            ->orderBy('fecha_pedido', 'desc')
            ->with(['estado', 'detalles.producto'])
            ->get();

        return view('pedido.pedido', compact('pedidos'));
    }

    public function finalizarPedido(Request $request)
    {
        // Verificar autenticación
        if (!Auth::guard('cliente')->check()) {
            return redirect()->route('cliente.login')
                ->with('error', 'Debe iniciar sesión para finalizar el pedido');
        }


        // Obtener carrito
        $carrito = session()->get('carrito', []);

        // Verificar si hay productos en el carrito
        if (empty($carrito)) {
            return redirect()->back()
                ->with('error', 'No hay productos en el carrito');
        }

        try {
            DB::beginTransaction();

            // Crear pedido
            $pedido = new Pedido();
            $pedido->id_cliente = Auth::guard('cliente')->id();
            $pedido->id_estado = 1;
            $pedido->id_prioridad = 6;
            $pedido->fecha_pedido = now();
            $pedido->total = 0;
            $pedido->fecha_entrega = $request->fecha_entrega;
            $pedido->hora_entrega = $request->fecha_entrega;

            // Guardar el pedido
            $pedido->save();

            if (!$pedido->save()) {
                throw new \Exception('Error al guardar el pedido');
            }
            $total = 0;

            // MENSAJE 
            session()->flash('success', 'Pedido creado exitosamente.');

            // Crear detalles del pedido
            foreach ($carrito as $id_producto => $item) {
                $producto = Producto::find($id_producto);
                if (!$producto) {
                    throw new \Exception("Producto no encontrado: {$id_producto}");
                }

                // Calcular precio con descuento
                $descuento = $producto->promociones ? $producto->promociones->descuento : 0;
                $precioConDescuento = $producto->precio * (1 - $descuento / 100);
                $subtotal = $precioConDescuento * $item['cantidad'];

                // Crear detalle
                $detallePedido  = new DetallePedido();
                $detallePedido->id_pedido = $pedido->id_pedido;
                $detallePedido->id_producto = $id_producto;
                $detallePedido->cantidad = $item['cantidad'];
                $detallePedido->precio_unitario = $item['precio_unitario'];
                $detallePedido->subtotal = $item['cantidad'] * $item['precio_unitario'];

                // Guardar el detalle
                $detallePedido->save();

                // MENSAJE 
                session()->flash('success', 'Detalle Pedido creado exitosamente.');

                if (!$detallePedido->save()) {
                    throw new \Exception('Error al guardar el detalle del pedido');
                }

                $total += $subtotal;

                // Actualizar el stock del producto si es necesario
                $producto->stock -= $item['cantidad'];
                $producto->save();
            }

            // Actualizar total del pedido
            $pedido->total = $total;
            $pedido->save();
            if (!$pedido->save()) {
                throw new \Exception('Error al actualizar el total del pedido');
            }

            DB::commit();

            // Limpiar carrito
            session()->forget('carrito');

            return redirect()->route('pedido.pedido')->with('success', 'Pedido realizado con éxito');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al finalizar pedido: ' . $e->getMessage());

            // Log adicional para debugging
            Log::error('Detalles del error:', [
                'mensaje' => $e->getMessage(),
                'archivo' => $e->getFile(),
                'linea' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Error al procesar el pedido: ' . $e->getMessage());
        }
    }
}
