<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicos </title>
    <link rel="stylesheet" href="{{ asset('css/Gestilos.css') }}">
</head>
<body>

    <header>
    <img src="{{ asset('img/dinologin.jpg') }}" alt="logo empresa" id="imgenbn">
        <h1><center>
        Medicos 
        </center></h1>

        <form action="{{ route('logout') }}" method="POST" class="logout-form">
    <button type="submit" class="cerrar-sesion">Cerrar sesión</button>
</form>
    </header>

    

    <section class="graficas">
        <div class="grafica">
            <img src="{{ asset('img/doctor 1.jpg') }}" alt="Gráfica 1">
            <section class="botones-superiores">
            <button>Medico 1 </button>
        </div>
        <div class="grafica">
            <img src="{{ asset('img/doctor 2.jpg') }}" alt="Gráfica 2">
            <section class="botones-superiores">
            <button>Medico 2 </button>
        </div>
        <div class="grafica">
            <img src="{{ asset('img/doctor 3.jpg') }}" alt="Gráfica 3">
            <section class="botones-superiores">
            <button>Medico 3 </button>
        
        </div>
    </section>

</body>
</html>
