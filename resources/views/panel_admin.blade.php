<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
</head>
<body>
<div id="encabezado">
    <img src="{{ 'img/dinologin.jpg' }}" alt="logo empresa" id="imgenbn">
    <nav class="menu">
      <ul>
        <li>
          <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="cierre">Cerrar sesión</button>
          </form>
        </li>  
        <li><h1 class="text-center">Panel de Administración</h1></li>
      </ul>
    </nav>
  </div>
        <form action="{{ route('panel_admin') }}" method="GET" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-floating mb-3">
                <input type="input" class="form-control" name="buscar" value="{{ old('buscar') }}" id="floatingBuscar" 
                    placeholder="ejemplo: Azalia Mejía" aria-describedby="buscarHelp">
                <div id="buscarHelp" class="form-text">@if($errors->first('buscar')) <i>El campo Buscar no es correcto!!!</i> @endif</div>
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="{{ route('panel_admin') }}">
                <button type="button" class="btn btn-danger">Reiniciar</button>
            </a>
        </form>
        <br>
    <h3>Lista de Pacientes</h3>
    <hr>
    
<hr><br>
<table class="table">
    <tr>
        <th>N°</th>
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Asignar</th>
    
</tr>
@foreach($paciente as $key=>$pacientes)
<tr>
    <td>{{ $pacientes->id_paciente }}</td>
    <td>{{ $pacientes->nombre }}</td>
    <td>{{ $pacientes->app }}</td>
    <td>{{ $pacientes->apm }}</td>
    <td><a href="{{ route('fertilizante_editar', $fertilizantes->id_fertilizante) }}">
            <button type="button" class="boton2">Asignar</button>
</a></td>

</tr>
@endforeach
</table>

<div class="pagination pagination-sm">
            {{ $paciente->links('pagination::bootstrap-5') }}
</div>

</div>
</body>
</html>