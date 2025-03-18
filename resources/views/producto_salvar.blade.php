<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <title>Editar producto</title>
</head>
<body>
<div id="encabezado">
        <img src="{{ asset('img/dinologin.jpg') }}" alt="logo empresa" id="imgenbn">
        <h1>Actualización de Productos</h1>
    </div>
    <center>
<form action="{{ route('producto_salvar', $data['id_producto']) }}" method="post" enctype="multipart/form-data">
    
    @csrf
    <input type="hidden" name=id value="{{ $data['id_producto'] }}">

    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" value="{{ $data['nombre'] }}"><br>

    <div class="form-floating mb-3">
                <label for="floatingDescripcion">Descripción:</label>
                <textarea class="form-control" name="descripcion" id="floatingDescripcion" value="{{ $data['descripcion'] }}">{{ old('descripcion') }}</textarea>
                @if ($errors->has('descripcion'))
                    <div class="text-danger">{{ $errors->first('descripcion') }}</div>
                @endif
            </div>

            <div class="form-floating mb-3">
                <label for="floatingPrecio">Precio</label>
                <input type="number" class="form-control" name="precio" value="{{ $data['precio'] }}" id="floatingPrecio" placeholder="ejemplo: $300">
                @if ($errors->has('precio'))
                    <div class="text-danger">{{ $errors->first('precio') }}</div>
                @endif
            </div>

            <div class="form-floating mb-3">
                <label for="floatingStock">Stock</label>
                <input type="number" class="form-control" name="stock" value="{{ $data['stock'] }}" id="floatingStock">
                @if ($errors->has('stock'))
                    <div class="text-danger">{{ $errors->first('stock') }}</div>
                @endif
            </div>

            <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen:</label>
                        <input type="file" class="form-control" id="imagen" name="imagen">
                        <img src="{{ asset('storage/' . $data['imagen']) }}" class="img-thumbnail mt-2" style="width: 50px; height: 50px;">
                    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
<a href="{{ route('pacientes') }}">
<button type="button" class="btn btn-danger">Cancelar</button>
</form>
</center>
</body>
</html>
