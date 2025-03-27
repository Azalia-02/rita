<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfica de Pacientes</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.41.1/apexcharts.min.js"></script>

    <!-- jQuery para AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .chart-container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container text-center">
    <h1 class="mb-4 text-primary">Gráfico de Pacientes</h1>

    <!-- Barra de búsqueda -->
    <div class="mb-3">
        <input type="text" id="buscarPaciente" class="form-control" placeholder="Buscar paciente por nombre...">
    </div>

    <!-- Botón de regreso -->
    <a href="{{ route('pacientes') }}" class="btn btn-outline-primary mb-3">Regresar</a>

    <!-- Contenedor de gráficas -->
    <div class="chart-container">
        <h5>Gráfico de Pacientes por Nombre</h5>
        <div id="chartNombres"></div>
        <button id="download-nombres" class="btn btn-success mt-3">Descargar PNG</button>
    </div>

    <div class="chart-container mt-4">
        <h5>Gráfico de Pacientes por Sexo</h5>
        <div id="chartSexo"></div>
        <button id="download-sexo" class="btn btn-success mt-3">Descargar PNG</button>
    </div>
</div>

<script>
$(document).ready(function () {
    var optionsNombres = {
        chart: { type: 'bar', height: 400, toolbar: { show: false } },
        series: [],
        xaxis: { categories: [] },
        title: { text: 'Pacientes Encontrados' }
    };
    var chartNombres = new ApexCharts(document.querySelector("#chartNombres"), optionsNombres);
    chartNombres.render();

    var optionsSexo = {
        chart: { type: 'pie', height: 400, toolbar: { show: false } },
        series: [],
        labels: ['Masculino', 'Femenino'],
        title: { text: 'Distribución por Sexo' }
    };
    var chartSexo = new ApexCharts(document.querySelector("#chartSexo"), optionsSexo);
    chartSexo.render();

    function cargarGraficaNombres(busqueda = '') {
        $.ajax({
            url: 'http://3.83.41.64:3003/api/pacientes',
            type: 'GET',
            data: { search: busqueda, limit: 100 },
            success: function (response) {
                console.log("Datos recibidos para nombres:", response);
                var pacientes = response.data;
                if (pacientes.length === 0) {
                    chartNombres.updateOptions({ series: [], xaxis: { categories: [] } });
                    return;
                }
                var nombres = pacientes.map(p => p.nombre);
                var conteo = pacientes.map(() => 1);
                chartNombres.updateOptions({
                    series: [{ name: 'Pacientes', data: conteo }],
                    xaxis: { categories: nombres }
                });
            },
            error: function () {
                alert("Error al cargar datos de la API de nombres.");
            }
        });
    }

    function cargarGraficaSexo() {
        $.ajax({
            url: 'http://3.83.41.64:3003/api/contar-por-sexo',
            type: 'GET',
            success: function (response) {
                console.log("Datos recibidos para sexo:", response);
                var hombres = response.hombres || 0;
                var mujeres = response.mujeres || 0;
                chartSexo.updateOptions({
                    series: [hombres, mujeres],
                    labels: ['Hombres', 'Mujeres']
                });
                chartSexo.render();
            },
            error: function () {
                alert("Error al cargar datos de la API de sexo.");
            }
        });
    }

    $("#buscarPaciente").on("keyup", function () {
        var textoBusqueda = $(this).val();
        cargarGraficaNombres(textoBusqueda);
    });

    $("#download-nombres").click(function () {
        chartNombres.dataURI().then(({ imgURI }) => {
            let link = document.createElement("a");
            link.href = imgURI;
            link.download = "grafica_pacientes_nombres.png";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    });

    $("#download-sexo").click(function () {
        chartSexo.dataURI().then(({ imgURI }) => {
            let link = document.createElement("a");
            link.href = imgURI;
            link.download = "grafica_pacientes_sexo.png";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    });

    cargarGraficaNombres();
    cargarGraficaSexo();
});
</script>

</body>
</html>
