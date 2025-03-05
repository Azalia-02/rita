<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #043047;
            color: #E6F7F8;
        }
        .header {
            background-color: #E6F7F8;
            color: #043047;
            padding: 15px;
            text-align: center;
            font-weight: bold;
        }
        .container-custom {
            max-width: 900px;
            margin: auto;
            padding: 20px;
            background-color: #043047;
            border-radius: 10px;
        }
        .btn-custom {
            background-color: #6BA7B8;
            color: #043047;
            border-radius: 20px;
            border: none;
            padding: 8px 16px;
            margin: 5px;
        }
        #imgenbn{
    width: 120px;
    height: 100px;
    float: inline-start;
  }
        .table-custom {
            background-color: #E6F7F8;
            color: #043047;
        }
    </style>
</head>
<body>
    <div class="header d-flex justify-content-between">
        <div class="ms-3">
        <img src="{{ asset('img/dinologin.jpg') }}" alt="logo empresa" id="imgenbn">
        </div>
        <div>PACIENTES</div>
        <div class="me-3 text-end">
            <button class="btn btn-light">Cerrar Sesión</button>
        </div>
    </div>
    
    <div class="container-custom mt-4 p-4">
        <input type="text" class="form-control mb-3" placeholder="Buscar paciente">
        <div class="d-flex justify-content-between">
            <button class="btn-custom">Buscar</button>
            <button class="btn-custom">Reiniciar</button>
        </div>
        
        <h5 class="text-center mt-3">Lista de Pacientes</h5>
        <table class="table table-custom mt-2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Fecha Nacimiento</th>
                    <th>NSS</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
             
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button class="btn-custom">Historial</button>
                        <button class="btn-custom">Eliminar</button>
                    </td>
                </tr>
                
            </tbody>
        </table>
        
        <div class="d-flex justify-content-between mt-3">
        <button class="btn-custom" onclick="location.href='{{ route('medico') }}'">Médico</button>
            <button class="btn-custom" onclick="location.href='{{ route('user_graficas') }}'">Graficas</button>
        </div>
    </div>
</body>
</html>
