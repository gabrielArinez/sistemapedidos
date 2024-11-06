@extends('adminlte::page')

@section('content_header')
    <h1><b>Crear - Usuario</b></h1>
    <hr></hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ingrese los Datos</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('admin/usuarios/create')}}" method="POST">  
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                        <label for="role">Rol</label>
                                        <select name="role" id="" class="form-control">
                                            @foreach($roles as $role)
                                                <option value="{{$role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input type="text" class="form-control" value="{{old('name')}}" name="name" required>
                                        @error('name')
                                            <small style="...">{{$message}}</small>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <input type="password" class="form-control" value="{{old('password')}}" name="password" required>
                                        @error('password')
                                            <small style="...">{{$message}}</small>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i>
                                        Registrar
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