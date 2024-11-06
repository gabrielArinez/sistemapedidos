@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@section('auth_header', __('Registro de Cliente'))

@section('auth_body')
    <form action="{{ route('cliente.register') }}" method="post">
        @csrf

        {{-- CI field --}}
        <div class="input-group mb-3">
            <input type="text" name="ci" class="form-control @error('ci') is-invalid @enderror"
                   value="{{ old('ci') }}" placeholder="Carnet de Identidad" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-id-card"></span>
                </div>
            </div>
            @error('ci')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Nombre field --}}
        <div class="input-group mb-3">
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                   value="{{ old('nombre') }}" placeholder="Nombre">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
            @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Apellido field --}}
        <div class="input-group mb-3">
            <input type="text" name="apellido" class="form-control @error('apellido') is-invalid @enderror"
                   value="{{ old('apellido') }}" placeholder="Apellido">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
            @error('apellido')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="Email">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Celular field --}}
        <div class="input-group mb-3">
            <input type="text" name="celular" class="form-control @error('celular') is-invalid @enderror"
                   value="{{ old('celular') }}" placeholder="Celular">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-phone"></span>
                </div>
            </div>
            @error('celular')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Direccion field --}}
        <div class="input-group mb-3">
            <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror"
                   value="{{ old('direccion') }}" placeholder="Dirección">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-map-marker-alt"></span>
                </div>
            </div>
            @error('direccion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Contraseña">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation" class="form-control"
                   placeholder="Confirmar contraseña">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        {{-- Register button --}}
        <button type="submit" class="btn btn-block btn-primary">
            <span class="fas fa-user-plus"></span>
            Registrarse
        </button>
    </form>
@stop

@section('auth_footer')
    <p class="my-0">
        <a href="{{ url('cliente/login') }}">
            Ya tengo una cuenta
        </a>
    </p>
@stop