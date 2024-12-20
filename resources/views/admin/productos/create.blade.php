@extends('adminlte::page')

@section('content_header')
    <h1><b>Crear - Producto</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ingresar Datos</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Nombre del Producto -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                                    @error('nombre')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Categoría -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_categoria">Categoría</label>
                                    <select class="form-control" id="id_categoria" name="id_categoria" required>
                                        <option value="">Seleccionar Categoría</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id_categoria }}" {{ old('id_categoria') == $categoria->id_categoria ? 'selected' : '' }}>
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
                                    <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ old('precio') }}" required>
                                    @error('precio')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Stock -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}" required>
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
                                    <select class="form-control" id="disponible" name="disponible" required>
                                        <option value="1" {{ old('disponible', $producto->disponible ?? 1) == 1 ? 'selected' : '' }}>Sí</option>
                                        <option value="0" {{ old('disponible', $producto->disponible ?? 1) == 0 ? 'selected' : '' }}>No</option>                            
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
                                    <select class="form-control" id="id_promocion" name="id_promocion">
                                        <option value="">Seleccionar Promoción</option>
                                        @foreach($promociones as $promocion)
                                            <option value="{{ $promocion->id_promocion }}" {{ old('id_promocion') == $promocion->id_promocion ? 'selected' : '' }}>
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
                            <div id="preview-container" class="mt-2" style="display:none;">
                                <img id="imagen-preview" src="#" alt="Vista previa de imagen" style="max-width: 150px; max-height: 150px;">
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="2">{{ old('descripcion') }}</textarea>
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
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> Registrar
                                    </button>
                                    <a href="{{ route('admin.productos.index') }}" class="btn btn-info">Volver</a>
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
    {{-- Puedes agregar aquí estilos adicionales si es necesario --}}
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
