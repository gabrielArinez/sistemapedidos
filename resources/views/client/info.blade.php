@extends('adminlte::page')
@section('title', 'Panel Administrador - Au Bon Pain')
<!-- Barra superior -->
@include('client.partials.navbar')  

@section('content_header')

<div class="container-fluid">
    <div class="row mb-4">

        <div class="col-12 text-center mb-4">
            <!-- Logo -->
            <img src="{{ asset('imagenes/bonPain.png') }}" alt="Au Bon Pain Logo" class="img-fluid mb-3" style="max-height: 150px;">
            <h1 class="font-weight-bold text-primary">Au Bon Pain</h1>
            <p class="lead text-muted">Auténtico pan francés, natural sin conservantes ni aditivos químicos</p>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Columna de Historia y Descripción -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary">
                    <h3 class="card-title">
                        <i class="fas fa-history mr-2"></i>
                        Nuestra Historia
                    </h3>
                </div>
                <div class="card-body">
                    <div class="welcome-section mb-4">
                        <h3 class="text-center mb-3">¡Bienvenidos a Au Bon Pain!</h3>
                        <div class="story p-3 bg-light rounded">
                            <p class="text-justify">
                                Todo comenzó con el reto de abrir una panadería francesa en La Paz que ofreciera la auténtica 
                                baguette con su sabor único. El reto se cumplió tras 10 meses de investigación, y Au Bon Pain 
                                abrió sus puertas en diciembre de 2015.
                            </p>
                        </div>
                        <br>
                        <h4 class="text-left mb-3">Misión:</h4>
                        <div class="story p-3 bg-light rounded">
                            <p class="text-justify">
                                Ofrecer a la comunidad de La Paz auténtico pan francés, elaborado de forma artesanal y sin conservantes, que combine tradición y calidad, brindando una experiencia única a través de productos frescos y saludables.
                            </p>
                        </div>
                        <br>
                        <h4 class="text-left mb-3">Visión: </h4>
                        <div class="story p-3 bg-light rounded">
                            <p class="text-justify">
                                Ser la panadería de referencia en Bolivia por su compromiso con la excelencia, expandiendo la cultura del pan francés artesanal y fomentando prácticas responsables y sostenibles en cada aspecto de nuestro negocio.
                            </p>
                        </div>
                    </div>
                    <br>
                    <div class="products-section">
                        <h4 class="mb-3"><i class="fas fa-bread-slice mr-2"></i>Nuestros Productos</h4>
                        <p class="text-justify">
                            La panadería ofrece una selecta variedad de productos artesanales:
                        </p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><i class="fas fa-check text-success mr-2"></i>Baguettes tradicionales</li>
                            <li class="list-group-item"><i class="fas fa-check text-success mr-2"></i>Panes de granja</li>
                            <li class="list-group-item"><i class="fas fa-check text-success mr-2"></i>Panes integrales</li>
                            <li class="list-group-item"><i class="fas fa-check text-success mr-2"></i>Bollería artesanal</li>
                            <li class="list-group-item"><i class="fas fa-check text-success mr-2"></i>Galletas</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna de Información de Contacto -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary">
                    <h3 class="card-title">
                        <i class="fas fa-store mr-2"></i>
                        Información del Negocio
                    </h3>
                </div>
                <div class="card-body">
                    <div class="contact-info">
                        <div class="info-item mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-building fa-2x text-primary mr-3"></i>
                                <div>
                                    <h5 class="mb-0">Nombre</h5>
                                    <p class="mb-0">Au Bon Pain</p>
                                </div>
                            </div>
                        </div>

                        <div class="info-item mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-map-marker-alt fa-2x text-danger mr-3"></i>
                                <div>
                                    <h5 class="mb-0">Dirección</h5>
                                    <p class="mb-0">364, Av. América, La Paz, Bolivia</p>
                                </div>
                            </div>
                            <img src="{{ asset('imagenes/mapa.png') }}" alt="Ubicación" class="img-fluid rounded">
                        </div>

                        <div class="info-item mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-clock fa-2x text-warning mr-3"></i>
                                <div>
                                    <h5 class="mb-0">Horario de Atención</h5>
                                    <p class="mb-0">Lunes a Sábado: 7:00 AM - 8:00 PM</p>
                                </div>
                            </div>
                        </div>

                        <div class="info-item mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-phone fa-2x text-success mr-3"></i>
                                <div>
                                    <h5 class="mb-0">Contacto</h5>
                                    <p class="mb-0">Cel: 73544643</p>
                                    <p class="mb-0">Email: aubonpain.lapaz@gmail.com</p>
                                </div>
                            </div>
                        </div>

                        <!-- Redes Sociales -->
                        <div class="social-links text-center mt-4">
                            <a href="https://www.facebook.com/AuBonPain.LaPaz" class="btn btn-primary btn-lg mr-2" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="btn btn-success btn-lg mr-2">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="https://www.google.com/maps/place/Au+Bon+Pain+-+Panader%C3%ADa+francesa/@-16.4927964,-68.1424756,20.74z/data=!4m15!1m8!3m7!1s0x915f20754ffb14a5:0xd519a893919a6c95!2sAv.+Am%C3%A9rica+364,+La+Paz!3b1!8m2!3d-16.4928687!4d-68.1423669!16s%2Fg%2F11s16dq00h!3m5!1s0x915f20754ffb14af:0xf93a4177472bf2cf!8m2!3d-16.4928687!4d-68.1423669!16s%2Fg%2F11c5b2d08t?entry=ttu&g_ep=EgoyMDI0MTAyOS4wIKXMDSoASAFQAw%3D%3D" class="btn btn-danger btn-lg" target="_blank">
                                <i class="fas fa-map-marked-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .card {
        border: none;
        box-shadow: 0 0 15px rgba(0,0,0,.1);
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card-header {
        border-bottom: none;
        color: white;
    }
    .info-item {
        padding: 15px;
        border-radius: 8px;
        background-color: #f8f9fa;
    }
    .social-links a {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
    }
    .social-links a:hover {
        transform: scale(1.1);
    }
    .text-justify {
        text-align: justify;
    }
    .story {
        border-left: 4px solid #007bff;
    }
</style>
@stop

@section('js')
<script>
$(document).ready(function() {
    // Animación de entrada para las cards
    $('.card').hide().fadeIn(1000);
    
    // Tooltip para los botones de redes sociales
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@stop