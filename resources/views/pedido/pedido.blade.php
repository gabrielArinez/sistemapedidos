@extends('adminlte::page')
@section('title', 'Pedidos - Au Bon Pain')
<!-- Barra superior -->
@include('client.partials.navbar')  
@section('content_header')
    <h1><b>Listado de Pedidos</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Mis Pedidos</h3>
                </div>
                <div class="card-body">
                    @if($pedidos->count() > 0)
                        @foreach($pedidos as $pedido)
                            <div class="card mb-3">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col">
                                            <h5>Pedido #{{ $pedido->id_pedido }}</h5>
                                        </div>
                                        <div class="col text-right">
                                            <span class="badge badge-primary">{{ $pedido->estado->estado }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Producto</th>
                                                    <th class="text-center">Cantidad</th>
                                                    <th class="text-right">Precio</th>
                                                    <th class="text-right">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pedido->detalles as $detalle)
                                                    <tr>
                                                        <td>{{ $detalle->producto->nombre }}</td>
                                                        <td class="text-center">{{ $detalle->cantidad }}</td>
                                                        <td class="text-right">Bs. {{ number_format($detalle->precio_unitario, 2) }}</td>
                                                        <td class="text-right">Bs. {{ number_format($detalle->subtotal, 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                                    <td class="text-right"><strong>Bs. {{ number_format($pedido->total, 2) }}</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-muted">
                                            Fecha: {{ \Carbon\Carbon::parse($pedido->fecha_pedido)->format('d/m/Y H:i') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center">
                            <p>No hay pedidos realizados</p>
                            <a href="{{ route('client.catalogo.catalogo') }}" class="btn btn-primary">
                                Ir al Catálogo
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop