<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/destilos.css') }}">
    <title> Paciente detalle</title>
</head>
<body>
<div id="encabezado">
    <img src="{{ asset('img/dinologin.jpg') }}" alt="logo empresa" id="imgenbn">
        <h1>Detalle de Pacientes</h1>
</div>
<br>

        <div id="detalle">
            <h5>Id: {{ $data['id_paciente'] }}</h5>
            <h5>Nombre: {{ $data['nombre'] }}</h5>
            <h5>Apellido paterno: {{ $data['app'] }}</h5>
            <h5>Apelido materno: {{ $data['apm'] }}</h5>
            <h5>Genero: {{ $data['sex'] }}</h5>
            <h5>Fecha de nacimiento: {{ $data['fn'] }}</h5>
            <h5>Teléfono: {{ $data['tel'] }}</h5>
            <a href="{{ route('pacientes') }}">
                    <button type="button" class="btn btn-primary btn-sm">Regresar</button>
                </a>
        </div>
</body>
</html>

