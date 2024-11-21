@extends('adminlte::page')
{{-- --}}
@section('content_header')
    <h1><b>Listado de Productos</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h2 class="card-title">Productos</h2>
                    <br>
                    <div class="card-tools">
                        {{-- Barra de Busqueda --}}
                        <div class="input-group input-group-sm float-left mr-3" style="width: 300px;">
                            <input type="text" id="searchInput" class="form-control float-right" placeholder="Buscar producto...">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        {{-- Boton de crear --}}
                        <a href="{{url('admin/productos/create')}}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Crear Nuevo
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" style="margin-top: 20px;">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center" style="min-width: 50px">ID</th>
                                    <th scope="col" class="text-center" style="min-width: 100px">Imagen</th>
                                    <th scope="col" class="text-center" style="min-width: 150px">Producto</th>
                                    <th scope="col" class="text-center" style="min-width: 120px">Categoría</th>
                                    <th scope="col" class="text-center d-none d-md-table-cell">Promoción</th>
                                    <th scope="col" class="text-center" style="min-width: 80px">Precio</th>
                                    <th scope="col" class="text-center d-none d-md-table-cell">Stock</th>
                                    <th scope="col" class="text-center d-none d-md-table-cell">Disponible</th>
                                    <th scope="col" class="text-center" style="min-width: 100px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $producto)
                                    <tr>
                                        <td class="text-center">{{ $producto->id_producto }}</td>
                                        <td class="text-center">
                                            @if($producto->imagen)
                                                <img src="{{ asset('storage/' . $producto->imagen) }}" 
                                                     alt="{{ $producto->nombre }}" 
                                                     style="max-width: 80px; max-height: 80px; object-fit: cover;">
                                            @else
                                                <span>Sin imagen</span>
                                            @endif
                                        </td>
                                        <td>{{ $producto->nombre }}</td>
                                        <td>{{ $producto->categoria_producto->categoria ?? 'N/A' }}</td>
                                        <td class="text-center d-none d-md-table-cell">{{ $producto->promociones->nombre ?? 'N/A' }}</td>
                                        <td class="text-center">{{ $producto->precio }}</td>
                                        <td class="text-center d-none d-md-table-cell">{{ $producto->stock }}</td>
                                        <td class="text-center d-none d-md-table-cell">
                                            {{ $producto->disponible ? 'Sí' : 'No' }}
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{url('/admin/productos/'.$producto->id_producto.'/read')}}" 
                                                   class="btn btn-info" 
                                                   data-toggle="tooltip" 
                                                   title="Ver">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{url('/admin/productos/'.$producto->id_producto.'/edit')}}" 
                                                   class="btn btn-success"
                                                   data-toggle="tooltip" 
                                                   title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-danger"
                                                        data-toggle="tooltip" 
                                                        title="Eliminar"
                                                        onclick="confirmarEliminacion('{{ $producto->id_producto }}', '{{ $producto->nombre }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <form id="form-delete-{{ $producto->id_producto }}" 
                                                  action="{{ url('/admin/productos',$producto->id_producto) }}" 
                                                  method="POST" 
                                                  style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    <style>
        /* Ajustes para dispositivos móviles */
        @media (max-width: 768px) {
            .btn-group-sm .btn {
                padding: .25rem .4rem;
            }
            
            .table td, .table th {
                padding: .5rem;
            }
            
            .card-body {
                padding: 0.5rem;
            }

            /* Nuevo: Ajustes para la barra de búsqueda en móviles */
            .card-tools .input-group {
                width: 100%;
                margin-bottom: 10px;
            }
            
            .card-tools {
                display: flex;
                flex-direction: column;
                align-items: stretch;
            }
            
            .card-tools .btn-primary {
                margin-top: 5px;
            }
        }
    </style>
@stop

@section('js')  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            // Búsqueda en tiempo real
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function() {
                    var productName = $(this).find("td:nth-child(3)").text().toLowerCase();
                    $(this).toggle(productName.indexOf(value) > -1); 
                });
            });
            // Inicializar tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Mostrar mensaje de éxito si existe
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    timer: 1500,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            @endif

            // Función para confirmar eliminación
            window.confirmarEliminacion = function(id, nombre) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: `¿Deseas eliminar el producto "${nombre}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`form-delete-${id}`).submit();
                    }
                });
            }
        });
    </script>
@stop