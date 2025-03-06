<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Paciente medico</title>
</head>
<body>
<div>
    <div>
    <h3>Detalles del medico</h3>

        <div>
            <h5>Id: {{ $data['id_medico'] }}</h5>
            <h5>Nombre: {{ $data['clave'] }}</h5>
            <h5>Nombre: {{ $data['nombre'] }}</h5>
            <h5>Apellido paterno: {{ $data['app'] }}</h5>
            <h5>Apelido materno: {{ $data['apm'] }}</h5>
            <h5>Fecha de nacimiento: {{ $data['fn'] }}</h5>
            <h5>Sexo: {{ $data['sex'] }}</h5>
            <h5>Teléfono: {{ $data['tel'] }}</h5>
            <h5>Email: {{ $data['email'] }}</h5>
        </div>

        <a href="{{ route('medicos') }}">
            <button type="button" class="btn btn-primary btn-sm">Regresar a la lista de medicos</button>
        </a>
        
    </div>
</div>
</body>
</html>

