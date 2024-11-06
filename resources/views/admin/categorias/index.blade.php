@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de Categorias</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h2 class="card-title">Roles</h2>
                    <div class="card-tools">
                        <a href="{{url('admin/roles/create')}}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Crear Nuevo
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover" style="margin-top: 20px;">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" style="text-align: center; width: 10%">ID</th>
                                <th scope="col" style="width: 70%">Rol</th>
                                <th scope="col" style="text-align: center; width: 20%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td style="text-align: center">{{$role->id}}</td>
                                <td>{{$role->name}}</td>
                                <td style="text-align: center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{url('/admin/roles/'.$role->id.'/read')}}" class="btn btn-info" style="margin-right: 10px;">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{url('/admin/roles/'.$role->id.'/edit')}}" class="btn btn-success" style="margin-right: 10px;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{url('/admin/roles',$role->id)}}" method="POST">
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
