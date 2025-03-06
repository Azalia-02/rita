<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Paciente</title>
</head>
<body>
<h2>Editar Paciente</h2>
<form action="{{ route('paciente_salvar', $data['id_paciente']) }}" method="post">
    
    @csrf
    <input type="hidden" name=id value="{{ $data['id_paciente'] }}">

    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" value="{{ $data['nombre'] }}"><br>

    <label for="app">App</label>
    <input type="text" name="app" id="app" value="{{ $data['app'] }}"><br>

    <label for="apm">Apm</label>
    <input type="text" name="apm" id="apm" value="{{ $data['apm'] }}"><br>

    <label for="sex">Sexo</label>
    <select name="sex" id="sex" class="form-control" value="{{ $data['sex'] }}">
            <option value="">Seleccione una opción</option>
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
    </select><br>

    <label for="fn">FN</label>
    <input type="date" name="fn" id="fn" value="{{ $data['fn'] }}"><br>

    <label for="tel">Teléfono</label>
    <input type="tel" name="tel" id="tel" value="{{ $data['tel'] }}"><br>

    <button type="submit">Guardar</button>
</form>
<a href="{{ route ('pacientes') }}" button="button">Volver a lista de pacientes</button>
</body>
</html>