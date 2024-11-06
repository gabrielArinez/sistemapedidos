@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de Usuarios</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h1 class="card-title">Usuarios</h1>
                    <div class="card-tools">
                        <a href="{{url('admin/usuarios/create')}}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Crear Nuevo
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover" style="margin-top: 20px;">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" style="text-align: center; width: 10%">ID</th>
                                <th scope="col" style="width: 20%">Rol</th>
                                <th scope="col" style="width: 50%">Nombre</th>
                                <th scope="col" style="text-align: center; width: 20%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                            <tr>
                                <td style="text-align: center">{{$usuario->id}}</td>
                                <td>{{$usuario->roles->pluck('name')->implode(', ')}}</td>
                                <td>{{$usuario->name}}</td>
                                <td style="text-align: center">
                                    <div class="btn-group" usuario="group" aria-label="Basic example">
                                        <a href="{{url('/admin/usuarios/'.$usuario->id.'/read')}}" class="btn btn-info" style="margin-right: 10px;">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{url('/admin/usuarios/'.$usuario->id.'/edit')}}" class="btn btn-success" style="margin-right: 10px;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{url('/admin/usuarios',$usuario->id)}}" method="POST">
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
