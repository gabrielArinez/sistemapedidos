<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function index()
    {
        // Productos 
        $menuConfig = config('adminlte_clientes.menu');
        config(['adminlte.menu' => $menuConfig]);

        $products = Producto::all();
        $categories = Categoria::all();
        return view('client.catalogo.catalogo', compact('products', 'categories'));
    }
    public function categorias()
    {
        // Productos 
        $menuConfig = config('adminlte_clientes.menu');
        config(['adminlte.menu' => $menuConfig]);

        $categories = Categoria::all();
        return view('client.catalogo.catalogo', compact('categories'));
    }
}
