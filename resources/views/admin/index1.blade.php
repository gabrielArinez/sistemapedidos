@extends('adminlte::page')

@section('title', 'Panel Administrador - Bon Pain')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Bienvenid@ al Panel de Administración</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-shopping-cart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pedidos Nuevos</span>
                        <span class="info-box-number">10</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-shopping-basket"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Productos Activos</span>
                        <span class="info-box-number">25</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Clientes Registrados</span>
                        <span class="info-box-number">50</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-star"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Productos Destacados</span>
                        <span class="info-box-number">5</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información del Negocio -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-store mr-1"></i>
                            Información del Negocio
                        </h3>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">Nombre:</dt>
                            <dd class="col-sm-8">Bon Pain</dd>

                            <dt class="col-sm-4">Dirección:</dt>
                            <dd class="col-sm-8">Av. Principal #123</dd>

                            <dt class="col-sm-4">Teléfono:</dt>
                            <dd class="col-sm-8">+123 456 7890</dd>

                            <dt class="col-sm-4">Email:</dt>
                            <dd class="col-sm-8">contacto@bonpain.com</dd>

                            <dt class="col-sm-4">Horario:</dt>
                            <dd class="col-sm-8">Lunes a Sábado: 7:00 AM - 8:00 PM</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-line mr-1"></i>
                            Resumen de Actividad
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-success text-xl">
                                <i class="fas fa-shopping-cart"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <i class="fas fa-arrow-up"></i> 12%
                                </span>
                                <span class="text-muted">TASA DE VENTAS</span>
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <p class="text-info text-xl">
                                <i class="fas fa-users"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <i class="fas fa-arrow-up"></i> 5%
                                </span>
                                <span class="text-muted">REGISTROS</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .info-box-number {
            font-size: 24px;
            font-weight: bold;
        }
        .card {
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
        }
        .card-header {
            background-color: rgba(0,0,0,.03);
        }
    </style>
@stop

@section('js')
    <script>
    $(document).ready(function() {
        // Aquí puedes agregar cualquier JavaScript que necesites
        console.log('¡Panel de administración cargado!');
    });
    </script>
@stop