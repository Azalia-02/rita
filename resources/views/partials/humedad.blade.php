<div class="card-container">
    <div class="title-card">
        <p>Sensor ID: {{ is_object($sensor) ? $sensor->id_sensor ?? 'N/A' : ($sensor['id_sensor'] ?? 'N/A') }}</p>
    </div>
    <div class="card-content">
        <p class="title">💧 Humedad</p>
        <p class="value">{{ is_object($sensor) ? $sensor->humedad ?? 'N/A' : ($sensor['humedad'] ?? 'N/A') }} %</p>

        <p class="title">💧 Temperatura DHT11</p>
        <p class="value">{{ is_object($sensor) ? $sensor->temperatura_dht11 ?? 'N/A' : ($sensor['temperatura_dht11'] ?? 'N/A') }} °C</p>
    </div>
</div>
