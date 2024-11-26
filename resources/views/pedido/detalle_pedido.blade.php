@extends('adminlte::page')
@section('title', 'Detalle Pedido - Au Bon Pain')
@include('client.partials.navbar')  

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0 text-dark"><b>Detalle del Pedido</b></h1>
    </div>
<br>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info shadow-sm">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-shopping-cart mr-2"></i>Carrito de Compras</h3>
                </div>

                <div class="card-body">
                    @if(count($carrito) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center align-middle" style="width: 10%;">Imagen</th>
                                        <th class="text-left align-middle">Producto</th>
                                        <th class="text-center align-middle" style="width: 15%;">Precio</th>
                                        <th class="text-center align-middle" style="width: 15%;">Cantidad</th>
                                        <th class="text-center align-middle" style="width: 15%;">Subtotal</th>
                                        <th class="text-center align-middle" style="width: 10%;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($carrito as $id_producto => $item)
                                    @if(isset($item['producto']))
                                        <tr>
                                            <td class="text-center align-middle">
                                                @if($item['producto']->imagen)
                                                    <img src="{{ asset('storage/' . $item['producto']->imagen) }}" 
                                                         alt="{{ $item['producto']->nombre }}" 
                                                         class="img-fluid rounded" 
                                                         style="max-height: 70px; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('storage/productos/default.png') }}" 
                                                         alt="Imagen no disponible" 
                                                         class="img-fluid rounded" 
                                                         style="max-height: 70px; object-fit: cover;">
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                <strong>{{ $item['producto']->nombre }}</strong>
                                                <small class="d-block text-muted">{{ $item['producto']->descripcion }}</small>
                                            </td>
                                            <td class="text-center align-middle text-primary">
                                                <strong>Bs. {{ number_format($item['precio_unitario'], 2) }}</strong>
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="input-group input-group-sm quantity-selector">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-outline-secondary btn-cantidad" 
                                                                type="button" 
                                                                data-action="minus" 
                                                                data-id="{{ $id_producto }}">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="number" 
                                                           class="form-control text-center cantidad-input" 
                                                           value="{{ $item['cantidad'] }}"
                                                           min="1"
                                                           max="50"
                                                           data-id="{{ $id_producto }}">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary btn-cantidad" 
                                                                type="button" 
                                                                data-action="plus" 
                                                                data-id="{{ $id_producto }}">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle text-success">
                                                <strong>Bs. {{ number_format($item['subtotal'], 2) }}</strong>
                                            </td>
                                            
                                            <td class="text-center align-middle">
                                                <form action="{{ route('carrito.eliminar', $id_producto) }}" 
                                                      method="POST" 
                                                      class="form-eliminar"
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-danger btn-sm btn-eliminar"
                                                            data-nombre="{{ $item['producto']->nombre }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bg-light">
                                        <td colspan="4" class="text-right">
                                            <strong class="h5">Total:</strong>
                                        </td>
                                        <td colspan="2" class="text-left text-primary">
                                            <strong class="h4">Bs. {{ number_format($total, 2) }}</strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card card-outline card-info">
                                    <div class="card-header">
                                        <h3 class="card-title"><i class="fas fa-store mr-2"></i>Detalles de Entrega</h3>
                                    </div>
                                    <div class="card-body">
                                        <form id="order-form" action="{{ route('pedido.finalizar') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fecha_entrega" class="font-weight-bold">
                                                            <i class="fas fa-calendar-alt mr-2 text-primary"></i>Fecha de Entrega
                                                        </label>
                                                        <input type="date" 
                                                               class="form-control @error('fecha_entrega') is-invalid @enderror" 
                                                               name="fecha_entrega" 
                                                               id="fecha_entrega" 
                                                               required>
                                                        @error('fecha_entrega')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                            
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="hora_entrega" class="font-weight-bold">
                                                            <i class="fas fa-clock mr-2 text-primary"></i>Hora de Entrega
                                                        </label>
                                                        <input type="time" 
                                                               class="form-control @error('hora_entrega') is-invalid @enderror" 
                                                               name="hora_entrega" 
                                                               id="hora_entrega" 
                                                               required
                                                               min="07:00"
                                                               max="20:00">
                                                        @error('hora_entrega')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                            
                                            @if(session('error'))
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                            
                                            <div class="d-flex justify-content-between mt-3">
                                                <a href="{{ route('client.catalogo.catalogo') }}" class="btn btn-outline-secondary">
                                                    <i class="fas fa-chevron-left mr-2"></i>Seguir Comprando
                                                </a>
                                                <button type="submit" class="btn btn-primary btn-finalizar">
                                                    Finalizar Pedido <i class="fas fa-check ml-2"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <h3 class="text-muted">No hay productos en el carrito</h3>
                            <p class="text-secondary">Parece que aún no has agregado productos a tu carrito.</p>
                            <a href="{{ route('client.catalogo.catalogo') }}" class="btn btn-primary mt-3">
                                <i class="fas fa-shopping-bag mr-2"></i>Ir al Catálogo
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<style>
    .quantity-selector input::-webkit-outer-spin-button,
    .quantity-selector input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .quantity-selector input[type=number] {
        -moz-appearance: textfield;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
<script>
$(document).ready(function() {
    // Quantity Validation
    $('.cantidad-input').on('input', function() {
        const val = parseInt($(this).val());
        const min = parseInt($(this).attr('min'));
        const max = parseInt($(this).attr('max'));

        if (isNaN(val) || val < min) {
            $(this).val(min);
        } else if (val > max) {
            $(this).val(max);
            Swal.fire({
                icon: 'warning',
                title: 'Límite de Cantidad',
                text: `Solo puedes agregar hasta ${max} unidades de este producto.`,
                confirmButtonText: 'Entendido'
            });
        }
    });

    // Quantity update with plus and minus buttons
    $('.btn-cantidad').click(function() {
        const input = $(this).closest('.input-group').find('.cantidad-input');
        const id_producto = input.data('id');
        let cantidad = parseInt(input.val());
        const max = parseInt(input.attr('max'));
        
        if ($(this).data('action') === 'plus') {
            cantidad = Math.min(cantidad + 1, max);
        } else {
            cantidad = Math.max(1, cantidad - 1);
        }
        
        input.val(cantidad);
        updateCart(id_producto, cantidad);
    });

    // Date Validation
    function validateDate() {
        const today = new Date();
        const selectedDate = new Date($("#fecha_entrega").val());
        const maxDate = new Date(today);
        maxDate.setDate(today.getDate() + 30);

        // Check if selected date is a Sunday
        if (selectedDate.getDay() === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Fecha Inválida',
                text: 'Lo sentimos, no trabajamos los domingos. Por favor, seleccione otro día.',
                confirmButtonText: 'Entendido'
            });
            $("#fecha_entrega").val('');
            return false;
        }

        // Validate date range
        if (selectedDate < today) {
            Swal.fire({
                icon: 'error',
                title: 'Fecha Inválida',
                text: 'No puedes seleccionar una fecha anterior a hoy.',
                confirmButtonText: 'Entendido'
            });
            $("#fecha_entrega").val('');
            return false;
        }

        if (selectedDate > maxDate) {
            Swal.fire({
                icon: 'error',
                title: 'Fecha Fuera de Rango',
                text: 'Solo puedes seleccionar una fecha dentro de los próximos 30 días.',
                confirmButtonText: 'Entendido'
            });
            $("#fecha_entrega").val('');
            return false;
        }

        return true;
    }

    // Time Validation
    function validateTime() {
        const selectedTime = $("#hora_entrega").val();
        const minTime = "07:00";
        const maxTime = "20:00";

        if (selectedTime < minTime || selectedTime > maxTime) {
            Swal.fire({
                icon: 'error',
                title: 'Hora Inválida',
                text: 'Nuestro horario de atención es de 7:00 AM a 8:00 PM.',
                confirmButtonText: 'Entendido'
            });
            $("#hora_entrega").val('');
            return false;
        }

        return true;
    }

    // Date input validation
    $("#fecha_entrega").on('change', validateDate);
    $("#hora_entrega").on('change', validateTime);

    // Set min date to today
    const today = new Date().toISOString().split('T')[0];
    $("#fecha_entrega").attr('min', today);

    // Item Deletion
    $('.btn-eliminar').on('click', function(e) {
        e.preventDefault();
        const form = $(this).closest('.form-eliminar');
        const nombreProducto = $(this).data('nombre');

        Swal.fire({
            title: '¿Está seguro?',
            html: `Está a punto de eliminar <strong>${nombreProducto}</strong> de su carrito.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
    function updateCart(id_producto, cantidad) {
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
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo actualizar el carrito'
                });
            }
        });
    }

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
                form.submit();
            }
        });
    });
});
</script>
@stop