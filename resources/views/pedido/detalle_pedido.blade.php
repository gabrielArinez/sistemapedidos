@extends('adminlte::page')
@section('title', 'Detalle Pedido - Au Bon Pain')
<!-- Barra superior -->
@include('client.partials.navbar')  
@section('content_header')
    <h1><b>Detalle del Pedido</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h2 class="card-title">Pedido</h2>
                    <br><br>
                    <a href="{{url('pedido/pedido/')}}" class="btn btn-primary">
                        Realizar Pedido
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" style="margin-top: 20px;">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center" style="min-width: 50px">Imagen</th>
                                    <th scope="col" class="text-center" style="min-width: 150px">Producto</th>
                                    <th scope="col" class="text-center" style="min-width: 50px">Precio</th>
                                    <th scope="col" class="text-center" style="min-width: 50px">Cantidad</th>
                                    <th scope="col" class="text-center" style="min-width: 50px">Descuento</th>
                                    <th scope="col" class="text-center" style="min-width: 50px">Subtotal</th>
                                    <th scope="col" class="text-center" style="min-width: 50px">Acción</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop