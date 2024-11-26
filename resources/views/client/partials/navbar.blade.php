{{-- navbar.blade.php --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            @auth('cliente')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-avatar mr-2">
                            <i class="fas fa-user-circle fa-2x"></i>
                        </div>
                        <span>{{ Auth::guard('cliente')->user()->nombre }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="navbarDropdown">
                        <div class="dropdown-header">           
                            <div class="d-flex flex-column align-items-center">
                                <i class="fas fa-user-circle fa-3x mb-2"></i>
                                <strong>{{ Auth::guard('cliente')->user()->nombre }} {{ Auth::guard('cliente')->user()->apellido }}</strong>
                                <small class="text-muted">{{ Auth::guard('cliente')->user()->email }}</small>
                            </div>
                        </div>

                        <a class="dropdown-item" href="{{ route('cliente.logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt fa-fw mr-2"></i>Cerrar Sesión
                        </a>
                        <form id="logout-form" action="{{ route('cliente.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cliente.login') }}">
                        <i class="fas fa-sign-in-alt mr-1"></i>Iniciar Sesión
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cliente.register') }}">
                        <i class="fas fa-user-plus mr-1"></i>Registrarse
                    </a>
                </li>
            @endauth
        </ul>
    </div>
</nav>
<style>
.navbar {
    box-shadow: 0 2px 4px rgba(0,0,0,.1);
}
.user-avatar {
    display: flex;
    align-items: center;
    justify-content: center;
    color: #007bff;
}
.dropdown-menu {
    min-width: 280px;
    padding: 0;
}
.dropdown-header {
    background-color: #f8f9fa;
    padding: 1rem;
    border-bottom: 1px solid #dee2e6;
}
.dropdown-item {
    padding: .75rem 1rem;
}
.dropdown-item:active {
    background-color: #007bff;
}
.dropdown-item i {
    color: #6c757d;
}
.dropdown-item:active i {
    color: white;
}
@media (max-width: 991.98px) {
    .navbar-nav .dropdown-menu {
        position: static;
        float: none;
    }
}
</style>