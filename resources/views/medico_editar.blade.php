<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <title>Editar Medico</title>
</head>
<body>
<div id="encabezado">
        <img src="{{ asset('img/dinologin.jpg') }}" alt="logo empresa" id="imgenbn">
        <h1>Actualización de Médicos</h1>
    </div>
<center>
<form action="{{ route('medico_salvar', $data['id_medico']) }}" method="post">
    
    @csrf
    <input type="hidden" name=id value="{{ $data['id_medico'] }}">

    <label for="clave">Clave</label>
    <input type="text" name="clave" id="clave" value="{{ $data['clave'] }}"><br>

    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" value="{{ $data['nombre'] }}"><br>

    <label for="app">App</label>
    <input type="text" name="app" id="app" value="{{ $data['app'] }}"><br>

    <label for="apm">Apm</label>
    <input type="text" name="apm" id="apm" value="{{ $data['apm'] }}"><br>

    <label for="fn">FN</label>
    <input type="date" name="fn" id="fn" value="{{ $data['fn'] }}"><br>

    <label for="sex">Sexo</label>
    <select name="sex" id="sex" class="form-control" value="{{ $data['sex'] }}">
            <option value="">Seleccione una opción</option>
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
    </select><br>
    
    <label for="tel">Teléfono</label>
    <input type="tel" name="tel" id="tel" value="{{ $data['tel'] }}"><br>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="{{ $data['email'] }}"><br>

    <button type="submit" class="btn btn-primary">Guardar</button>
<a href="{{ route('medicos') }}">
<button type="button" class="btn btn-danger">Cancelar</button>
</form>
</center>
</body>
</html>