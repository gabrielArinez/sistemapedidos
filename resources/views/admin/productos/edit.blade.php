@extends('adminlte::page')

@section('content_header')
    <h1><b>Editar - Producto</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Modificar Producto</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.productos.update', $producto->id_producto) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Nombre del Producto -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
                                    @error('nombre')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Categoría -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_categoria">Categoría</label>
                                    <select class="form-control" name="id_categoria" required>
                                        <option value="">Seleccionar Categoría</option>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id_categoria }}" 
                                                {{ old('id_categoria', $producto->id_categoria) == $categoria->id_categoria ? 'selected' : '' }}>
                                                {{ $categoria->categoria }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_categoria')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Precio -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="precio">Precio</label>
                                    <input type="number" class="form-control" name="precio" value="{{ old('precio', $producto->precio) }}" required>
                                    @error('precio')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Stock -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number" class="form-control" name="stock" value="{{ old('stock', $producto->stock) }}" required>
                                    @error('stock')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Disponible -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="disponible">Disponible</label>
                                    <select class="form-control" name="disponible" required>
                                        <option value="1" {{ old('disponible', $producto->disponible) == 1 ? 'selected' : '' }}>Sí</option>
                                        <option value="0" {{ old('disponible', $producto->disponible) == 0 ? 'selected' : '' }}>No</option>
                                    </select>
                                    @error('disponible')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Promoción -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_promocion">Promoción</label>
                                    <select class="form-control" name="id_promocion">
                                        <option value="">Seleccionar Promoción</option>
                                        @foreach ($promociones as $promocion)
                                            <option value="{{ $promocion->id_promocion }}" 
                                                {{ old('id_promocion', $producto->id_promocion) == $promocion->id_promocion ? 'selected' : '' }}>
                                                {{ $promocion->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_promocion')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Imagen -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="imagen">Imagen</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="imagen" name="imagen" accept="image/*">
                                        <label class="custom-file-label" for="imagen">Seleccionar imagen</label>
                                    </div>
                                    @error('imagen')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div id="preview-container" class="mt-2" style="{{ $producto->imagen ? 'display:block;' : 'display:none;' }};">
                                    <img id="imagen-preview" 
                                        src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : '#' }}" 
                                        alt="{{ $producto->nombre }}" 
                                        style="max-width: 150px; max-height: 150px;">
                                </div>
                            </div>

                            <!-- Descripción -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea class="form-control" name="descripcion" rows="2">{{ old('descripcion', $producto->descripcion) }}</textarea>
                                    @error('descripcion')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>  
                        </div>

                        {{-- Botones --}}
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-save"></i> Guardar Cambios
                                    </button>
                                    <a href="{{ url('/admin/productos') }}" class="btn btn-info">Volver</a>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add extra stylesheets here --}}
@stop

@section('js')
<script>
    // Nombre de archivo personalizado
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

        // Vista previa de imagen
        var input = this;
        var previewContainer = $("#preview-container");
        var previewImg = $("#imagen-preview");

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                previewImg.attr('src', e.target.result);
                previewContainer.show();
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.hide();
        }
    });
</script>
@stop
