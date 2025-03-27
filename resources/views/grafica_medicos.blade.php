<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfica de Médicos</title>

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
    <h1 class="mb-4 text-primary">Gráfico de Médicos</h1>

    <!-- Barra de búsqueda -->
    <div class="mb-3">
        <input type="text" id="buscarMedico" class="form-control" placeholder="Buscar médico por nombre...">
    </div>

    <!-- Botón de regreso -->
    <a href="{{ route('medicos') }}" class="btn btn-outline-primary mb-3">Regresar</a>

    <!-- Contenedor de gráficas -->
    <div class="chart-container">
        <h5>Gráfico de Médicos por Nombre</h5>
        <div id="chartNombres"></div>
        <button id="download-nombres" class="btn btn-success mt-3">Descargar PNG</button>
    </div>

    <div class="chart-container mt-4">
        <h5>Gráfico de Médicos por Sexo</h5>
        <div id="chartSexo"></div>
        <button id="download-sexo" class="btn btn-success mt-3">Descargar PNG</button>
    </div>
</div>

<script>
$(document).ready(function () {
    // Configuración inicial de la gráfica de nombres
    var optionsNombres = {
        chart: {
            type: 'bar',
            height: 400,
            toolbar: { show: false }
        },
        series: [],
        xaxis: { categories: [] },
        title: { text: 'Médicos Encontrados' }
    };

    var chartNombres = new ApexCharts(document.querySelector("#chartNombres"), optionsNombres);
    chartNombres.render();

    // Configuración inicial de la gráfica de sexo
    var optionsSexo = {
        chart: {
            type: 'pie',
            height: 400,
            toolbar: { show: false }
        },
        series: [],
        labels: ['Masculino', 'Femenino'],
        title: { text: 'Distribución por Sexo' }
    };

    var chartSexo = new ApexCharts(document.querySelector("#chartSexo"), optionsSexo);
    chartSexo.render();

    // Función para cargar datos de médicos por nombre
    function cargarGraficaNombres(busqueda = '') {
        $.ajax({
            url: 'http://3.83.41.64:3003/api/medicos',
            type: 'GET',
            data: { search: busqueda, limit: 100 },
            success: function (response) {
                console.log("Datos recibidos para nombres:", response);
    var medicos = response.data;

    if (medicos.length === 0) {
        chartNombres.updateOptions({
            series: [],
            xaxis: { categories: [] }
        });
        return;
                }

                var nombres = medicos.map(m => m.nombre);
                var conteo = medicos.map(() => 1); // Un médico = un registro

                chartNombres.updateOptions({
                    series: [{ name: 'Médicos', data: conteo }],
                    xaxis: { categories: nombres }
                });

            },
            error: function () {
                alert("Error al cargar datos de la API de nombres.");
            }
        });
    }

    

    // Función para cargar datos de médicos por sexo
    function cargarGraficaSexo() {
    $.ajax({
        url: 'http://3.83.41.64:3003/api/medicos-por-sexo',
        type: 'GET',
        success: function (response) {
            console.log("Datos recibidos para sexo:", response); // Verifica datos

            var hombres = response.hombres || 0; 
            var mujeres = response.mujeres || 0; 
            console.log("Sexo - Hombres:", hombres, "Mujeres:", mujeres);

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



    // Evento para buscar cuando el usuario escribe
    $("#buscarMedico").on("keyup", function () {
        var textoBusqueda = $(this).val();
        cargarGraficaNombres(textoBusqueda);
    });

    // Descargar gráfico de nombres como PNG
    $("#download-nombres").click(function () {
        chartNombres.dataURI().then(({ imgURI }) => {
            let link = document.createElement("a");
            link.href = imgURI;
            link.download = "grafica_medicos_nombres.png";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    });

    // Descargar gráfico de sexo como PNG
    $("#download-sexo").click(function () {
        chartSexo.dataURI().then(({ imgURI }) => {
            let link = document.createElement("a");
            link.href = imgURI;
            link.download = "grafica_medicos_sexo.png";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    });

    // Cargar las gráficas inicialmente
    cargarGraficaNombres();
    cargarGraficaSexo();
});
</script>

</body>
</html>
