<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
</head>
<body>
    <div id="encabezado">
        <img src="{{ 'img/dinologin.jpg' }}" alt="logo empresa" id="imgenbn">
        <h1>Administrador</h1>
        <nav class="menu">
            <ul>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="cierre">Cerrar sesión</button>
                    </form>
                </li>
            </ul>
        </nav> 
    </div>

    <br><br><br><br>

    <div class="slideshow-container">
        <div class="carousel" id="carousel">
            <div class="carousel-item">
                <img src="{{ asset('img/medicos.png') }}" alt="Medicos">
                <div class="content">
                    <a href="{{ route('medicos') }}" class="btn btn-default btn-lg">Médicos</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/pacientes.png') }}" alt="Pacientes">
                <div class="content">
                    <a href="{{ route('pacientes') }}" class="btn btn-default btn-lg">Pacientes</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/citas.png') }}" alt="Citas">
                <div class="content">
                    <a href="{{ route('panel_admin') }}" class="btn btn-default btn-lg">Citas</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/productos.png') }}" alt="Productos">
                <div class="content">
                    <a href="{{ route('panel_admin') }}" class="btn btn-default btn-lg">Productos</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>