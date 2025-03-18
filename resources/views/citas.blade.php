<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Citas Médicas</title>
    <link rel="stylesheet" href="{{ asset('css/mestilos.css') }}">
</head>
<body>
    <div id="encabezado">
        <img src="{{ asset('img/dinologin.jpg') }}" alt="logo empresa" id="imgenbn">
        <h1>Citas</h1>
    </div>

    <div class="container">
        <form action="{{ route('guardar_cita') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="paciente">Seleccionar Paciente:</label>
                <select class="form-control" id="paciente" name="paciente" required>
                    <option value="">Seleccione un paciente</option>
                    @foreach($pacientes as $paciente)
                        <option value="{{ $paciente['id_paciente'] }}">{{ $paciente['nombre'] }} {{ $paciente['app'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="medico">Seleccionar Médico:</label>
                <select class="form-control" id="medico" name="medico" required>
                    <option value="">Seleccione un médico</option>
                    @foreach($medicos as $medico)
                        <option value="{{ $medico['id_medico'] }}">{{ $medico['nombre'] }} {{ $medico['app'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="fecha">Fecha de la Cita:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>

            <div class="form-group">
                <label for="hora">Hora de la Cita:</label>
                <input type="time" class="form-control" id="hora" name="hora" required>
            </div>

            <div class="form-group">
                <label for="detalle">Motivo de la Cita:</label>
                <textarea class="form-control" id="detalle" name="detalle" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cita</button>
        </form>

        <h2>Citas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Motivo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($citas as $cita)
                    <tr>
                        <td>{{ $cita['paciente_nombre'] ?? $cita['id_paciente'] }}</td>
                        <td>{{ $cita['medico_nombre'] ?? $cita['id_medico'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($cita['fecha'])->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($cita['hora'])->format('H:i') }}</td>
                        <td>{{ $cita['detalle'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('panel_admin') }}" class="boton">Volver</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>