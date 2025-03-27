<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficas de Administrador</title>
    <link rel="stylesheet" href="{{ asset('css/Gestilos.css') }}">
</head>
<body>

    <header>
    <img src="{{ asset('img/dinologin.jpg') }}" alt="logo empresa" id="imgenbn">
        <h1><center>
        PACIENTE
        </center></h1>

        <form action="{{ route('logout') }}" method="POST" class="logout-form">
    @csrf
    <button type="submit" class="cerrar-sesion">Cerrar sesión</button>
</form>
    </header>
    <div class="conte">
    <section class="botones-superiores">
        <button>Descargar Cita</button>
        <button>Ver Historial</button>
    </section>
    </div>
    

    <section class="graficas">
        <div class="grafica">
            <img src="{{ asset('img/grafica1.jpeg') }}" alt="Gráfica 1">
            <p>Gráfica de pulso cardiaco</p>
        </div>
        <div class="grafica">
            <img src="{{ asset('img/grafica4.jpeg') }}" alt="Gráfica 2">
            <p>Gráfica temperatura e pulso</p>
        </div>
        <div class="grafica">
            <img src="{{ asset('img/grafica3.jpeg') }}" alt="Gráfica 3">
            <p>Gráfica de multiples pulso</p>
        </div>
    </section>

</body>
</html>

