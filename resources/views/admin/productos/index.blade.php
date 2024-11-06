@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de Productos</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h2 class="card-title">Productos</h2>
                    <div class="card-tools">
                        <a href="{{url('admin/productos/create')}}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Crear Nuevo
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover" style="margin-top: 20px;">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" style="text-align: center; width: 10%">ID</th>
                                <th scope="col" style="width: 20%">Producto</th>
                                <th scope="col" style="width: 20%">Categoria</th>
                                <th scope="col" style="text-align: center; width: 10%">Precio</th>
                                <th scope="col" style="text-align: center; width: 10%">Stock</th>
                                <th scope="col" style="text-align: center; width: 10%">Disponible</th>
                                <th scope="col" style="text-align: center; width: 20%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                            <tr>
                                <td style="text-align: center">{{$producto->id_producto}}</td>
                                <td >{{$producto->nombre}}</td>
                                <td >{{$producto->id_categoria}}</td>
                                <td style="text-align: center">{{$producto->precio}}</td>
                                <td style="text-align: center">{{$producto->stock}}</td>
                                <td style="text-align: center">{{$producto->disponible}}</td>
                                <td style="text-align: center">
                                    <div class="btn-group" producto="group" aria-label="Basic example">
                                        <a href="{{url('/admin/productos/'.$producto->id.'/read')}}" class="btn btn-info" style="margin-right: 10px;">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{url('/admin/productos/'.$producto->id.'/edit')}}" class="btn btn-success" style="margin-right: 10px;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{url('/admin/productos',$producto->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Agrega estilos adicionales si es necesario --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
