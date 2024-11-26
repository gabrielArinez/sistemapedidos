@extends('adminlte::page')
@section('title', 'Catálogo - Au Bon Pain')

<!-- Barra superior -->
@include('client.partials.navbar')


@section('content')
<div class="container-fluid">
    <!-- Filtros y búsqueda -->
    <div class="row mb-4">
        <div class="col-md-12">
            @if(isset($categories) && $categories->isNotEmpty())
                <div class="btn-group d-flex justify-content-center">
                    <button type="button" class="btn btn-primary btn-lg active" data-filter="all">Todos</button>
                    @foreach($categories as $category)
                        <button type="button" class="btn btn-primary btn-lg" data-filter="{{ $category->id_categoria }}">
                            {{ $category->categoria }}
                        </button>
                    @endforeach
                </div>
            @else
                <p class="text-center">No hay categorías disponibles.</p>
            @endif
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="input-group">
                <input type="text" class="form-control" id="searchProduct" placeholder="Buscar productos...">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Catálogo de productos -->
    <div class="row" id="productos-grid">
        @if(isset($products) && $products->isNotEmpty())
            @foreach($products as $producto)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 product-container">
                <div class="card h-100 product-card" data-category="{{ $producto->id_categoria }}">
                    <div class="product-details-trigger"
                         data-product-id="{{ $producto->id_producto }}"
                         data-product-name="{{ $producto->nombre }}"
                         data-product-price="{{ $producto->precio }}"
                         data-product-description="{{ $producto->descripcion }}"
                         data-product-image="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : asset('images/default-product.png') }}"
                         data-product-available="{{ $producto->disponible }}"
                         data-product-discount="{{ $producto->promociones->descuento}}">
                        
                        <div class="position-relative">

                            @if($producto->promociones->descuento > 0)
                                <div class="position-absolute top-0 right-0 bg-danger text-white px-2 py-1 m-2 rounded">
                                    -{{ $producto->promociones->descuento }}%
                                </div>
                                <img src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : asset('images/default-product.png') }}" 
                                class="card-img-top product-img" 
                                alt="{{ $producto->nombre }}" 
                                loading="lazy">
                                @else
                                <img src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : asset('images/default-product.png') }}"
                                class="card-img-top product-img"
                                alt="{{ $producto->nombre }}"
                                loading="lazy">
                            @endif
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        @if($producto->promociones->descuento > 0)
                                            <small class="text-muted text-decoration-line-through">
                                                <del>Bs. {{ number_format($producto->precio, 2) }}</del>
                                            </small>
                                            <div class="text-danger font-weight-bold">
                                                Bs. {{ number_format($producto->precio * (1 - $producto->promociones->descuento/100), 2) }}
                                            </div>
                                        @else
                                            <div class="text-primary font-weight-bold">
                                                Bs. {{ number_format($producto->precio, 2) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="stock-badge">
                                        @if($producto->disponible)
                                            <span class="badge badge-success">Disponible</span>
                                        @else
                                            <span class="badge badge-danger">No Disponible</span>
                                        @endif
                                    </div>
                                </div>
                                <form>
                                    @csrf

                                    <button class="btn btn-primary btn-block {{ $producto->stock == 0 ? 'disabled' : '' }}"
                                            {{ $producto->stock == 0 ? 'disabled' : '' }}>
                                        <i class="fas fa-shopping-cart mr-2"></i>
                                        Agregar al pedido
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <p class="text-center">No hay productos disponibles.</p>
        @endif
    </div>
</div>

<!-- Modal de detalles del producto -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 pb-4">
                <div class="row">
                    <!-- Columna de imagen -->
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="image-container rounded overflow-hidden">
                            <img id="modalProductImage" src="" alt="Imagen del producto" class="img-fluid w-100">
                        </div>
                    </div>
                    
                    <!-- Columna de detalles -->
                    <div class="col-md-6">
                        <!-- Nombre del producto -->
                        <h3 id="modalProductName" class="h4 font-weight-bold mb-3"></h3>
                        
                        <!-- Descripción -->
                        <p id="modalProductDescription" class="text-muted mb-4"></p>
                        
                        <!-- Precios -->
                        <div class="price-section mb-4">
                            <!-- Precio original y descuento -->
                            <div id="modalProductDiscount" class="mb-2">
                                <del id="modalOriginalPrice" class="text-muted text-decoration-line-through d-block"></del>
                                <div class="text-danger h4 font-weight-bold mb-0" id="modalDiscountedPrice"></div>
                            </div>
                            <!-- Precio sin descuento -->
                            <h4 id="modalProductPrice" class="text-primary mb-0"></h4>
                        </div>
                        
                        <!-- Disponibilidad -->
                        <div class="availability-section mb-4">
                            <span id="modalProductAvailability" class="badge px-3 py-2"></span>
                        </div>
                        
                        <!-- Selector de cantidad -->
                        <div class="quantity-section mb-4">
                            <label for="modalQuantity" class="font-weight-bold mb-2">Cantidad:</label>
                            <div class="input-group quantity-selector">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="decrease">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <input type="number" class="form-control text-center quantity-input" id="modalQuantity" value="1" min="1" max="50">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="increase">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Botón de agregar al pedido -->
                        <form>
                            @csrf
                            <input type="hidden" name="id_producto" id="modalProductId" value="" required>
                            <button type="submit" class="btn btn-primary btn-lg btn-block rounded-pill" id="modalAddToCart">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Agregar al pedido
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('css')
<style>
/* --------------------------------------- CATALOGO DE PRODUCTOS --------------------------------------- */
/* Estilos generales para las tarjetas de producto */
.product-card {
    transition: transform 0.2s;
    border: none;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    position: relative; 
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}
/* Estilos para las imágenes de los productos */
.product-img {
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s;
}

.product-card:hover .product-img {
    transform: scale(1.05); 
}
/* Estilos para el botón 'agregar al pedido' */
.btn-group .btn {
    border-radius: 20px;
    margin: 0 5px;
    transition: all 0.3s;
}

.btn-group .btn:hover {
    transform: translateY(-2px); /* Efecto al pasar el cursor sobre los botones */
}
/* Estilos para la etiqueta de stock */
.stock-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 1; 
}
/* Estilos para los productos con descuento */
.product-details-trigger .position-absolute {
    z-index: 2; /* Asegura que el descuento esté encima de otros elementos */
}
/* Estilos responsivos para pantallas pequeñas */
@media (max-width: 768px) {
    .btn-group {
        flex-wrap: wrap;
        justify-content: center;
    }

    .btn-group .btn {
        margin: 5px;
    }
}

/* --------------------------------------- ESTILOS MODAL ---------------------------------------*/
    /* Ajustes de estilo para la cantidad en los productos */
    .quantity-section .input-group {
        width: 150px !important;
    }

    .product-details-trigger {
        transition: all 0.3s ease;
    }

    .product-details-trigger:hover {
        transform: translateY(-5px);
        cursor: pointer;
    }

    #modalProductImage {
        max-height: 400px;
        object-fit: cover;
        width: 100%;
    }

    .modal-content {
        border-radius: 15px;
    }

    .quantity-input {
        width: 60px !important;
    }
    .quantity-selector input::-webkit-outer-spin-button,
    .quantity-selector input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
<script>
$(document).ready(function() {
    // Búsqueda en tiempo real
    $('#searchProduct').on('keyup', function() {
        const searchValue = $(this).val().toLowerCase();
        $('.product-card').each(function() {
            const productText = $(this).text().toLowerCase();
            $(this).closest('.col-12').toggle(productText.includes(searchValue));
        });
    });

    // Filtros de categoría
    $('.btn-group .btn').click(function() {
        $('.btn-group .btn').removeClass('active');
        $(this).addClass('active');
        
        const filter = $(this).data('filter');
        
        if (filter === 'all') {
            $('.product-card').closest('.col-12').show();
        } else {
            $('.product-card').each(function() {
                const category = $(this).data('category');
                $(this).closest('.col-12').toggle(category === parseInt(filter));
            });
        }
    });

// Manejador para abrir el modal
$('.product-details-trigger').click(function() {
    const card = $(this);
    // Obtener datos del producto
    const productName = card.data('product-name');
    const productPrice = card.data('product-price');
    const productDescription = card.data('product-description');
    const productImage = card.data('product-image');
    const productAvailable = card.data('product-available');
    const productDiscount = card.data('product-discount');
    const productId = card.data('product-id');

    // Actualizar el contenido del modal
    $('#modalProductName').text(productName);
    $('#modalProductDescription').text(productDescription);
    $('#modalProductImage').attr('src', productImage);
    $('#modalProductId').val(productId);
    
    // Limpiar todos los elementos de precio primero
    $('#modalOriginalPrice').empty().hide();
    $('#modalDiscountedPrice').empty().hide();
    $('#modalProductPrice').empty().hide();

    // Actualizar precios y descuento
    if (productDiscount > 0) {
        const discountedPrice = productPrice * (1 - productDiscount / 100);
        $('#modalOriginalPrice')
            .text('Bs. ' + productPrice.toFixed(2))
            .show();
        $('#modalDiscountedPrice')
            .text('Bs. ' + discountedPrice.toFixed(2))
            .show();
        $('#modalProductPrice').hide();
    } else {
        $('#modalProductPrice')
            .text('Bs. ' + productPrice.toFixed(2))
            .show();
        $('#modalOriginalPrice').hide();
        $('#modalDiscountedPrice').hide();
    }
    
    // Actualizar disponibilidad y estado del botón
    const addToCartBtn = $('#modalAddToCart');
    if (productAvailable) {
        $('#modalProductAvailability').removeClass('badge-danger').addClass('badge-success').text('Disponible');
        addToCartBtn.removeClass('disabled').prop('disabled', false);
    } else {
        $('#modalProductAvailability').removeClass('badge-success').addClass('badge-danger').text('No Disponible');
        addToCartBtn.addClass('disabled').prop('disabled', true);
    }

    // Reiniciar cantidad
    $('#modalQuantity').val(1);

    // Mostrar el modal
    $('#productModal').modal('show');
});

    // Manejador de cantidad en el modal
    $('#productModal .quantity-btn').click(function() {
        const input = $('#modalQuantity');
        const currentValue = parseInt(input.val());
        
        if ($(this).data('action') === 'increase' && currentValue < 50) {
            input.val(currentValue + 1);
        } else if ($(this).data('action') === 'decrease' && currentValue > 1) {
            input.val(currentValue - 1);
        }
    });

// Manejador para agregar al carrito desde el modal
$('#modalAddToCart').click(function(e) {
        e.preventDefault();
        
        const id_producto = $('#modalProductId').val();
        const cantidad = $('#modalQuantity').val();

        $.ajax({
            url: '{{ route("carrito.agregar") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id_producto: id_producto,
                cantidad: cantidad
            },
            success: function(response) {
                if(response.success) {
                    // Cerrar el modal
                    $('#productModal').modal('hide');
                    
                    // Mostrar mensaje de éxito
                    Swal.fire({
                        title: '¡Producto agregado!',
                        text: 'El producto se agregó correctamente al carrito',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            },
            error: function(xhr) {
                // Manejar errores
                let errorMessage = 'Ocurrió un error al agregar el producto';
                
                if (xhr.status === 401) {
                    errorMessage = 'Debe iniciar sesión para agregar productos al carrito';
                }
                
                Swal.fire({
                    title: 'Error',
                    text: errorMessage,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });

                if (xhr.status === 401) {
                    // Redirigir al login después de un breve delay
                    setTimeout(() => {
                        window.location.href = '{{ route("cliente.login") }}';
                    }, 2000);
                }
            }
        });
    });

    // Validación de cantidad
    $('#modalQuantity').on('change keyup', function() {
        let value = parseInt($(this).val());
        
        // Asegurar que el valor esté entre 1 y 50
        if (isNaN(value) || value < 1) {
            $(this).val(1);
        } else if (value > 50) {
            $(this).val(50);
        }
    });

    // Prevenir envío del formulario en las tarjetas de producto
    $('.product-card form').on('submit', function(e) {
        e.preventDefault();
        
        const id_producto = $(this).find('input[name="id_producto"]').val();
        
        $.ajax({
            url: '{{ route("carrito.agregar") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id_producto: id_producto,
                cantidad: 1
            },
            success: function(response) {
                if(response.success) {
                    Swal.fire({
                        title: '¡Producto agregado!',
                        text: 'El producto se agregó correctamente al carrito',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1200
                    });
                }
            },
            error: function(xhr) {
                let errorMessage = 'Ocurrió un error al agregar el producto';
                
                if (xhr.status === 401) {
                    errorMessage = 'Debe iniciar sesión para agregar productos al carrito';
                }
                


                if (xhr.status === 401) {
                    setTimeout(() => {
                        window.location.href = '{{ route("cliente.login") }}';
                    }, 2000);
                }
            }
        });
    });

});

</script>
@stop