<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <title>Registro de Productos</title>
</head>
<body>
    <div id="encabezado">
        <img src="{{ asset('img/dinologin.jpg') }}" alt="logo empresa" id="imgenbn">
        <h1>Registro de Productos</h1>
    </div>

    <center>
        <form class="form-register" action="{{ route('producto_registrar') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="nombre">Nombre</label>
            <input class="controls" type="text" name="nombre" id="nombre" value="{{ old('nombre') }}">
            @if ($errors->has('nombre'))
                <div class="text-danger">{{ $errors->first('nombre') }}</div>
            @endif
            <br>

            <div class="form-floating mb-3">
                <label for="floatingDescripcion">Descripción:</label>
                <textarea class="form-control" name="descripcion" id="floatingDescripcion" placeholder="Descripción del producto">{{ old('descripcion') }}</textarea>
                @if ($errors->has('descripcion'))
                    <div class="text-danger">{{ $errors->first('descripcion') }}</div>
                @endif
            </div>

            <div class="form-floating mb-3">
                <label for="floatingPrecio">Precio</label>
                <input type="number" class="form-control" name="precio" value="{{ old('precio') }}" id="floatingPrecio" placeholder="ejemplo: $300">
                @if ($errors->has('precio'))
                    <div class="text-danger">{{ $errors->first('precio') }}</div>
                @endif
            </div>

            <div class="form-floating mb-3">
                <label for="floatingStock">Stock</label>
                <input type="number" class="form-control" name="stock" value="{{ old('stock') }}" id="floatingStock">
                @if ($errors->has('stock'))
                    <div class="text-danger">{{ $errors->first('stock') }}</div>
                @endif
            </div>

            <div class="form-floating mb-3">
                <label for="floatingimagen">Foto</label>
                <input type="file" class="form-control" name="imagen" id="floatingimagen">
                @if ($errors->has('imagen'))
                    <div class="text-danger">{{ $errors->first('imagen') }}</div>
                @endif
            </div>
            <br>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('productos') }}" class="btn btn-danger">Cancelar</a>
        </form>
    </center>
</body>
</html>