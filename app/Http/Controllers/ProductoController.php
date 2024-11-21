<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Promocion;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // OBTENER
        $productos = Producto::all();
        // RETORNAR
        return view('admin.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // OBTENER
        $categorias = Categoria::all();
        $promociones = Promocion::all();
        // RETORNAR 
        return view('admin.productos.create', compact('categorias', 'promociones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // VALIDACIÓN DATOS DE ENTRADA
        $request->validate([
            'nombre' => 'required|max:255',
            'id_categoria' => 'required|exists:categoria_producto,id_categoria',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'disponible' => 'required|boolean',
            'id_promocion' => 'nullable|exists:promociones,id_promocion',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // CREAR 
        $producto = new Producto();
        $producto->id_categoria = $request->id_categoria;
        $producto->id_promocion = $request->id_promocion;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->disponible = $request->disponible;
        $producto->descripcion = $request->descripcion;

        // Manejo de imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $rutaImagen = $imagen->storeAs('productos', $nombreImagen, 'public');
            $producto->imagen = $rutaImagen;
        }

        // GUARDAR
        $producto->save();
        // MENSAJE 
        session()->flash('success', 'Producto creado exitosamente.');
        // REDIRIGIR
        return redirect()->route('admin.productos.index')->with('mensaje', 'Producto creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // OBTENER
        $producto = Producto::find($id);
        // RETORNAR  
        return view('admin.productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // OBTENER
        $producto = Producto::find($id);
        $categorias = Categoria::all();
        $promociones = Promocion::all();
        // RETORNAR  
        return view('admin.productos.edit', compact('producto', 'categorias', 'promociones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // VALIDACIÓN
        $request->validate([
            'nombre' => 'required|max:255',
            'id_categoria' => 'required|exists:categoria_producto,id_categoria',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'disponible' => 'required|boolean',
            'id_promocion' => 'nullable|exists:promociones,id_promocion',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        // BUSQUEDA
        $producto = Producto::find($id);
        // ACTUALIZACIÓN
        $producto->id_categoria = $request->id_categoria;
        $producto->id_promocion = $request->id_promocion;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->disponible = $request->disponible;
        $producto->descripcion = $request->descripcion;

        // Manejo de imagen
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }

            // Guardar nueva imagen
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $rutaImagen = $imagen->storeAs('productos', $nombreImagen, 'public');
            $producto->imagen = $rutaImagen;
        }

        // GUARDAR
        $producto->save();
        // MENSAJE
        session()->flash('success', 'Producto actualizado exitosamente.');
        // REDIRIGIR 
        return redirect()->route('admin.productos.index')->with('mensaje', 'Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // ELIMINAR
        Producto::destroy($id);
        // MENSAJE
        session()->flash('success', 'Producto eliminado exitosamente.');
        // REDIRIGIR
        return redirect()->route('admin.productos.index')->with('mensaje', 'Producto eliminado correctamente');
    }
}
