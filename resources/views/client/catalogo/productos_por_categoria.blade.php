@extends('adminlte::page')

@section('title', 'Productos - ' . $categoria->categoria)

@section('content_header')
    <h1 class="text-center mb-4">Productos de {{ $categoria->categoria }}</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        @foreach($productos as $producto)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100 product-card">
                <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top product-img" alt="{{ $producto->nombre }}" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                    <p class="card-text">Precio: ${{ number_format($producto->precio, 2) }}</p>
                    <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-block">Agregar al carrito</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@stop

@section('css')
<!-- Opcional: reutiliza el estilo que ya tienes -->
@stop
