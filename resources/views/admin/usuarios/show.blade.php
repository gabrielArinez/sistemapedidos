@extends('adminlte::page')

@section('content_header')
    <h1><b>Detalle - Usuario</b></h1>
    <hr></hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos</h3>
                </div>
                <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                        <label for="name">Nombre del Rol</label>
                                        <input type="text" class="form-control" value="{{$usuario->name}}" name="name" readonly>
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
                                    <a href="{{url('/admin/usuarios')}}" class="btn btn-info">Volver</a>
                                </div>
                            </div>
                        </div>
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