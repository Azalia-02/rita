<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <title>Document</title>
</head>
<body>
<div id="encabezado">
        <img src="{{ asset('img/dinologin.jpg') }}" alt="logo empresa" id="imgenbn">
        <h1>Registro de Pacientes</h1>
    </div>

<center>
    <form class="form-register" action="{{ route('paciente_registrar') }}" method="post">
        @csrf
        <label for="nombre">Nombre</label>
        <input class="controls" type="text" name="nombre" id="nombre"><br>

        <label for="app">Apellido Paterno</label>
        <input class="controls" type="text" name="app" id="app"><br>

        <label for="apm">Apellido Materno</label>
        <input class="controls" type="text" name="apm" id="apm"><br>

        <label for="sex">Sexo</label>
        <select class="controls" name="sex" id="sex" class="form-control">
            <option value="">Seleccione una opción</option>
            <option value="Femenino">Femenino</option>
            <option value="Masculino">Masculino</option>
        </select><br>

        <label for="fn">Fecha de Nacimiento</label>
        <input class="controls" type="date" name="fn" id="fn"><br>

        <label for="tel">Telefono</label>
        <input class="controls" type="text" name="tel" id="tel"><br>

        <button type="submit" class="btn btn-primary">Guardar</button>
<a href="{{ route('pacientes') }}">
<button type="button" class="btn btn-danger">Cancelar</button>

    </form>
    </center>
</body>
</html>