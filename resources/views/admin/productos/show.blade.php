@extends('adminlte::page')

@section('content_header')
    <h1><b>Detalle - Producto</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Nombre del Producto -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" value="{{$producto->nombre}}" name="name" readonly>
                            </div>
                        </div>

                        <!-- Categoría -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categoria">Categoría</label>
                                <input type="text" class="form-control" value="{{$producto->categoria_producto->categoria ?? 'N/A'}}" name="categoria" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Precio -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input type="text" class="form-control" value="{{$producto->precio}}" name="precio" readonly>
                            </div>
                        </div>

                        <!-- Stock -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="text" class="form-control" value="{{$producto->stock}}" name="stock" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Disponible -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="disponible">Disponible</label>
                                <input type="text" class="form-control" value="{{$producto->disponible ? 'Sí' : 'No'}}" name="disponible" readonly>
                            </div>
                        </div>

                        <!-- Promoción -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="promocion">Promoción</label>
                                <input type="text" class="form-control" value="{{$producto->promociones->nombre ?? 'N/A'}}" name="promocion" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Imagen -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Imagen</label>
                                <div class="mt-2">
                                    @if($producto->imagen)
                                        <img src="{{ asset('storage/' . $producto->imagen) }}" 
                                             alt="{{ $producto->nombre }}" 
                                             class="img-fluid" 
                                             style="max-width: 150px; max-height: 150px; object-fit: contain;">
                                    @else
                                        <p class="text-muted">No hay imagen disponible</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <input type="text" class="form-control" value="{{$producto->descripcion}}" name="descripcion" readonly>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{url('/admin/productos')}}" class="btn btn-info">Volver</a>
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
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
