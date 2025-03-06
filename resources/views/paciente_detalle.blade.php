<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Paciente detalle</title>
</head>
<body>
<div>
    <div>
    <h3>Detalles del alumno</h3>

        <div>
            <h5>Id: {{ $data['id_paciente'] }}</h5>
            <h5>Nombre: {{ $data['nombre'] }}</h5>
            <h5>Apellido paterno: {{ $data['app'] }}</h5>
            <h5>Apelido materno: {{ $data['apm'] }}</h5>
            <h5>Genero: {{ $data['sex'] }}</h5>
            <h5>Fecha de nacimiento: {{ $data['fn'] }}</h5>
            <h5>Teléfono: {{ $data['tel'] }}</h5>
        </div>

        <a href="{{ route('pacientes') }}">
            <button type="button" class="btn btn-primary btn-sm">Regresar a la lista de pacientes</button>
        </a>
        
    </div>
</div>
</body>
</html>

