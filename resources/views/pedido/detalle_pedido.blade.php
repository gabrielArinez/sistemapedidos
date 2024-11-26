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
                    <h2 class="card-title">Carrito de Compras</h2>
                </div>

                <div class="card-body">

                    @if(count($carrito) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">Imagen</th>
                                        <th class="text-center">Producto</th>
                                        <th class="text-center">Precio</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Subtotal</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($carrito as $id_producto => $item)
                                    @if(isset($item['producto']))
                                        <tr>
                                            <td class="text-center">
                                                @if($item['producto']->imagen)
                                                    <img src="{{ asset('storage/' . $item['producto']->imagen) }}" 
                                                         alt="{{ $item['producto']->nombre }}" 
                                                         style="max-height: 50px;">
                                                @else
                                                    <img src="{{ asset('storage/productos/default.png') }}" 
                                                         alt="Imagen no disponible" 
                                                         style="max-height: 50px;">
                                                @endif
                                            </td>
                                            <td>{{ $item['producto']->nombre }}</td>
                                            <td class="text-right">Bs. {{ number_format($item['precio_unitario'], 2) }}</td>
                                            <td class="text-center">
                                                <input type="number" 
                                                       class="form-control cantidad-input" 
                                                       value="{{ $item['cantidad'] }}"
                                                       min="1"
                                                       data-id="{{ $id_producto }}">
                                            </td>
                                            <td class="text-right">Bs. {{ number_format($item['subtotal'], 2) }}</td>
                                            
                                            <td class="text-center">
                                                <form action="{{ route('carrito.eliminar', $id_producto) }}" 
                                                      method="POST" 
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('¿Está seguro?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>Total:</strong></td>
                                        <td class="text-right"><strong>Bs. {{ number_format($total, 2) }}</strong></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        <div class="text-right mt-3">
                            <a href="{{ route('client.catalogo.catalogo') }}" class="btn btn-secondary">
                                Seguir Comprando
                            </a>
                            <form action="{{ route('pedido.finalizar') }}" method="POST" style="display: inline;">
                                @csrf
                            <button type="submit" class="btn btn-primary">
                                Finalizar Pedido
                            </button>
                        </form>

                        </div>
                    @else
                        <div class="text-center">
                            <p>No hay productos en el carrito</p>
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

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
<script>
$(document).ready(function() {
    $('.cantidad-input').change(function() {
        const id_producto = $(this).data('id');
        const cantidad = $(this).val();
        
        $.ajax({
            url: '{{ route("carrito.actualizar") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id_producto: id_producto,
                cantidad: cantidad
            },
            success: function(response) {
                if(response.success) {
                    location.reload();
                }
            }
        });
    });

    $('form[action="{{ route("pedido.finalizar") }}"]').on('submit', function(e) {
        e.preventDefault();
        const form = this;
        
        Swal.fire({
            title: '¿Está seguro?',
            text: "¿Desea finalizar el pedido?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, finalizar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
});
</script>
@stop