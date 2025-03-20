<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="{{ asset('css/carrito.css') }}">
</head>
<body>
<div id="encabezado">
<a href="{{ route('home') }}">
        <img src="{{ asset('img/dinologin.jpg') }}" alt="logo empresa" id="imgenbn">
        </a>
    <nav class="menu">
      <ul>
        <li><h1 class="text-center">Nuestros Productos</h1></li>
      </ul>
    </nav>
  </div>

<br>
<div class="container my-4">
    
    <h2 class="mt-4">Productos</h2>
    <div class="row">
        @forelse($data as $producto)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $producto['imagen']) }}" class="card-img-top" alt="{{ $producto['nombre'] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto['nombre'] }}</h5>
                        <p class="card-text">{{ $producto['descripcion'] }}</p>
                        <p class="card-text"><strong>Precio:</strong> ${{ $producto['precio'] }}</p>
                        <a href="{{ route('productos') }}" class="boton">Agregar al carrito</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay productos disponibles.</p>
        @endforelse
    </div>

</div>
</body>
</html>