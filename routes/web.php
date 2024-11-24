<?php

use App\Http\Controllers\ClienteAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\AdministradorController::class, 'index'])->name('admin.index1');

Route::get('/administrador', [App\Http\Controllers\AdministradorController::class, 'index'])->name('admin.index1');

Route::get('/crearProducto', [App\Http\Controllers\ProductoController::class, 'create'])->name('admin.productos.create');

// ==================================================== Rutas para CLIENTE ====================================================
// ---------------------------------- INFORMACIÓN ----------------------------------
Route::get('/informacion', [App\Http\Controllers\ClienteController::class, 'info'])->name('client.info');

// ---------------------------------- LOGIN - REGISTER ----------------------------------
// ---------------------------------- LOGIN - REGISTER ----------------------------------
Route::get('cliente/login', [ClienteAuthController::class, 'showLogin'])->name('cliente.login');
Route::post('cliente/login', [ClienteAuthController::class, 'login']);
Route::get('cliente/register', [ClienteAuthController::class, 'showRegister'])->name('cliente.register');
Route::post('cliente/register', [ClienteAuthController::class, 'register']);
Route::post('cliente/logout', [ClienteAuthController::class, 'logout'])->name('cliente.logout');




// ---------------------------------- CATÁLOGO ----------------------------------
Route::get('/catalogo', [App\Http\Controllers\CatalogoController::class, 'index'])->name('client.catalogo.catalogo');

// ---------------------------------- DETALLE PEDIDO ----------------------------------
Route::get('/detalle_pedido', [App\Http\Controllers\DetallePedidoController::class, 'index'])->name('pedido.detalle_pedido');
Route::post('/agregar-al-carrito', [App\Http\Controllers\DetallePedidoController::class, 'agregarAlCarrito'])->name('agregar.carrito');
Route::get('/carrito', [App\Http\Controllers\DetallePedidoController::class, 'verCarrito'])->name('ver.carrito');

// ---------------------------------- PEDIDO ----------------------------------
Route::get('/pedido', [App\Http\Controllers\PedidoController::class, 'index'])->name('pedido.pedido');
Route::post('/finalizar-pedido', [App\Http\Controllers\PedidoController::class, 'finalizarPedido'])->name('finalizar.pedido');
Route::get('/mis-pedidos', [App\Http\Controllers\PedidoController::class, 'misPedidos'])->name('mis.pedidos');


//Route::post('/logout', [UserController::class, 'logout'])->name('logout');
//Route::post('/cliente/logout', [ClienteAuthController::class, 'logout'])->name('cliente.logout');



// ==================================================== Rutas para ROLES ====================================================
//Route::get('/admin/roles', [App\Http\Controllers\ProductoController::class, 'index'])->name('admin.roles.index')->middleware('auth');
// ----------- INDEX -----------
Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index');
// ----------- CREATE -----------
Route::get('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('admin.roles.create');
// ----------- GUARDAR DATOS -----------
Route::post('/admin/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('admin.roles.store');
//RUD routes
// ----------- VER DATOS -----------
Route::get('/admin/roles/{id}/read', [App\Http\Controllers\RoleController::class, 'show'])->name('admin.roles.show');
// ----------- EDITAR DATOS -----------
Route::get('/admin/roles/{id}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('admin.roles.edit');
// ----------- GUARDAR DATOS -----------
Route::put('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('admin.roles.update');
// ----------- ELIMINAR DATOS -----------
Route::delete('/admin/roles/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('admin.roles.destroy');


// ==================================================== Rutas para USUARIOS ====================================================
// ----------- INDEX -----------
Route::get('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('admin.usuarios.index');
// ----------- CREATE -----------
Route::get('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('admin.usuarios.create');
// ----------- GUARDAR DATOS -----------
Route::post('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'store'])->name('admin.usuarios.store');
//RUD routes
// ----------- VER DATOS -----------
Route::get('/admin/usuarios/{id}/read', [App\Http\Controllers\UsuarioController::class, 'show'])->name('admin.usuarios.show');
// ----------- EDITAR DATOS -----------
Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('admin.usuarios.edit');
// ----------- GUARDAR DATOS -----------
Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('admin.usuarios.update');
// ----------- ELIMINAR DATOS -----------
Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy');

// ==================================================== Rutas para PRODUCTOS ====================================================
// ----------- INDEX -----------
Route::get('/admin/productos', [App\Http\Controllers\ProductoController::class, 'index'])->name('admin.productos.index');
// ----------- CREATE -----------
Route::get('/admin/productos/create', [App\Http\Controllers\ProductoController::class, 'create'])->name('admin.productos.create');
// ----------- GUARDAR DATOS -----------
Route::post('/admin/productos/create', [App\Http\Controllers\ProductoController::class, 'store'])->name('admin.productos.store');
//RUD routes
// ----------- VER DATOS -----------
Route::get('/admin/productos/{id}/read', [App\Http\Controllers\ProductoController::class, 'show'])->name('admin.productos.show');
// ----------- EDITAR DATOS -----------
Route::get('/admin/productos/{id}/edit', [App\Http\Controllers\ProductoController::class, 'edit'])->name('admin.productos.edit');
// ----------- GUARDAR DATOS -----------
Route::put('/admin/productos/{id}', [App\Http\Controllers\ProductoController::class, 'update'])->name('admin.productos.update');
// ----------- ELIMINAR DATOS -----------
Route::delete('/admin/productos/{id}', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('admin.productos.destroy');
