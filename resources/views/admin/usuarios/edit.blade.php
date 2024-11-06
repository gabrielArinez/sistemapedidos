@extends('adminlte::page')

@section('content_header')
    <h1><b>Editar - Usuario</b></h1>
    <hr></hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Editar - Datos</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/usuarios',$usuario->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input type="text" class="form-control" value="{{$usuario->name}}" name="name">
                                        @error('name')
                                            <small style="...">{{$message}}</small>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-save"></i>
                                        Modificar
                                    </button>
                                    <a href="{{url('/admin/usuarios')}}" class="btn btn-info">Volver</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop