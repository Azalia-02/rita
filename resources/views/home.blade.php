<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link href="{{ asset('css/pag.css') }}" rel="stylesheet">
    
</head>
<body>
    <nav class="navbar">
        <div class="logo-container"> 
                <img src="{{ asset('img/dinologin.jpg') }}" alt="Logo" class="logo1">
        </div>
        <ul>
            <li>
            <a href="{{ route('productosu') }}">Productos</a>
            </li>
            <li><a href="{{ route('nosotros') }}">Nosotros</a></li>
            <li><a href="{{ route('login') }}">Iniciar sesión</a></li>
        </ul>
    </nav>

        <img src="{{ asset('img/1.png') }}" height="600px" width="1500px">
        <h2 class="title">Atención médica simplificada</h2>
        <p class="subtitle">Sistema de monitoreo remoto de pacientes de la tercera edad</p>
	        <p class="link"><a href="{{ route('productosu') }}" class="btn btn-default btn-lg">Conoce nuestras soluciones</a></p>

</body>
</html>
