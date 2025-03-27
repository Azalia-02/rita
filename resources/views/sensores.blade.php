<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensores - Monitoreo Remoto de Pacientes (Rita)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/cards-styles.css') }}" rel="stylesheet">
     <!-- Estilos para las tarjetas -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- ✅ Estilos personalizados -->
        <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #033c50;
            color: #ffffff;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        /* Estilos del header */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            color: #033c50;
            padding: 15px 20px;
        }
        #imgenbn{
            width: 120px;
            height: 100px;
            float: inline-start;
        }
    </style>
</head>

<body>
<header>
    <img src="{{ asset('img/dinologin.jpg') }}" alt="logo empresa" id="imgenbn">
    <h1 class="text-center">📊 Monitoreo de Sensores - Rita Ac</h1>

        <form action="{{ route('logout') }}" method="POST" class="logout-form">
 
</form>
    </header>


<div class="container mt-5">
    <br>

    <!-- Incluir la vista parcial con las tarjetas -->
    <div id="cards-container" class="container-cards">
    @include('partials.cards-sensores', ['sensores' => $sensores])

    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $sensores->links() }}
    </div>
</div>
<script>
  // ✅ Actualización automática cada 5 segundos
  setInterval(() => {
        $.ajax({
            url: "{{ route('sensores') }}",  
            method: 'GET',
            success: function (data) {
                $('#cards-container').html(data);
                
            },
            error: function () {
                console.error('Error al cargar los datos');
            }
        });
    }, 1000);

</script>
</body>
</html>