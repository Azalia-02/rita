<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/destilos.css') }}">
    <title>Paciente medico</title>
</head>
<body>
    
<div id="encabezado">
    <img src="{{ asset('img/dinologin.jpg') }}" alt="logo empresa" id="imgenbn">
        <h1>Detalle de Médicos</h1>
</div>
        <br>
       
            <div id="detalle">
                <h5>Id: {{ $data['id_medico'] }}</h5>
                <h5>Nombre: {{ $data['clave'] }}</h5>
                <h5>Nombre: {{ $data['nombre'] }}</h5>
                <h5>Apellido paterno: {{ $data['app'] }}</h5>
                <h5>Apellido materno: {{ $data['apm'] }}</h5>
                <h5>Fecha de nacimiento: {{ $data['fn'] }}</h5>
                <h5>Sexo: {{ $data['sex'] }}</h5>
                <h5>Teléfono: {{ $data['tel'] }}</h5>
                <h5>Email: {{ $data['email'] }}</h5>
                <a href="{{ route('medicos') }}">
                    <button type="button" class="btn btn-primary btn-sm">Regresar</button>
                </a>
            </div>
        
    
</body>
</html>