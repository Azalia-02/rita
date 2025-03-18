<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfica de Médicos</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Cargar ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.41.1/apexcharts.min.js"></script>

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

        <!-- Botón de regreso -->
        <a href="{{ route('medicos') }}" class="btn btn-outline-primary mb-3">Regresar</a>

        @if($chart)
            <div class="chart-container">
                <div id="chart"></div>

                <!-- Botón para descargar en PNG -->
                <button id="download-png" class="btn btn-success mt-3">Descargar PNG</button>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    var chartData = {!! json_encode($chartData) !!};

                    var options = {
                        chart: {
                            type: chartData.type,
                            height: chartData.height,
                            width: "100%",
                            toolbar: { show: false } // Ocultar toolbar de ApexCharts
                        },
                        series: chartData.series,
                        labels: chartData.options.labels,
                        title: {
                            text: chartData.options.title.text,
                            align: "center"
                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#chart"), options);
                    chart.render().then(() => {
                        document.getElementById("download-png").addEventListener("click", function () {
                            chart.dataURI().then(({ imgURI }) => {
                                let link = document.createElement("a");
                                link.href = imgURI;
                                link.download = "grafica_medicos.png";
                                document.body.appendChild(link);
                                link.click();
                                document.body.removeChild(link);
                            });
                        });
                    });
                });
            </script>
        @else
            <div class="alert alert-warning">No hay datos disponibles para mostrar la gráfica.</div>
        @endif
    </div>

</body>
</html>
