@extends('adminlte::page')

@section('title', 'Catálogo - Au Bon Pain')

@section('content_header')
    <h1 class="text-center mb-4">Nuestros Productos</h1>
@stop

@section('content')
<div class="container-fluid">
    <!-- Filtros y búsqueda -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="btn-group d-flex justify-content-center">
                <button type="button" class="btn btn-primary btn-lg active" data-filter="all">Todos</button>
                @foreach($categories as $category)
                    <button type="button" class="btn btn-primary btn-lg" data-filter="{{ $category->id_categoria }}">
                        {{ $category->categoria }}
                    </button>
                @endforeach
            </div>
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
        @foreach($products as $producto)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 product-container">
            <div class="card h-100 product-card" data-category="{{ $producto->id_categoria }}">
                <div class="product-details-trigger" 
                     data-product-id="{{ $producto->id }}"
                     data-product-name="{{ $producto->nombre }}"
                     data-product-price="{{ $producto->precio }}"
                     data-product-description="{{ $producto->descripcion }}"
                     data-product-image="{{ asset('storage/' . $producto->imagen) }}"
                     data-product-available="{{ $producto->disponible }}"
                     data-product-discount="{{ $producto->descuento }}">
                
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $producto->imagen) }}" 
                             class="card-img-top product-img" 
                             alt="{{ $producto->nombre }}" 
                             loading="lazy">
                             
                        @if($producto->descuento > 0)
                            <div class="position-absolute top-0 right-0 bg-danger text-white px-2 py-1 m-2 rounded">
                                -{{ $producto->descuento }}%
                            </div>
                        @endif
                    </div>
                
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text text-muted mb-2">{{ Str::limit($producto->descripcion, 100) }}</p>
                        
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    @if($producto->descuento > 0)
                                        <small class="text-muted text-decoration-line-through">
                                            Bs. {{ number_format($producto->precio, 2) }}
                                        </small>
                                        <div class="text-danger font-weight-bold">
                                            Bs. {{ number_format($producto->precio * (1 - $producto->descuento/100), 2) }}
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
                            <form class="add-to-cart-form">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                <button type="submit" class="btn btn-primary btn-block {{ $producto->stock == 0 ? 'disabled' : '' }}"
                                        {{ $producto->stock == 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-shopping-cart mr-2"></i>
                                    Agregar al carrito
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered"> <!-- Aquí añadimos la clase modal-dialog-centered -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img id="modalProductImage" src="" alt="" class="img-fluid rounded">
                    </div>
                    <div class="col-md-6">
                        <h3 id="modalProductName"></h3>
                        <p id="modalProductDescription" class="text-muted"></p>
                        <div class="price-section mb-3">
                            <h4 class="text-primary">Bs. <span id="modalProductPrice"></span></h4>
                            <small id="modalProductOriginalPrice" class="text-muted text-decoration-line-through d-none">
                                Bs. <span></span>
                            </small>
                        </div>
                        <div class="availability-section mb-3">
                            <span id="modalProductAvailability" class="badge"></span>
                        </div>
                        <form id="modalAddToCartForm">
                            @csrf
                            <input type="hidden" name="producto_id" id="modalProductId">
                            <div class="quantity-section mb-3">
                                <label for="modalQuantity">Cantidad:</label>
                                <div class="input-group" style="width: 150px;">
                                    <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="decrease">-</button>
                                    <input type="number" class="form-control text-center" name="quantity" id="modalQuantity" value="1" min="1" max="99">
                                    <button class="btn btn-outline-secondary quantity-btn" type="button" data-action="increase">+</button>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" id="modalAddToCart">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Agregar al carrito
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@stop

@section('css')
<style>
    .product-card {
        transition: transform 0.2s;
        border: none;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .product-img {
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .product-card:hover .product-img {
        transform: scale(1.05);
    }

    .btn-group .btn {
        border-radius: 20px;
        margin: 0 5px;
        transition: all 0.3s;
    }

    .btn-group .btn:hover {
        transform: translateY(-2px);
    }

    .stock-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 1;
    }

    .product-details-trigger {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .product-details-trigger:hover {
        transform: translateY(-5px);
    }

    #modalProductImage {
        max-height: 400px;
        object-fit: cover;
        width: 100%;
    }

    .modal-content {
        border-radius: 15px;
    }

    .quantity-section .input-group {
        width: 150px !important;
    }

    @media (max-width: 768px) {
        .btn-group {
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .btn-group .btn {
            margin: 5px;
        }
    }
</style>
@stop

@section('js')
<script>
$(document).ready(function() {
    // Modal handlers
    $('.product-details-trigger').click(function() {
        const card = $(this);
        const productId = card.data('product-id');
        const productName = card.data('product-name');
        const productPrice = parseFloat(card.data('product-price'));
        const productDescription = card.data('product-description');
        const productImage = card.data('product-image');
        const productAvailable = card.data('product-available');
        const productDiscount = parseFloat(card.data('product-discount'));

        $('#modalProductId').val(productId);
        $('#modalProductName').text(productName);
        $('#modalProductDescription').text(productDescription);
        $('#modalProductImage').attr('src', productImage);
        
        if (productDiscount > 0) {
            const discountedPrice = productPrice * (1 - productDiscount/100);
            $('#modalProductPrice').text(discountedPrice.toFixed(2));
            $('#modalProductOriginalPrice').removeClass('d-none').find('span').text(productPrice.toFixed(2));
        } else {
            $('#modalProductPrice').text(productPrice.toFixed(2));
            $('#modalProductOriginalPrice').addClass('d-none');
        }
        
        const availabilityBadge = $('#modalProductAvailability');
        if (productAvailable) {
            availabilityBadge.removeClass('badge-danger').addClass('badge-success').text('Disponible');
            $('#modalAddToCart').prop('disabled', false);
        } else {
            availabilityBadge.removeClass('badge-success').addClass('badge-danger').text('No Disponible');
            $('#modalAddToCart').prop('disabled', true);
        }

        $('#modalQuantity').val(1);
        $('#productModal').modal('show');
    });

    // Quantity handlers
    $('.quantity-btn').click(function() {
        const input = $(this).closest('.input-group').find('input');
        const currentValue = parseInt(input.val());
        
        if ($(this).data('action') === 'increase' && currentValue < 99) {
            input.val(currentValue + 1);
        } else if ($(this).data('action') === 'decrease' && currentValue > 1) {
            input.val(currentValue - 1);
        }
    });

    // Search handler
    $('#searchProduct').on('keyup', function() {
        const searchValue = $(this).val().toLowerCase();
        $('.product-container').each(function() {
            const productText = $(this).text().toLowerCase();
            $(this).toggle(productText.includes(searchValue));
        });
    });

    // Category filter handler
    $('.btn-group .btn').click(function() {
        $('.btn-group .btn').removeClass('active');
        $(this).addClass('active');
        
        const filter = $(this).data('filter');
        
        if (filter === 'all') {
            $('.product-container').show();
        } else {
            $('.product-container').each(function() {
                const category = $(this).find('.product-card').data('category');
                $(this).toggle(category === parseInt(filter));
            });
        }
    });

    // Cart form handlers
    $('.add-to-cart-form, #modalAddToCartForm').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    $('#cart-counter').text(response.cartCount);
                    $('#productModal').modal('hide');
                    
                    Swal.fire({
                        title: '¡Producto agregado!',
                        text: 'El producto se agregó correctamente al carrito',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message || 'No se pudo agregar el producto al carrito',
                        icon: 'error'
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    title: 'Error',
                    text: xhr.responseJSON?.message || 'Ocurrió un error al procesar la solicitud',
                    icon: 'error'
                });
            }
        });
    });
});

















</script>
@stop
