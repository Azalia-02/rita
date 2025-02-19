<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href=" {{ asset('css/estilos.css') }}">
    </head>
<body>
    <div id="encabezado">
        <a href="#">
        <img src="{{ asset('img/dinologin.jpg') }}" alt="logo empresa" id="imgenbn">
        </a>
        <nav class="menu">
            <ul>
                <li><a href="#">Contactanos</a></li>
                <li><a href="{{ route('login') }}" class="active">Ingresa</a></li>
            </ul>
        </nav>
    </div>
    <br>
    <div id="cuerpo">
        <center>
        <form  action="{{ route('login_aceptar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2>Bienvenido</h2>
            <label for="username">Ingresa tu correo</label>
            <input type="email" id="email" name="email" required placeholder="Ingresa tu correo">
            <label for="password">Ingresa tu contraseña</label>
            <input type="password" id="password" name="password" required placeholder="Password">
            <button type="submit">login</button>
            @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
            </div>
            @endif
            <a href="{{ route('login_alta') }}">
                <button type="button" class="btn btn-primary btn-sm">Registrar</button>
                </a>
        </form>
        </center>
    </div>
</body>
</html>