@extends('adminlte::page')
@section('title', 'Pedidos - Au Bon Pain')
@include('client.partials.navbar')  

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0 text-dark"><i class="fas fa-shopping-basket"></i>   Mis Pedidos</h1>
        <a href="{{ route('client.catalogo.catalogo') }}" class="btn btn-outline-primary">
            <i class="fas fa-plus-circle mr-1"></i>Nuevo Pedido
        </a>
    </div>
    <br>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if($pedidos->count() > 0)
                    <div class="card card-info card-outline shadow-sm">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Pedido</th>
                                            <th>Fecha</th>
                                            <th>Total</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pedidos as $pedido)
                                            <tr data-toggle="modal" data-target="#pedidoModal{{ $pedido->id_pedido }}" class="cursor-pointer">
                                                <td class="text-info">
                                                    <strong>#{{ $pedido->id_pedido }}</strong>
                                                    <small class="d-block text-muted">{{ $pedido->detalles->count() }} productos</small>
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($pedido->fecha_pedido)->locale('es')->format('d/m/Y') }}
                                                    <small class="d-block text-muted">
                                                        {{ \Carbon\Carbon::parse($pedido->fecha_pedido)->diffForHumans() }}
                                                    </small>
                                                </td>
                                                <td class="text-info">
                                                    Bs. {{ number_format($pedido->total, 2) }}
                                                </td>
                                                <td>
                                                    <span class="badge badge-{{ $pedido->estado->color ?? 'secondary' }}">
                                                        {{ $pedido->estado->estado }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{ $pedidos->links('vendor.pagination.bootstrap-4') }}
                @else
                    <div class="card card-outline card-primary">
                        <div class="card-body text-center">
                            <h3>Aún no tienes pedidos</h3>
                            <p class="text-muted">Explora nuestro catálogo y realiza tu primer pedido</p>
                            <a href="{{ route('client.catalogo.catalogo') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-shopping-bag mr-2"></i>Ir al Catálogo
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modales para detalles de pedidos -->
    @foreach($pedidos as $pedido)
        <div class="modal fade" id="pedidoModal{{ $pedido->id_pedido }}" tabindex="-1" >
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title">
                            <i class="fas fa-shopping-bag mr-2"></i>Pedido #{{ $pedido->id_pedido }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-info">Detalles del Pedido</h6>
                                <table class="table table-sm">
                                    <tr>
                                        <td>Fecha de Pedido:</td>
                                        <td>{{ \Carbon\Carbon::parse($pedido->fecha_pedido)->locale('es')->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Fecha de Entrega:</td>
                                        <td>{{ \Carbon\Carbon::parse($pedido->fecha_entrega)->locale('es')->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Hora de Entrega:</td>
                                        <td>{{ \Carbon\Carbon::parse($pedido->hora_entrega)->locale('es')->format('H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-info">Estado</h6>
                                <span class="badge badge-{{ $pedido->estado->color ?? 'secondary' }} p-2">
                                    {{ $pedido->estado->estado }}
                                </span>
                            </div>
                        </div>

                        <hr>

                        <h6 class="text-info">Productos</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
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
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@stop

@section('css')
<style>
    .cursor-pointer {
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .cursor-pointer:hover {
        background-color: rgba(0,0,0,0.05);
    }
</style>
@stop